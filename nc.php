<?php 
include("includes/connection.php");
$con=new connection();
$res=$con->execQuery("SELECT name, kyfpid FROM `celebrity`;");
$query='';
$j=0;
while($row=$res->fetch_array(MYSQLI_BOTH)){
		if($row['name']!=''){
			if($j==0){
				$query="('".$row['name']."','celeb','".$row['kyfpid']."')";
				$j=1;
			}
			else{
				$query=$query.", ('".$row['name']."','celeb','".$row['kyfpid']."')";
			}
		}
}
$query="INSERT INTO `nlp`(`token`, `type`, `token_id`) VALUES  ".$query.";";
$cons=new connection();
$cons->execQuery($query);
echo "Done :)";
?>