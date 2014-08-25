<?php 
function  uquery($type,$mid){
set_time_limit(0);
$con=mysql_connect("localhost","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("bmdbbeta", $con);
$sql="select * from movie_details WHERE poster =".$mid;
$res=mysql_query($sql,$con);
$resa = mysql_fetch_array($res);
$mtitle=$resa['title'];
$myear=$resa['year'];
$youquery=$mtitle." ".$myear." ".$type;
$youurl = "http://www.youtube.com/results?search_query=".(string)$youquery;
$youurl=str_replace(" ", "+", $youurl);
$file_str =file_get_contents($youurl);
$file_string=str_replace("'", "", $file_str);
preg_match('/watch\?v=(.*?)"/', $file_string, $maptable);
echo "<iframe  style=\"margin:5px\" width=\"300\" height=\"200\" src=\"http://www.youtube.com/embed/".$maptable[1]."\" frameborder=\"0\" allowfullscreen></iframe>";

mysql_close($con);
}
 ?>