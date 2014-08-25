
		<?php include( 'header.php');?>
			
				<div class="wrapper">
					<div id="maininfo">
			<?php include("includes/connection.php");
			?>
			
			
			 <table cellpadding="10">
                <tr>
                    <td rowspan="5" class="poster">
                        <img src="user/add.jpg" />
                    </td>
                    <td class="celebtitle"><h1><?php  
						echo $_SESSION['uname'];
					?> </h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Date of Birth :</b><?php  
						echo $_SESSION['udob'];
					?> 
                    </td>
                </tr>
				<tr>
                    <td>
                        <b>E mail Id:</b><?php  
						echo $_SESSION['uemail'];
					?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>About  :</b><?php  
						echo $_SESSION['uabout'];
					?> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Administratorship : </b>
                        <?php  
                         if( $_SESSION['uadmin']==-1)
                            echo "Super Administrator";
                         if( $_SESSION['uadmin']==0)
                            echo "Normal User";
                         if( $_SESSION['uadmin']==1)
                            echo "Yes";
                    ?> 
                    </td>
                </tr>
            </table>
<?php
 if( $_SESSION['uadmin']==-1)
 {
include("superadmin.php");
}
?>



         <!--    <h3><b>Recently Reviewed:</b></h3>
<table class="review">
                <tr class="reviewhead">
                    <td>It is a perfect entertainment package.</td>
                    <td>12 People found this useful.</td>
                </tr>
                <tr>
                    <td colspan="2">
					<h4>This is sample review and is not dynamic....People need to add reviews to be shown here</h4>
                        <p>Nikhat Kazmi of The Times of India gave the film 4 out of 5 stars and said, "It is a classic action/crime thriller that doesn't let go, even for a moment." Filmfare gave the film 4 out of 5 stars, stating that "Had it not been for actor's performance, the film would not have been half as good." Omar Qureshi from Zoom gave the film 3.5 out of 5 stars and praised the superlative action. Komal Nahta gave the film 3.5 out of 5 stars and said that "It is a winner all the way." Taran Adarsh of Bollywood Hungama gave the film 3.5 stars out of 5, concluding that, "On the whole, It rides on star power and brand value. The film has a bland first hour, but the second half takes the film to another level." Oneindia.in also gave the film a 3.5 and said "It is a perfect entertainment package." Dainik Bhaskar gave the film 3 out of 5 stars and concluded saying, "It is a perfect combination of style with substance. Definitely a one-time watch for one and all." </p>
                    </td>

                </tr>
            </table>	 -->
<br/><br/>	
	   
		   
					</div>
				
					<div id="sidebar">
					<!--  <b>Recent Favorites</b>
        <table>

            <tr id="semanticmovie1">
                <td>
                    <img src="img/demo/mughal.jpg" /></td>
            </tr>
            <tr>
                <td>Mughal-e-Azam</td>
            </tr>
            
        </table> -->



					</div>
				</div>
			
			<?php include( 'footer.php');?>	