
		<?php include( 'header.php');?>
			
				<div class="wrapper">
					<div id="maininfo">
				<form action="register.php">
            <table cellpadding="10">
                <tr>
                    <td rowspan="5" class="poster">
                        <img src="img/demo/add.jpg" />
                    </td>
                    <td>
                       <br /> <b>Name:</b><input type="text" placeholder="Enter Your Name" name="regname" id="namereg" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Password:</b><input type="password" name="regpass" placeholder="Enter Your Desired Password" id="passreg" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Email ID:</b><input type="email" name="regemail" placeholder="Enter your email ID" id="emailreg"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>Date of Birth :</b><input type="date" name="regdob" placeholder="Enter Your Date of Birth" id="dobreg" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <b>About :</b><br /><textarea name="regabout" placeholder="Enter About Yourself and your taste in movies" id="aboutreg" cols="40" rows="6" style="margin-left:10px;margin-top:5px;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td><td>
                        <input type="button" value="Register" id="userreg" style="margin-left:10px;" onclick="register();"/>
                    </td>
                </tr>
            </table>
			</form>

					</div>
				
					<div id="sidebar">
					
					</div>
				</div>
			
			<?php include( 'footer.php');?>	
	
		
		



    <script>
		function register(){
		var name=document.getElementById('namereg').value;
		var pass=document.getElementById('passreg').value;
		var email=document.getElementById('emailreg').value;
		var dob=document.getElementById('dobreg').value;
		var about=document.getElementById('aboutreg').value;
		var pattern=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
		if(name && pass && email && dob && about){
			if(pattern.test(email)){
			var Ajax = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
				Ajax.onreadystatechange = function(){
					if (Ajax.readyState == 4 && Ajax.status == 200){
						
						document.getElementById("sidebar").innerHTML = Ajax.responseText;//set element tile where you wish to set details	
					}
				}
				Ajax.open("GET","register.php?regname="+name+"&regpass="+pass+"&regemail="+email+"&regdob="+dob+"&regabout="+about+"", true);
				Ajax.send();
				}
				else{
				alert("Enter valid email");
		}
			}
		else{
			alert("Fill out all the fields properly");
		}
		}
	</script>
   