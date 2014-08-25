
		<?php include( 'header.php');?>
			
				<div class="wrapper">
					<div id="maininfo">
						<?php
		 include("includes/connection.php");
		 include("includes/tokenize.php");
			$gen=" ";
			$id=" ";
			$q=$_GET['query'];
			$queryceleb="select * from celebrity WHERE kyfpid =".$q;
			$con= new connection();
			$con->execQuery($queryceleb);
			$querycelebtomovie="select * from celeb_movie WHERE celeb_id =".$q;
			$con2= new connection();
			$con2->execQuery($querycelebtomovie);
			
			
			while($res=$con->result->fetch_array(MYSQLI_BOTH))
			{
			?>
			<table cellpadding="5">
			<tr>
			<td rowspan="4" style="vertical-align: top;">  <?php echo "<img src='person/".$res['kyfpid'].".jpg' />";?></td>
			<td><h1><?php echo $res['name'];?></h1></td>
			</tr>
			<tr>
			
			<td><?php
					$dob=$res['dob'];
					echo "Date of Birth : ";
					echo $dob;
					
					break;
			}
			?></td>
			</tr>
			</table>
			 <h3>Filmography:</h3><br/>
			<table cellpadding="5" class="casttable">
			<tr style="font-weight:bold;"><td>Movie Name</td><td>Release Date</td><td>Role</td><td>Character Name</td></tr>
                       
						<?php while($res2=$con2->result->fetch_array(MYSQLI_BOTH))
			{
						echo "<tr><td>";
						$mid=$res2['movie_id'];
						
						$querymovie="select * from movie_details WHERE poster =".$mid;
						$con3= new connection();
						$con3->execQuery($querymovie);
						$res3=$con3->result->fetch_array(MYSQLI_BOTH);
						echo '<a href="title.php?query='.$res3['poster'].'">'.$res3['title'].'</a>';
						echo "</td><td>";
						echo $res3['release_date'];
						echo "</td><td>";
						 echo $res2['role'];
						
						echo "</td><td>";
						echo $res2['char_name'];
						
						echo "</td></tr>";
						}?>
                   
			
			</table>
			
			
           
					</div>
				
					<div id="sidebar">
					<b>Similar Celebrities
        </b>
        <table>
			<?php
			$k=0;
			$mn=$res['name'];
			$tok = new tokenize($mn);
			while($param=$tok->nextToken()){
				$similar="select * from celebrity WHERE name LIKE '%".$param."%' AND name <> '".$mn."';";
				$con4= new connection();
				$con4->execQuery($similar);
				while($res4=$con4->result->fetch_array(MYSQLI_BOTH)){
					echo "<tr>";
					echo "<td><a href='celeb.php?query=".$res4['id']."'><img src='person/".$res4['id'].".jpg'><br/>".$res4['name']."</a></td>";
					echo "</tr>";
					$k++;
					if($k==5)
						break;
				}
				if($k==5)
					break;
			}
			?>
        </table>



					</div>
				</div>
			
			<?php include( 'footer.php');?>	
	
		
		