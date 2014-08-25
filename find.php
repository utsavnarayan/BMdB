<html>
<head>
	<title>BMdB</title>
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<link href="css/results.css" rel="stylesheet" type="text/css">
	<script>
		var data='<?php include("search.php");?>';
	</script>
</head>
<body>
	<?php include('header.php');?>
	<div class="container">
		<section class="search_result">
			<h2>Search Results</h2>
			<span class="info">Results For <b><?php echo $_GET['search'];?></b></span>
			<hr/>
		</section>
	<script src="js/results.js"></script>
	</div>
</body>
</html>