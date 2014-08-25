<?php 
include("includes/connection.php");
$con=new connection();
$res=$con->execQuery("SELECT poster, title FROM `movie_details`;");
$query='';
$j=0;
while($row=$res->fetch_array(MYSQLI_BOTH)){
		if($row['title']!=''){
			if($j==0){
				$query="('".$row['title']."','title','".$row['poster']."')";
				$j=1;
			}
			else{
				$query=$query.", ('".$row['title']."','title','".$row['poster']."')";
			}
		}
}
$query="INSERT INTO `nlp`(`token`, `type`, `token_id`) VALUES  ".$query.";";
$cons=new connection();
$cons->execQuery($query);
echo "Done :)";
?>