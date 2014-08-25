<?php
	include("includes/connection.php");
	include("includes/tokenize.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>BMdB</title>
    <link href="StyleSheetL.css" rel="stylesheet" type="text/css" />

</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="img/logosmall.png" />
        </div>
        <a href="#">Best Movies</a> <a href="#">Latest Release</a><a href="#">News</a><a href="#">Trailers</a><a
            href="#"> Lists</a><a href="#">My Profile</a><a href="#" id="loginlink" style="float: right;">Login</a>
        <form id="sitesearch">
            <input type="text" id="TextBox1" name="searchbox" class="search" />
            <input type="submit" id="searchbutton" value="Search" />

        </form>
    </div>
    <div class="wrapper">
        <div id="maininfo">
		<?php
			$gen=" ";
			$id="";
			$q=$_GET['searchbox'];
			$tok=new tokenize($q);
			$par=$tok->str;
			$par="'%".$par."%'";
			$k=0;
			while($param=$tok->nextToken())
			{
				$par=$par." OR ty LIKE '%".$param."%' " ;
			}
			$query="select * from movies WHERE name LIKE".$par;
			$con= new connection();
			$con->execQuery($query);
			while($res=$con->result->fetch_array(MYSQLI_BOTH))
			{
				$k++;
				echo "<table>";
					echo "<tr>";
						echo "<td><a href='movie.php?id=".$res['f_id']."'>";
						if($id=='')
							$id=$res['f_id'];
							echo "<img src='posters/".$res['f_id'].".jpg' /></a></td>";
						echo "<td><a href='movie.php?id=".$res['f_id']."'><span><b>".$res['ty']."</b></span>+";
							echo "<span>Rating</span>";
							echo "+";
							echo "<span>Genre</span>";
							echo "<br />";
							echo "<span>".$res['gen']."</span>";
							$gen= $gen." ".$res['gen']." ";
							echo "<br />";
							echo "<span>Plot</span>";
							echo "<br />";
						echo "</a></td>";
				   echo " </tr>";
				echo "</table>";
				if($k==10)
					break;
			}
			?>
        </div>
    </div>
    <div id="sidebar">
        <b>You may also like
        </b>
        <table>
			<?php
			
			$toks=new tokenize($gen);
			$pars=$toks->str;
			$pars="'%".$pars."%'";
			$k=0;
			while($param=$toks->nextToken())
			{
				$pars=" '%".$param."%' " ;
				break;
			}
			$query="select * from movies WHERE gen LIKE ".$pars." AND f_id <> ".$id;
			$con= new connection();
			$con->execQuery($query);
			$k=0;
			while($res=$con->result->fetch_array(MYSQLI_BOTH))
			{
				$k++;
				echo "<tr id='semanticmovie1'>";
					echo "<td><a href='movie.php?id=".$res['f_id']."'>";
							echo "<img src='posters/".$res['f_id'].".jpg' /></a></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td><a href='movie.php?id=".$res['f_id']."'>".$res['ty']."</a></td>";
				echo "</tr>";
					
				if($k>3)
					break;
			}
			?>
        </table>



    </div>
    <div class="footer">
        <a href="#">About</a><a href="#">FAQ</a><a href="#">Credits</a>
    </div>

</body>
</html>
