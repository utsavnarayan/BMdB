<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>BMdB</title>
    <link href="home.css" rel="stylesheet" type="text/css" />
	<link href="css/common.css" rel="stylesheet" type="text/stylesheet"/>

</head>
<body>

    <div class="header">
        <div class="logo">
            <img src="img/logosmall.png" />
        </div>
        <div id="menulinks"><a href="#">Best Movies</a> <a href="#">Latest Release</a><a href="#">Trailers</a><a
            href="#"> Lists</a><a href="#">My Profile</a><a href="#" id="loginlink">Login</a>
       </div>
		<div class="searchbar">
			<form method="get" action="find.php">
				<input type="text" id="search" name="search" placeholder="Find Movies, Celebrities and more..." class="search" />
				<input type="submit" name="submit" value="Find It!" class="button"/>
			</form>
			<div class="suggest" id="suggest">
				
			</div>
		</div>
		<div class="container">
		</div>
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/fetcher.js"></script>
    </div>
    <div class="wrapper">
        <div id="maininfo">
		<h1>BmdB is the <i>biggest</i> database of bollywood movies and celebrities.</h1>
		<h3>Search here for all the information regarding bollywood.</h3>
           <table><tr><td></td><td colspan="2"></td></tr><tr><td colspan="2"></td><td></td></tr><tr><td></td><td colspan="2"></td></tr></table>
        </div>
    </div>
    <div id="sidebar">
	<span>In Theaters</span>
<table>
<thead><tr><th>Movie</th><th>Rating</th></tr></thead><tbody><tr><td>Aashiqui 2</td><td>3.5</td></tr><tr><td>Shree</td><td>4.0</td></tr><tr><td>Shootout At Wadala</td><td>2.5</td></tr>

<tr><td>Bombay Talkies</td><td>4.5</td></tr>
<tr><td>Bin Phere Hum Ttere</td><td>3.5</td></tr>

</tbody>

</table>       
<span>Coming Soon</span>
<table>
<thead><tr><th>Movie</th><th>Release Date</th></tr></thead><tbody><tr><td>Yamla Pagla Deewana 2</td><td>07 Jun 2013</td></tr><tr><td>Ghanchakkar</td><td>28 Jun 2013</td></tr><tr><td>Lootera</td><td>05 Jul 2013</td></tr></tbody>

</table>       


    </div>
    <div class="footer">
        <a href="#">About</a><a href="#">FAQ</a><a href="#">Credits</a>
    </div>

</body>
</html>
