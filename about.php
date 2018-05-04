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
			<li>Request Page: Click on the "Request Song" button on the nav bar.  Note that this button will not appear if you are logged in, as request functionality is available for eventgoer users.  If you would like to make requests to an event, please do so before logging in, or do it in an incognito browser.  On this page, enter any 5 character code as your event code.  Upon the entry of a valid code, a search bar will appear (Note: only logged in host users can create a code from the dashboard).  Search for any song using this input field, and the results will populate underneath.  You may request songs from the results using the Request button that will appear.  This request will now show up on a host user's dashboard when the host user looks at requests from this event.</li>
			<br>
			<li>Manage Page (Dashboard): Login to the system and click on Manage in the nav bar.  Note that the manage tab will not appear until you have logged in.  This page will allow you to manage events and requests.  You may create an event code (must be 5 characters exactly), update the name of an event code, delete an event code, and view the requests associated with an event code on this dashboard page.</li>
		</ul>
		<p><em><strong>Recommended Demo Flow:</strong></em></p>
		<ol>
			<li>Navigate to the register page and create an account.</li>
			<li>Login to the account you just made.</li>
			<li>Create an event code on the manage page/dashboard.</li>
			<li>Logout</li>
			<li>Click on the request tab and enter the event code you just created.</li>
			<li>Search for a song and click the request button on a few of these songs.</li>
			<li>Login to your account again and go to the dashboard.</li>
			<li>Under manage requests, select your event code and the requests you entered should appear.</li>
			<li>Now, you can play around and update the event code name, delete the event code along with all associated requests, or you could delete individual requests using the 'x' button on the request rows too.</li>
			<li>Feel free to contact me at lewt@usc.edu or lucidity@timothylew.com if you encounter any issues with demoing or grading.</li>
		</ol>
		<p><em>If you would like to use and play around with an already existing account, try username: "test", password: "test".</em></p>

		<h3>3. Database:</h3>
		<p>The database will store a user's id, login username, email, and hashed password in one table (the "users" table).  This data will come from a "host" user who registers for the service through the registration page. </p>

		<p>There will also be a table in the database ("events") that stores event codes that have been created, and the user id of the user that created each event code.  This data is populated when a host user creates an event code from the dashboard.  These event codes can also be updated and deleted by the owner of the event code.</p>

		<p>There will be one last table ("requests") that will store a request id, event code, song id (given by Spotify Web API), and frequency.  The "eventgoer" user will search for a song to request (on the request/event page) through Spotify's search API, which returns a Spotify ID for each song.  This Spotify ID will be put in the database alongside the event code that the "eventgoer" user provided.  The request id is a unique identifier for each request (auto increment).  If a request in the database matches a request being made (same event code and same song id), the frequency of the existing record will be incremented instead of the addition of an additional record.</p>

		<h3>4. Database Diagram:</h3>
		<p>A diagram of my database can be found below:</p>
		<img src="img/database_schema.png" width="100%" alt="Database Schema">

		<h3>5. Extras Used:</h3>
		<ul>
			<li><a href="https://developer.spotify.com/web-api/" target="_blank">Spotify Web API</a> - Used the Spotify Web API for the search functionality on the request page.  This API is also what allows us to render songs under the manage page for the host users.  The endpoints used were the client credentials authentication flow, the search function, and the search using multiple IDs function.</li>
			<br>
			<li><a href="https://developers.google.com/fonts/" target="_blank">Google Fonts</a> - Used to load in the font for all web pages.</li>
			<br>
			<li>Sessions/Cookies - Used to store data about the current user, and also used to manage the login flow for the site.  This usage of sessions and cookies allows us to have different user permission levels as well.</li>
			<br>
			<li>Frontend to Backend AJAX (Javascript to PHP) - All database queries and API functionality are stored in pure PHP files in the api folder of my project, which is accessed by the frontend through AJAX calls.</li>
			<br>
			<li>PHP Mail Function with HTML-Formatted Email - Some of the key API functions have an email function that notifies me if anything goes wrong (ie. error response from API call).  This helps me debug and solve issues that may arise with the system.</li>
			<img src="img/mail.png" alt="Mail screenshot." style="width:100%; padding-top: 15px;">
		</ul>

		<h3><a href="https://303.itpwebdev.com/~lewt/assignment10/proposal.html">Final Project Proposal</a></h3>
	
	</div>
</body>
</html>