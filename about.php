<?php
	session_start();
?>

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
		<p>My website will serve as a song planning and request system for live DJs - an "eventgoer" user will be able to enter an event ID and request songs that they want to hear at that event using the Spotify Web API.  A "host" user (DJ/party host) will have a screen showing the most requested songs, which allows for easier communication between eventgoers and the DJ.</p>

		<p>There are two intended audiences for this application.  One audience is DJs/Live Musicians who want an easier way to communicate with eventgoers and plan setlists of music.  The other intended audience is eventgoers who would like to provide input on the music selection at a particular event.</p>

		<p>Full CRUD functionality is provided for host users.  They will be able to create, update, and delete event codes.  Retrieval of event codes is also used to prepopulate and dynamically update all dropdowns on the host dashboard ("manage" button).  Eventgoer users will be able to enter an event code and submit song requests for that event.</p>

		<h3>2. Instructions for Demo:</h3>
		<ul>
			<li>Homepage: Simply click on the logo in the nav bar on any page to go here.  This displays simple information about the service.</li>
			<br>
			<li>Login Page: Simply click on the login button in the nav bar.  If you do not have an account, click the Sign Up button under the input fields and fill out the registration form.  You must login to view the host/event management dashboard.</li>
			<br> 
			<li>Register Page: Simply click on the sign up link on the login page to get here.  Fill out all fields (all required) to create your account.  The notification toasts in the top right corner of the screen will let you know about any errors that may arise.</li>
			<br>
			<li>Request Page: Click on the "Request Song" button on the nav bar.  On this page, enter any 5 character code as your event code.  Upon completion of this, a search bar will appear.  Search any song using this input field, and the results will populate underneath.  You may request songs from the results using the Request button that will appear.</li>
			<br>
			<li>Manage Page (Dashboard): Login to the system and click on Manage in the nav bar.  This page will allow you to manage events and requests.  Right now, hard coded values will populate when you click on the "Refresh" buttons or if you select an item from the selects.</li>
		</ul>

		<h3>3. Database:</h3>
		<p>The database will store a user's id, login username, and hashed password in one table (the "users" table).  This data will come from a "host" user who registers for the service. </p>

		<p>There will also be a table in the database ("playlists") that store a playlist name, id, owner id, and a comma separated string of Spotify IDs for songs in the playlist. The "host" user will be able to create playlists by searching for songs through Spotify's API, which will return a list of Spotify song IDs.  The owner id will correspond to the "host" that created the playlist, and that "host" will also supply the playlist name.  </p>

		<p>There will be one last table ("suggestions") that will store an id, owner id, and a comma separated string of Spotify IDs for songs to be requested.  The "eventgoer" user will search for a song to request through Spotify's search API, which returns a Spotify ID.  This Spotify ID will be appended to whatever is already in the comma separated string.</p>

		<h3>4. Database Diagram:</h3>
		<p>A diagram of my database can be found below:</p>
		<img src="img/database_schema.png" width="100%" alt="Database Schema">

		<h3>5. Extras Used:</h3>
		<ul>
			<li><a href="https://developer.spotify.com/web-api/" target="_blank">Spotify Web API</a> - Used the Spotify Web API for the search functionality on the request page.  The endpoints used were the client credentials authentication flow, the search function, and the search using multiple IDs function.</li>
			<br>
			<li><a href="https://developers.google.com/fonts/" target="_blank">Google Fonts</a> - Used to load in the font for all web pages.</li>
			<br>
			<li>Sessions - Used to store data about the current user, and also used to manage the login flow for the site.</li>
			<br>
			<li>Frontend to Backend AJAX (Javascript to PHP) - All database queries and API functionality are stored in the api folder, which is accessed by the frontend through AJAX calls.</li>
			<br>
			<li>PHP Mail Function with HTML-Formatted Email - All API functions have an email function that notifies me if anything goes wrong (ie. error response from API call).</li>
			<img src="img/mail.png" alt="Mail screenshot." style="width:100%; padding-top: 15px;">
		</ul>
	
	</div>
</body>
</html>