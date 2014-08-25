<?php
	include("includes/connection.php");
	include("includes/tokenize.php");
	$tokens = array();
	$tls = array();
	$result = array();
	if(isset($_GET['search'])){
		$query = $_GET['search'];
		$tokens = get_tokens($query);
		$result = search($tokens);
		show($result);
	}
	function get_tokens($query)
	{
		$tok = new tokenize_all($query);
		$con = new connection();
		$tokens = array();
		$result = array();
		$i=$tok->count*($tok->count+1)/2;
		while($i)
		{
			if($h=$tok->next_tokenize_all())
			{
				$found=0;
				if($h=="#end")
					break;
				if(strtolower(trim($h)) == 'romantic')
					$h='romance';
				$res=$con->execQuery("Select type, token_id from nlp where token = '".trim($h)."'");
				if($row=$res->fetch_array(MYSQLI_BOTH)){
					array_push($tokens, array(
						'type' => $row['type'], 
						'name' => trim($h),
						'id' => $row['token_id']
					));
					if($row['type']=='title')
					{
						array_push($GLOBALS["tls"], trim($h));
					}
					$tok->delete_tokenize_all();
				}
			}
		}
		$con->closeConnection(); 
		//var_dump($tokens);
		return $tokens;
	}
	function search($tokens)
	{
		$ct=0;
		$result_title = array();
		$result_title_count = array();
		$result_celeb = array();
		$result_celeb_count = array();
		$con = new connection();
		foreach($tokens as $tok)
		{
			if($tok['type'] == "celeb")
			{
				$qry = ("Select movie_id from `celeb_movie` where celeb_id = '".$tok['id']."'");
				if(!$celeb_exist = array_search($tok['id'],$result_celeb)){
					array_push($result_celeb, $tok['id']);
					array_push($result_celeb_count, 1);
				}
				else{
					$result_celeb_count[$celeb_exist]++;
				}
				$weight=2;
			}
			if($tok['type'] == "genre")
			{
				$qry = ("Select movie_id from `genre` where genre_name = '".$tok['name']."'");
				$weight=1;
			}
			if($tok['type'] == "title")
			{
				$qry = ("Select poster from `movie_details` where poster = '".$tok['id']."'");
				$weight=3;
			}
			$res=$con->execQuery($qry);
			while($row=$res->fetch_array(MYSQLI_BOTH)){
				if(!$title_exist = array_search($row[0], $result_title)){
					array_push($result_title, $row[0]);
					array_push($result_title_count, $weight);
					// echo "adding".$ct."<br/>";
					$ct++;
				}
				else{
					$result_title_count[$title_exist] += $weight;
					// echo "updating<br/>".$ct."<br/>";
				}
			}
		}
		if($ct<10){
			
		}
		$con->closeConnection(); 
		array_multisort($result_title_count, SORT_DESC, SORT_NUMERIC, $result_title);
		array_multisort($result_celeb_count, SORT_DESC, SORT_NUMERIC, $result_celeb);
		// var_dump($result_title);
		// var_dump($result_title_count);
		if($ct>10){
			return array_slice($result_title, 0, 10);
		}
		else{
			return array_slice($result_title, 0, $ct);
		}
	}
	function show($results)
	{
		$titles = array();
		$Json = array();
		$ttls=$GLOBALS["tls"];
		$con = new connection();
		$ct=0;
		foreach($results as $id){
		$ct++;
		$res=$con->execQuery("select * FROM `movies` where f_id=".$id.";");
		if($row=$res->fetch_array(MYSQLI_BOTH)){
				array_push($titles, array(
					'id' => $row['f_id'],
					'title' => $row['ty']
				));
			}
		}
		if(isset($ttls[0])){
			while($ct<10){
				$res=$con->execQuery("select * FROM `movies` where name like '%".$ttls[0]." %';");
				if($row=$res->fetch_array(MYSQLI_BOTH)){
						$chk= array('id' => $row['f_id'],'title' => $row['ty']);
						if(!array_search($chk, $titles)){
							array_push($titles, array(
								'id' => $row['f_id'],
								'title' => $row['ty']
							));
						}
					}
				$ct++;
			}
		}
		array_push($Json, array(
			'titles' => $titles
		));
		echo json_encode($Json);
		$con->closeConnection(); 
	}
?>
