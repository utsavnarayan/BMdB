
		<?php include( 'header.php');?>
			
				<div class="wrapper">
					<div id="maininfo">
						<?php
		 include("includes/connection.php");
			$gen=" ";
			$id=" ";
			$q=$_GET['query'];
			$querymovie="select * from movie_details WHERE poster =".$q;
			$queryceleb="select * from celeb_movie WHERE movie_id =".$q;
			$con= new connection();
			$con2= new connection();
			$con->execQuery($querymovie);
			$con2->execQuery($queryceleb);
			$con3=connection::execQuery($queryceleb);
			 $tush=$con3->rows[1]["role"];
			 echo $tush;
			 $tush2=$con->result->num_rows;
			echo $tush2;
			die();
			while($res=$con->result->fetch_array(MYSQLI_BOTH))
			
			
			{
			?>
            <table cellpadding="10">
                <tr>
                    <td rowspan="5" class="poster">
                        <?php echo "<img src='posters/".$res['poster'].".jpg' />";?>
                    </td>
                    <td class="movietitle"><h1><?php echo $res['title'];?></h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Rating :</b> ************ (x/10) <a href="">Write a review</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Crew :</b>
						<?php while($res2=$con2->result->fetch_array(MYSQLI_BOTH))
			{
						$celebid=$res2['celeb_id'];
						
						
						
						
						
						 echo $res2['char_name'];
						 echo "<br/>";
						}?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Plot Summary:</b>
                    </td>
                </tr>
            </table>
					</div>
				
					<div id="sidebar">
					
					</div>
				</div>
			
			<?php include( 'footer.php');?>	
	
		
			<?php
					$release=$res['release_date'];
					$duration=$res['duration'];
					$year=$res['year'];
					break;
			}
			?>
            <table class="review">
                <tr>
                    <td>Review Heading</td>
                    <td>People found useful</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>Jim Morrison being by far my favorite front man of all-time, I could fill up several pages here with my thoughts.  This is especially true given one of the main reasons I am such a fan is because of his ever poetic lyrics.  If I were to choose just a couple lines, they would have to come from the Soft Parade. Jim lashed out at the 50's establishment of his upbringing every chance he could and we all know his thoughts on organized religion. There is just something about the following lines that seem to be a microcosm of Mr. Mojo's anti authority belief system. </p>
                    </td>

                </tr>
            </table>
            <table class="review">
                <tr>
                    <td>Review Heading</td>
                    <td>People found useful</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>Jim Morrison being by far my favorite front man of all-time, I could fill up several pages here with my thoughts.  This is especially true given one of the main reasons I am such a fan is because of his ever poetic lyrics.  If I were to choose just a couple lines, they would have to come from the Soft Parade. Jim lashed out at the 50's establishment of his upbringing every chance he could and we all know his thoughts on organized religion. There is just something about the following lines that seem to be a microcosm of Mr. Mojo's anti authority belief system. </p>
                    </td>

                </tr>
            </table>
            <table class="review">
                <tr>
                    <td>Review Heading</td>
                    <td>People found useful</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>Jim Morrison being by far my favorite front man of all-time, I could fill up several pages here with my thoughts.  This is especially true given one of the main reasons I am such a fan is because of his ever poetic lyrics.  If I were to choose just a couple lines, they would have to come from the Soft Parade. Jim lashed out at the 50's establishment of his upbringing every chance he could and we all know his thoughts on organized religion. There is just something about the following lines that seem to be a microcosm of Mr. Mojo's anti authority belief system. </p>
                    </td>

                </tr>
            </table>
        </div>
    </div>
    <div id="sidebar">
        <b>Similar Movies
        </b>
        <table>
			<?php
			$query="select * from movie_details WHERE gen LIKE '".$gen."' AND f_id <> ".$id;
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
