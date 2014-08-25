<html>
<head>
	<link href="css/common.css" rel="stylesheet" type="text/stylesheet"/>
	<link href="css/results.css" rel="stylesheet" type="text/stylesheet"/>
</head>
<body>
	<section class="search_result">
		<h2>Movie Name</h2>
		<span class="info">Release Date <b><?php echo $_GET['query'];?></b></span>
		<hr/>
		<?php
			if($_GET['query']!=''){
				echo "<article class='type_title'>";
				echo $_GET['query'];
				echo "</article>";
				echo "<article class='type_title'>";
				echo $_GET['query'];
				echo "</article>";
				echo "<article class='type_celebrity'>";
				echo $_GET['query'];
				echo "</article>";
			}
			else{
				echo "<article>";
				echo "enter something to search";
				echo "</article>";
			}
		?>
	</section>
</body>
</html>