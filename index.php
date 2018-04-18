<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/home.css">
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
		<a href="#about">Learn More</a>

	</div>

	<div id="about">
		<h2>Streamlined communication with Lucidity.</h2>
		<div class="about-left">
			<h2>For eventgoers...</h2>
			<p>If you're an eventgoer, say goodbye to your trips to the DJ booth. With Lucidity, you can request the songs you want without leaving your friends. At events powered by Lucidity, your event organizers will distribute a really short code. All you have to do to have your voice be heard is go to our <a href=event.php>request page</a>, enter your code, and search for the songs you want to hear. Your songs will be sent directly to the DJ's dashboard, who will then evaluate the request.  It's that easy.</p>
			<button class="request-button">Request a song</button>
		</div>
		<div class="about-right">
			<h2>For event hosters...</h2>
			<p>If you're an event planner, you know how out of control it can get when you have herds of people coming up to the DJ booth.  Let's make your event a safer and better experience for your guests by preventing the stage rush.  Event music management with Lucidity is free, and it digitizes the process of communication with your musical performer.</p>
			<button class="register-button">Register as a host</button>
		</div>
		<div class="clear"></div>
	</div>

	<div id="contact">
		<h2>Have questions? Get in touch with us.</h2>
		<p>Made for DJs, by a <a href="https://www.soundcloud.com/lewcidmusic" target="_blank">DJ.</a>

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