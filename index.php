
		<?php include( 'header.php');?>
			
				<div class="wrapper">
					<div id="maininfo">
						<h3>
						<img src="img/bmdb.png"/ style="margin-bottom: -7px;margin-right:8px ;"> is the
							<i>
								biggest
							</i>
							database of bollywood movies and celebrities.
						</h3>
						<h4>
							Search here for all the information regarding bollywood and its masala.
						</h4>
						<div id="trailers">
							<div>
								<iframe width="550" height="300" src="http://www.youtube.com/embed/GLkHTl_Ct4E" frameborder="0" allowfullscreen>
								</iframe>
							</div>
							<div><p>
								Back in action... DHOOM:2 reinvents the action comedy genre and propels it into the 21st century. Ali?s (Uday Chopra) dream of becoming a police officer has come true. He is now ACP Jai Dixit?s (Abhishek
								Bachchan) right hand man. Together they are trying to keep a tight leash on the crime in India, little do they know what they are going to be up against.	Back in action... DHOOM:2 reinvents the action comedy genre and propels it into the 21st century. Ali?s (Uday Chopra) dream of becoming a police officer has come true. He is now ACP Jai Dixit?s (Abhishek
								Bachchan) right hand man. Together they are trying to keep a tight leash on the crime in India, little do they know what they are going to be up against.</p>
							</div>
						
							<div>
								<iframe width="550" height="300" src="http://www.youtube.com/embed/_X5w-6PqoZ0" frameborder="0" allowfullscreen>
								</iframe>
							</div>
							<div><p>
								Having conquered the Asian underworld, Don (Shah Rukh Khan) now has his sights set on European domination. In his way are the bosses of the existing European underworld and all law enforcement agencies. The action shifts from Kuala Lumpur to Berlin as Don must avoid assassination or arrest, whichever comes first, in order for his plan to succeed.</p>
							</div>
						</div>
					</div>
				
				<div id="sidebar">
					<span>
						Coming Soon
					</span>
					<table>
						<thead>
							<tr>
								<th style="width: 145px;">
									Movie
								</th>
								<th>
									Release Date
								</th>
							</tr>
						</thead>
						<tbody>
                    <?php
                    include("includes/connection.php");
$con = new Connection();
$res=$con->execQuery("select * FROM `coming_soon`");

while($row = mysqli_fetch_array($res))
  {
  $mid= $row['movie_id'];
  $res1=$con->execQuery("select * FROM `movie_details` where poster='".$mid."' order by year");
  $row1 = mysqli_fetch_array($res1);
  echo "<tr>";
  echo "<td>" . $row1['title'] . "</td>";
  echo "<td>" . $row1['release_date'] . "</td>";
  echo "</tr>";
  }
$con->closeConnection();

?>
    
						</tbody>
					</table>                
                    
                    	<span>
					In Theaters
					</span>
					<table>
						<thead>
							<tr>
								<th style="width: 200px;">
									Movie
								</th>
								<th>
									Rating
								</th>
							</tr>
						</thead>
						<tbody>
                    <?php
                  $con1 = new Connection();
$res=$con1->execQuery("select * FROM `in_theaters`");

while($row = mysqli_fetch_array($res))
  {
  $mid= $row['movie_id'];
  $res1=$con1->execQuery("select * FROM `movie_details` where poster='".$mid."'");
  
  $row1 = mysqli_fetch_array($res1);
  echo "<tr>";
  echo "<td>" . $row1['title'] . "</td>";
  echo "<td>" . $row['rating'] . "</td>";
  echo "</tr>";
  }
$con1->closeConnection();

?>
    
						</tbody>
					</table>  
				
				</div>
				</div>
			
			<?php include( 'footer.php');?>	
	