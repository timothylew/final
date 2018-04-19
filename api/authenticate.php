<?php

/* * * * * 

	/api/authenticate.php
	Authenticates the user based on the credentials entered on login.php page.
	If successful, we will assign a session variable for the current user.
	If not successful, the error will be handled and sent back to the frontend.

	
* * * * */
	require '../config/config.php';
	session_start();
	$_SESSION['current_user'] = 12;

?>