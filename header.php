<?php
session_start();
if(isset($_SESSION['uname'])){
	$uname=$_SESSION['uname'];
	echo "Session successfully created.";
}
?>
<html>
	<head>
		<title>
			BMdB | Bollywood Movie Database
		</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="css/common.css" rel="stylesheet" type="text/css">
		<script src="js/jquery-1.9.1.min.js"></script>
			
	</head>
	<body>
	<div class="alertback hide">
        <div class="alert">
            <div class="msg">
                <span id="alertmsg"></span><br/>
                <button id="alert_btn" class="btn">Dismiss</button>
            </div>
        </div>
    </div>
	<div class="header">
		<div class="logo">
			<a href="index.php"><img src="img/logosmall.png" /></a>
		</div>
		<div id="menulinks">
			
			<?php
				if(isset($_SESSION['uname']))
					echo '<a href="user.php" >'.$uname.'</a><a href="logout.php">Logout</a>';
				else
					echo '<a href="#" class="loginlink">Login</a>';
			?>
			<div class="logindiv">
				<div class='arrow'>
				</div>
				<div id="innerlogin">
						<input name="username" maxlength="255" style="width: 200px" id="username" alt="username" placeholder="email id"/> 
						<input name="password" type="password" maxlength="255" style="width: 200px" id="password" alt="password" placeholder="password"/> 
						<button class="button" onclick="login();">Login</button>
						<br/>
						<br/>
						<a href="userregistration.php" id="reglink" style="text-decoration;color:white;">Haven't Registered ? Click Here</a>
				</div>
			</div>
		</div>
		
		<div class="searchbar">
			<form method="get" action="find.php">
				<input type="text" id="search" autocomplete="off" name="search" placeholder="Find Movies, Celebrities and more..." <?php if(isset($_GET['search']))echo 'value="'.$_GET['search'].'"' ;?>class="search" />
				<input type="submit" name="submit" value="Find It!" class="button"/>
			</form>
			<div class="suggest" id="suggest">
			</div>
		</div>
		<div class="container">
		</div>
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/fetcher.js"></script>
		<script src="js/login.js"></script>
		

		<script type="text/javascript">
			$(".loginlink").bind('click',function (){
				if($(".logindiv").css('display')==='none')
				{
					$(".logindiv").css('display','block');
				}
				else
				{
					$(".logindiv").css('display','none');
				}
			});
			function alertbox(action,msg) {
				if (action === 'show') {
					$().html();
					$('.alertback').removeClass('hide');
					$('.alertback').addClass('show');
				} else {
					$('.alertback').removeClass('show');
					$('.alertback').addClass('hide');
				}
			}
			$(document).ready(function(){
				$('#alert_btn').bind('click', function () {
					alertbox('hide');
				});
			});
		</script>
		<script src="js/rate.js"></script>
	</div>