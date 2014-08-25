 <?php
include("includes/connection.php");
$res = array();
//request not from source
//if(!isset($_POST['submit'])){
	//regFail("You see we dont support corruption in any form.\nSo no backdoor entry for ya mate!\n:P");
//}

regValidate();

function regValidate(){
	$name=$_GET['regname'];
	$email=$_GET['regemail'];
	$pass=($_GET['regpass']);
	$dob=$_GET['regdob'];
	$about=$_GET['regabout'];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		regFail("invalid Email Id");
	} 
	regUser($name,$email,$pass,$dob,$about);
}

function regUser($name,$email,$pass,$dob,$about){
	$reg = new connection();
	if(!($reg->execQuery("insert into user_details values('','0','".$name."','".$email."','".$pass."','".$dob."','".$about."');")))
	{
		$reg->closeConnection();
		regFail("Registration Failed");
	}
	else{
		$id=$reg->execQuery("select id from user_details where email='".$email."';");
		regSuccess("Registration Success");
	}
	$reg->closeConnection();
}
function regSuccess($msg){
	// $res = array();
	// array_push($res,array(
		// 'attempt'=>'success',
		// 'msg'=>$msg,
		// 'id'=>'0',
	// ));
	echo $msg;//json_encode($res));
	//echo "<a href='home.php'>Go home</a>";
}
function regFail($msg){
	// $res = array();
	// array_push($res,array(
		// 'attempt'=>'failed',
		// 'msg'=>$msg,
	// ));
	die($msg);
	// echo "<a href='home.php'>Go home</a>";
	//die(json_encode($res));
}
?>
