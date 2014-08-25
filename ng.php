<?php 
include("includes/connection.php");
$con=new connection();
$res=$con->execQuery("SELECT distinct genre_name FROM `genre`;");
$query='';
$j=0;
while($row=$res->fetch_array(MYSQLI_BOTH)){
		if($row['genre_name']!=''){
			if($j==0){
				$query="('".$row['genre_name']."','genre','')";
				$j=1;
			}
			else{
				$query=$query.", ('".$row['genre_name']."','genre','')";
			}
		}
}
$query="INSERT INTO `nlp`(`token`, `type`, `token_id`) VALUES  ".$query.";";
$cons=new connection();
$cons->execQuery($query);
echo "Done :)";
?>