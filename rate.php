<?php
 mysql_connect('localhost','root');
 mysql_select_db('bmdbbeta');
session_start();
if(isset($_POST['rate'])){

	$sql='select * from user_ratings where user_id='.$_SESSION['uid'].' and movie_id='.$_SESSION['pid'];
	$sql1='select * from totalrating where movie_id='.$_SESSION['pid'];
	echo $sql;
	$s=mysql_query($sql);
	$s1=mysql_query($sql1);
	echo mysql_error();
	if(mysql_num_rows($s)==0)
	{
		mysql_query('insert into user_ratings (user_id,movie_id,rating) values ('.$_SESSION['uid'].','.$_SESSION['pid'].','.$_POST['rate'].')');
		echo mysql_error()."-----inserted";
	}
	else 
	{
		mysql_query('update user_ratings set rating='.$_POST['rate'].' where user_id='.$_SESSION['uid'].' and movie_id='.$_SESSION['pid']);
		echo mysql_error()."-----updated";
	}
	if(mysql_num_rows($s1)==0)
	{
		mysql_query('insert into totalrating (movie_id,count,total) values ('.$_SESSION['pid'].',1,'.$_POST['rate'].')');
		echo mysql_error()."-----inserted";
	}
	else
	{
		$sql2='select * from totalrating where movie_id='.$_SESSION['pid'];
		$s2=mysql_query($sql2);
		$row2 = mysql_fetch_array($s2, MYSQLI_BOTH);
		$total=$row2['total'];
		$count=$row2['count'];
		$total+=$_POST['rate'];
		$count+=1;
		$s3=mysql_query('update totalrating set count='.$count.',total='.$total.' where movie_id='.$_SESSION['pid']);
	}
}
?>