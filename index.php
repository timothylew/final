<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="error"></div>

	<div class="container">
		<h1>Welcome to the new standard for music communication at events.</h1>
		<!-- <video autoplay muted loop id="video-home">
  			<source src="img/lucidity.mov" type="video/mov">
		</video> -->

	</div>
</body>
</html>

<!--  The conditional scripts must load AFTER HTML resolves. -->
<?php
	if(isset($_SESSION['logout']) && !empty($_SESSION['logout'])) {
		echo '<script type="text/javascript" src="util.js"></script>';
		echo '<script type="text/javascript">createAlert("You have successfully logged out.", "green");</script>';
		session_destroy();
	}
?>