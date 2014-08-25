function login(){
	var username=$('#username').val();
	var password=$('#password').val();
	var pattern=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
	if(username === '' || password === ''){
			$("#alertmsg").html('Incomplete Details');
			alertbox('show');
		return false;
	}
	else if(!pattern.test(username)){
			$("#alertmsg").html('Enter valid email id');
			alertbox('show');
		return false;
	}
	$.post('login.php',{username:username,password:password},function(data){
		obj=eval("("+data.substring(1,(data.length-1))+")");
		if(obj.status=="success"){	
			$(".logindiv").remove();
			$(".logindiv").css('display','none');
			$(".loginlink").attr('href','user.php');
			$(".loginlink").html(obj.name);
			$("#alertmsg").html('Logged In successfully');
			$("#menulinks").append('<a href="logout.php">logout</a>');
			alertbox('show');
		}
		else{
			$("#alertmsg").html('Invalid Credentials');
			alertbox('show');
		}
	});
	return false;
}