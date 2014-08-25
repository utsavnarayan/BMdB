<?php
	include("includes/connection.php");
	include("includes/tokenize.php");
	$results = array();
	array_push($results,-999);
	$titles = array();
	$Json = array();
	$tok = new tokenize($_GET['search']);
	$gtok = new tokenize($_GET['search']);
	
	$con = new Connection();
	
	//genre/celeb match variables
	$chktg=0;
	$chktc=0;
	$gid = array();
	array_push($gid,-999);
	$cid = array();
	array_push($cid,-999);
	$glist='';
	$clist='';
	//genre/celeb match variables
	
	
	$stop=array("a","able","about","across","after","all","almost","also","am","among","an","and","any","are","as","at","be","because","been","but","by","can","cannot","could","dear","did","do","does","either","else","ever","every","for","from","get","got","had","has","have","he","her","hers","him","his","how","however","i","if","in","into","is","it","its","just","least","let","like","likely","may","me","might","most","must","my","neither","no","nor","not","of","off","often","on","only","or","other","our","own","rather","said","say","says","she","should","since","so","some","than","that","the","their","them","then","there","these","they","this","tis","to","too","twas","us","wants","was","we","were","what","when","where","which","while","who","whom","why","will","with","would","yet","you","your");
	
	while($gparam=$gtok->nextToken())//iterate for each token
	{
	
		if(!array_search($gparam,$stop)){//process if not a stop word
			if(strtolower($gparam)=='romantic'){
				$gparam='romance';
			}
			$gres=$con->execQuery("select * FROM `genre` where genre_name like '%".$gparam."%';");
			//for genre match					
			while($grow=$gres->fetch_array(MYSQLI_BOTH)){
				$gk=0;
				if(!$gk=array_search(intval($grow['movie_id']),$gid)){
					array_push($gid,$grow['movie_id']);
				}
				$chktg=1;
			}
		}
	}
			//for genre match
	if($chktg==1){
		$list="";
		$x=0;
		foreach($gid as $movie){
			if($x==0){
				$x=1;
			}
			else if($x==1){
				$list="".$movie."";
				$x=2;
			}
			else
				$list=$list.",".$movie;
		}
		$glist=$list;
	}
		
	 $ctok = new tokenize($_GET['search']);
		//for celeb match
	while($cparam=$ctok->nextToken())//iterate for each token
	{		
		if(!array_search($cparam,$stop)){
		
		    $ctemp=$con->execQuery("select kyfpid FROM `celebrity` where name like '".$cparam." %' or name like '% ".$cparam." %' or name like '% ".$cparam."' or name='".$cparam."';");
			// echo "<br/>"."select kyfpid FROM `celebrity` where name like '".$cparam." %' or name like '% ".$cparam." %' or name like '% ".$cparam."' or name='".$cparam."';"."<br/>";
			$cur='';
			$ccx=0;
			while($ctemprow=$ctemp->fetch_array(MYSQLI_BOTH)){
				if($ccx==0){
					$cur=''.$ctemprow['kyfpid'].'';
					$ccx=1;
				}
				else
					$cur=$cur.','.$ctemprow['kyfpid'];
			}
			
			// var_dump($cur);
			if($cur!=''){
				$cres=$con->execQuery("select movie_id from celeb_movie where celeb_id in (".$cur.");");
				// var_dump($cres);
				while($crow=$cres->fetch_array(MYSQLI_BOTH)){
					$ck=0;
					if($chktg==1){
						if((!$ck=array_search(intval($crow['movie_id']),$cid))&&array_search(intval($crow['movie_id']),$gid)){
							array_push($cid,$crow['movie_id']);
						}
					}
					else{
						if((!$ck=array_search(intval($crow['movie_id']),$cid))){
							array_push($cid,$crow['movie_id']);
						}
					}
					$chktc=1;
				}
			}
			//for celeb match
		}
	}

	if($chktc==1){
		$cx=0;
		foreach($cid as $cmovie){
			if($cx==0){
				$cx=1;
			}
			else if($cx==1){
				$clist="".$cmovie."";
				$cx=2;
			}
			else
				$clist=$clist.",".$cmovie;
		}
	}
	
	
	
	//partial/word title match variables
	$mid = array();
	$mnm = array();
	$mwt = array();
	array_push($mid,-999);
	array_push($mwt,0);
	array_push($mnm,"a");
	$pmid = array();
	$pmnm = array();
	$pmwt = array();
	array_push($pmid,-999);
	array_push($pmwt,0);
	array_push($pmnm,"a");
	//partial/word title match variables
	
	if(!($chktc==1&&$chktg==1)){//===================================================no genre and celeb match
		while($param=$tok->nextToken())//iterate for each token
		{
			$res=$con->execQuery("select * FROM `movies` where name like '".$param." %' or name like '% ".$param." %' or name like '% ".$param."' or name='".$param."';");
			$pres=$con->execQuery("select * FROM `movies` where name like '%".$param."%';");
			
			//for total word match
			while($row=$res->fetch_array(MYSQLI_BOTH)){
				$k=0;
				if(!$k=array_search(intval($row['f_id']),$mid)){
					array_push($mid,$row['f_id']);
					array_push($mnm,$row['name']);
					array_push($mwt,1000);
				}
				else{
					$mwt[$k]=$mwt[$k]*4+1000;
				}
			}
			//for total word match
			
			//for partial word match
			while($prow=$pres->fetch_array(MYSQLI_BOTH)){
				$pk=0;
				if(!$k=array_search(intval($prow['f_id']),$pmid)){
					array_push($pmid,$prow['f_id']);
					array_push($pmnm,$prow['name']);
					array_push($pmwt,1000);
				}
				else{
					$pmwt[$pk]=$pmwt[$pk]*4+1000;
				}
			}
			//for partial word match
		}

		//for total word match
		$k=0;
		$max=0;
		foreach($mid as $id){
			$mwt[$k]=$mwt[$k]/str_word_count($mnm[$k],0,'1234567890');
			if($max<$mwt[$k])
				$max=$mwt[$k];
			$k++;
		}
		$k=0;
		$j=0;
		foreach($mid as $id){
			if($mwt[$k]>=($max/2)&&$j<5){
				array_push($results,$id);
				$j++;
			}
			$k++;
		}
		//for total word match
		
		
		//for partial word match
		$pk=0;
		$pmax=0;
		foreach($pmid as $pid){
			$pmwt[$pk]=$pmwt[$pk]/str_word_count($pmnm[$pk],0,'1234567890');
			if($pmax<$pmwt[$pk])
				$pmax=$pmwt[$pk];
			$pk++;
		}
		$pk=0;
		$pj=0;
		foreach($pmid as $pid){
			if($pmwt[$pk]>=($pmax/2)&&$pj<5){
				if(!array_search($pid,$results))
					array_push($results,$pid);
				$pj++;
			}
			$pk++;
		}
		//for partial word match
	}
	//========================================================================no genre and celeb match
	
	
	else if($chktc==1&&$chktg==1){//===============================================genre & celeb match
		$cj=0;
		foreach($cid as $id){
			if($cj<10){
				array_push($results,$id);
				$cj++;
			}
		}
	
	}//============================================================================genre & celeb match
	
	
	else if($chktg==1){//==================================================================genre match
		while($param=$tok->nextToken())//iterate for each token
		{
			$res=$con->execQuery("select * FROM `movies` where (name like '".$param." %' or name like '% ".$param." %' or name like '% ".$param."' or name='".$param."') and f_id in (".$glist.");");
			$pres=$con->execQuery("select * FROM `movies` where name like '%".$param."%' and f_id in (".$glist.");");
			
			//for total word match
			while($row=$res->fetch_array(MYSQLI_BOTH)){
				$k=0;
				if(!$k=array_search(intval($row['f_id']),$mid)){
					array_push($mid,$row['f_id']);
					array_push($mnm,$row['name']);
					array_push($mwt,1000);
				}
				else{
					$mwt[$k]=$mwt[$k]*4+1000;
				}
			}
			//for total word match
			
			//for partial word match
			while($prow=$pres->fetch_array(MYSQLI_BOTH)){
				$pk=0;
				if(!$k=array_search(intval($prow['f_id']),$pmid)){
					array_push($pmid,$prow['f_id']);
					array_push($pmnm,$prow['name']);
					array_push($pmwt,1000);
				}
				else{
					$pmwt[$pk]=$pmwt[$pk]*4+1000;
				}
			}
			//for partial word match
		}
		
		$k=0;
		$max=0;
		foreach($mid as $id){
			$mwt[$k]=$mwt[$k]/str_word_count($mnm[$k],0,'1234567890');
			if($max<$mwt[$k])
				$max=$mwt[$k];
			$k++;
		}
		$k=0;
		$j=0;
		foreach($mid as $id){
			if($mwt[$k]>=($max/2)&&$j<5){
				array_push($results,$id);
				$j++;
			}
			$k++;
		}
		
		
		$pk=0;
		$pmax=0;
		foreach($pmid as $pid){
			$pmwt[$pk]=$pmwt[$pk]/str_word_count($pmnm[$pk],0,'1234567890');
			if($pmax<$pmwt[$pk])
				$pmax=$pmwt[$pk];
			$pk++;
		}
		$pk=0;
		$pj=0;
		foreach($pmid as $pid){
			if($pmwt[$pk]>=($pmax/2)&&$pj<5){
				if(!array_search($pid,$results))
					array_push($results,$pid);
				$pj++;
			}
			$pk++;
		}
		
	}
	//=====================================================================================genre match
	
	
	else if($chktc==1){//==================================================================celeb match
		while($param=$tok->nextToken())//iterate for each token
		{
			$res=$con->execQuery("select * FROM `movies` where (name like '".$param." %' or name like '% ".$param." %' or name like '% ".$param."' or name='".$param."') and f_id in (".$clist.");");
			$pres=$con->execQuery("select * FROM `movies` where name like '%".$param."%' and f_id in (".$clist.");");
			
			//for total word match
			while($row=$res->fetch_array(MYSQLI_BOTH)){
				$k=0;
				if(!$k=array_search(intval($row['f_id']),$mid)){
					array_push($mid,$row['f_id']);
					array_push($mnm,$row['name']);
					array_push($mwt,1000);
				}
				else{
					$mwt[$k]=$mwt[$k]*4+1000;
				}
			}
			//for total word match
			
			//for partial word match
			while($prow=$pres->fetch_array(MYSQLI_BOTH)){
				$pk=0;
				if(!$k=array_search(intval($prow['f_id']),$pmid)){
					array_push($pmid,$prow['f_id']);
					array_push($pmnm,$prow['name']);
					array_push($pmwt,1000);
				}
				else{
					$pmwt[$pk]=$pmwt[$pk]*4+1000;
				}
			}
			//for partial word match
		}
		
		$k=0;
		$max=0;
		foreach($mid as $id){
			$mwt[$k]=$mwt[$k]/str_word_count($mnm[$k],0,'1234567890');
			if($max<$mwt[$k])
				$max=$mwt[$k];
			$k++;
		}
		$k=0;
		$j=0;
		foreach($mid as $id){
			if($mwt[$k]>=($max/2)&&$j<5){
				array_push($results,$id);
				$j++;
			}
			$k++;
		}
		
		
		$pk=0;
		$pmax=0;
		foreach($pmid as $pid){
			$pmwt[$pk]=$pmwt[$pk]/str_word_count($pmnm[$pk],0,'1234567890');
			if($pmax<$pmwt[$pk])
				$pmax=$pmwt[$pk];
			$pk++;
		}
		$pk=0;
		$pj=0;
		foreach($pmid as $pid){
			if($pmwt[$pk]>=($pmax/2)&&$pj<5){
				if(!array_search($pid,$results))
					array_push($results,$pid);
				$pj++;
			}
			$pk++;
		}
		
	}
	//=====================================================================================celeb match
	
	
	// var_dump($gid);
	// var_dump($cid);
	// var_dump($mid);
	// var_dump($pid);
	
	//echo $results array as $Json
	foreach($results as $id){
		$res=$con->execQuery("select * FROM `movies` where f_id=".$id.";");
		if($row=$res->fetch_array(MYSQLI_BOTH)){
			array_push($titles, array(
				'id' => $row['f_id'],
				'title' => $row['ty']
			));
		}
	}
	array_push($Json, array(
		'titles' => $titles
	));
	// echo "<br/>";
	// echo $chktc;
	// echo $chktg;
	// echo "<br/>";
	echo json_encode($Json);
	$con->closeConnection(); 
?>
