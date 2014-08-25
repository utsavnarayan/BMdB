
		<?php include( 'header.php');?>
			
				<div class="wrapper">
					<div id="maininfo">
						<?php
		 include("includes/connection.php");
			$gen=" ";
			$id=" ";
			$q=$_GET['query'];
			$querymovie="select * from movie_details WHERE poster =".$q;
			$querycelebtomovie="select * from celeb_movie WHERE movie_id =".$q." order by role";
			$querygenre="select * from genre WHERE movie_id =".$q;
			$queryrating="select * from totalrating WHERE movie_id =".$q;

			
			$con= new connection();
			$con2= new connection();
			$con3= new connection();
			$con4= new connection();
			$con->execQuery($querymovie);
			$con2->execQuery($querycelebtomovie);
			$con3->execQuery($querygenre);
			$con4->execQuery($queryrating);
			$res4=$con4->result->fetch_array(MYSQLI_BOTH);
			$total=$res4['total'];
			$count=$res4['count'];
			
			while($res=$con->result->fetch_array(MYSQLI_BOTH))
			{
			?>
			<table cellpadding="5">
			<tr>
			<td rowspan="3" style="vertical-align: top;">  <?php $_SESSION['pid']=$res['poster'];echo "<img src='posters/".$res['poster'].".jpg' height='300'/>";?></td>
			<td><h1 style="height:36px;"><?php echo $res['title'];?><hr/></h1></td>
			</tr>
			<tr>

			<td class='stars'>
				<b style="font-size:20px;">Rating : </b>
				 	<?php
				//	$i=0;
				//	if($count>0){
				//		for($i=0;$i<($total/$count);$i++)
				//			echo "<span class='rg' id='s".($i+1)."'></span>";
					//}
					//while($i!=10){
					//	echo "<span class='rg' id='s".($i+1)."'></span>";
					//	$i++;
					//}
				 ?>
			<span class='rg' id="s1"></span><span class='rg' id="s2"></span><span class='rg' id="s3"></span><span class='rg' id="s4"></span><span  class='rg' id="s5"></span><span class='rg' id="s6"></span><span class='rg' id="s7"></span><span class='rg' id="s8"></span><span class='rg' id="s9"></span><span class='rg' id="s10"></span> 
				<br/><br/>
			<script>
			
				$(document).ready(function(){
				$('.rg').mouseover(function(){
					var id=$(this).attr('id');
					var h=id.split("s");
					var calc=parseInt(h[1]);
					for(var a=1;a<=calc;a++)
						$('#s'+a).css("background-image","url('img/starglow.png')").hasClass("rg");
				});
				$('.rg').mouseout(function(){
					var id=$(this).attr('id');
					var h=id.split("s");
					var calc=parseInt(h[1]);
					for(var a=1;a<=calc;a++)
						$('#s'+a).css("background-image","url('img/star.png')").hasClass("rg");
				});
				$('.rg').click(function(){
					var id=$(this).attr('id');
					var h=id.split("s");
					var calc=parseInt(h[1]);
					$.ajax({
					  type: "POST",
					  url: "rate.php",
					  data: { rate: calc }
					}).done(function(data) {
						
					  for(var a=1;a<=calc;a++){
						$('#s'+a).css("background-image","url('img/starglow.png')");
						$('#s'+a).removeClass('rg');
						$('#s'+a).addClass('highlight');

					}
					  for(var a=calc+1;a<=10;a++){
						$('#s'+a).removeClass('highlight');	
						}	
					});
				});	
				
			});

			</script>	
				<?php
					$release=$res['release_date'];
					
					$plot=$res['storyline'];
					echo "<b>Release Date :</b> ";
					echo $release;
					
					$year=$res['year'];
					break;
			}
			?><br/><br/>
			<?php
			$duration=$res['duration'];
					echo "<b>Duration :</b> ";
					echo $duration;
					echo " minutes";
			?>
			<br/><br/>
			<?php
			if($res3=$con3->result->fetch_array(MYSQLI_BOTH)){
			$genre=$res3['genre_name'];
					echo "<b>Genre :</b> ";
					echo $genre;
			}
			?>
			</td>
			</tr>
			</table>
				<?php
					if($plot!=''){
						echo '<h3>Plot<hr/></h3><p>';
						echo $plot.'</p>';
					}
				?>
            <hr/>
			<?php include ("youtube.php");
			uquery("trailer",$q);
			uquery("news",$q);
			?>
		
			 <h3>Crew<hr/></h3>
			<table cellpadding="5" class="casttable">
					<thead>
						<tr>
							<td><b><u>Celebrity</u></b></td>
							<td><b><u>Role</u></b></td>
							<td><b><u>Character</u></b></td>
						</tr>
					</thead>
                       
						<?php while($res2=$con2->result->fetch_array(MYSQLI_BOTH))
			{
						echo "<tr><td>";
						$cid=$res2['celeb_id'];
						
						$queryceleb="select * from celebrity WHERE kyfpid =".$cid;
						$con3= new connection();
						$con3->execQuery($queryceleb);
						$res3=$con3->result->fetch_array(MYSQLI_BOTH);
						echo $res3['name'];
						echo "</td><td>";
						echo $res2['role'];
						echo "</td><td>";
						 echo $res2['char_name'];
						
						echo "</td></tr>";
						}?>
                   
			
			</table>
			
			
			<table class="review">
			<form action="" method="get">
                <tr class="reviewhead">
				<h4>Review Panel (not functional)</h4>
                    <td><input type="text" name="title" placeholder="review heading"/></td>
                    <td><input type="text" name="rating" placeholder="rating"/></td>
                </tr>
                <tr>
                    <td colspan="2">
					<textarea rows="5" col="40" placeholder="write review here"></textarea>
					<br/><br/>
<button class="button">Submit Review</button>
                    </td>
                </tr>
				</form>
            </table>
			
           
					</div>
				
					<div id="sidebar">
					<b>Similar Movies
        </b>
        <table>
			<?php
			$j=0;
			$que="select movie_id from genre where genre_name like '".$genre."'";
			$con5= new connection();
			$con5->execQuery($que);
			while($res5=$con5->result->fetch_array(MYSQLI_BOTH)){
					if($j==0){
						$list=$res5['movie_id'];	
						$j=1;
					}
					$list=$list.",".$res5['movie_id'];
			}
			$k=0;
			$year=intval($res['year']);
			
			$mname=$res['title'];
			$similar="select * from movie_details WHERE poster in(".$list.") AND poster <> ".$q." AND year < ".($year+3)." AND year > ".($year-3)." order by year DESC";
			$con4= new connection();
			$con4->execQuery($similar);
			while($res4=$con4->result->fetch_array(MYSQLI_BOTH)){
					echo "<tr>";
					echo "<td><a href='title.php?query=".$res4['poster']."'><img src='posters/".$res4['poster'].".jpg'><br/>".$res4['title']."</a></td>";
					echo "</tr>";
					$k++;
					if($k==5)
						break;
			}
			?>
        </table>



					</div>
				</div>
			
			<?php include( 'footer.php');?>	
	
		
		