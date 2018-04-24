<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About</title>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<style>
		.container {
			width: 90%; 
		}
	</style>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container">
		<div class="row">
			<h1>Final Project Documentation and Summary</h1>
			<p class="col-12 mb-4"><em>Timothy Lew, lewt@usc.edu</em></p>
		</div> <!-- .row -->
	</div> <!-- .container -->
	
	<div class="container">
		<h3>1. Topic and Purpose:</h3>
		<p>My website will serve as a song planning and request system for live DJs - an "eventgoer" user will be able to enter an event ID and request songs that they want to hear at that event using the Spotify Web API.  A "host" user (DJ/party host) will have a screen showing the scheduled playlist alongside the most requested songs, which allows for easier communication between eventgoers and the DJ.</p>

		<h3>2. Audience:</h3>
		<p>There are two intended audiences for this application.  One audience is DJs/Live Musicians who want an easier way to communicate with eventgoers and plan setlists of music.  The other intended audience is eventgoers who would like to provide input on the music selection at a particular event.</p>

		<h3>5. Database:</h3>
		<p>The database will store a user's id, login username, and hashed password in one table (the "users" table).  This data will come from a "host" user who registers for the service. </p>

		<p>There will also be a table in the database ("playlists") that store a playlist name, id, owner id, and a comma separated string of Spotify IDs for songs in the playlist. The "host" user will be able to create playlists by searching for songs through Spotify's API, which will return a list of Spotify song IDs.  The owner id will correspond to the "host" that created the playlist, and that "host" will also supply the playlist name.  </p>

		<p>There will be one last table ("suggestions") that will store an id, owner id, and a comma separated string of Spotify IDs for songs to be requested.  The "eventgoer" user will search for a song to request through Spotify's search API, which returns a Spotify ID.  This Spotify ID will be appended to whatever is already in the comma separated string.</p>

		<h3>6. Database Diagram:</h3>
		<p>A diagram of my database can be found below:</p>
		<img src="img/database_schema.png" width="700px" alt="Database Schema">
	
	</div>
</body>
</html>