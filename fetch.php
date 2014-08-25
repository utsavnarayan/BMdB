<?php
	include("includes/connection.php");
	$Json = array();
	$data = array();
	$con = new Connection();
	$res=$con->execQuery("select * FROM `movie_details` where title like '".$_POST['query']."%';");
	$resceleb=$con->execQuery("select * FROM `celebrity` where name like '".$_POST['query']."%';");
	$con->closeConnection();
	$k=0;
	$j=0;
	while($row=$res->fetch_array(MYSQLI_BOTH)){
		if($k==5)
			break;
		array_push($data, array(
			'i' => $k,
			'id' => $row['poster'],
			'title' => $row['title'].' ('.$row['year'].')',
		));
		$k++;
	}
	while($rowc=$resceleb->fetch_array(MYSQLI_BOTH)){
		if($j==5)
			break;
		array_push($data, array(
			'i' => $j,
			'id' => $rowc['id'],
			'name' => $rowc['name']
		));
		$j++;
	}
	array_push($Json, array(
			'data' => $data
	));
	echo json_encode($Json);
?>