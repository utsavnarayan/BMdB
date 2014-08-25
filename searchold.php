<?php
	include("includes/connection.php");
	include("includes/tokenize.php");
	$results = array();
	array_push($results,-999);
	$tok = new tokenize($_GET['search']);
	$con = new Connection();
	$mid = array();
	$mnm = array();
	$mwt = array();
	$titles = array();
	$Json = array();
	array_push($mid,-999);
	array_push($mwt,0);
	array_push($mnm,"a");
	$pmid = array();
	$pmnm = array();
	$pmwt = array();
	array_push($pmid,-999);
	array_push($pmwt,0);
	array_push($pmnm,"a");
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
	
	
	
	//display $results array
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
	echo json_encode($Json);
	$con->closeConnection();
?>