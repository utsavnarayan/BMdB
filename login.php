<?php
session_start();
	function login_success($row)
	{
		$login = array();
		array_push($login, array(
				'status' => 'success',
				'id' => $row['id'],
				'name' => $row['name'],
				'email' => $row['email'],
				'dob' => $row['dob'],
				'about' => $row['about'],
				'admin' => $row['admin']
		));
		$_SESSION['uid']=$row['id'];
		$_SESSION['uname']=$row['name'];
		$_SESSION['uemail']=$row['email'];
		$_SESSION['udob']=$row['dob'];
		$_SESSION['uabout']=$row['about'];
		$_SESSION['uadmin']=$row['admin'];
		return $login;
	}
	function login_fail()
	{
		$login = array();
		array_push($login, array(
			'status' => 'fail'
		));
		return $login;
	}
	include("includes/connection.php");
	$Json = array();
	$con = new Connection();
	if(isset($_POST['username'])&&isset($_POST['password'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$res=$con->execQuery("select * FROM `user_details` where email='".$username."' and password='".$password."';");
		$con->closeConnection();
		if($row=$res->fetch_array(MYSQLI_BOTH)){
			$Json=login_success($row);
		}
		else{
			$Json=login_fail();
		}
	}
	else{
		$Json=login_fail();
	}
	echo json_encode($Json);
?>