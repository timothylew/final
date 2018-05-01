<?php

/* * * * * 

	/api/authenticate.php
	Authenticates the user based on the credentials entered on login.php page.
	If successful, we will assign a session variable for the current user.
	If not successful, the error will be handled and sent back to the frontend.

	
* * * * */
	require '../config/config.php';
	session_start();

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// Checks to see if there is an error number and then prints out the error
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Set character encoding
	$mysqli->set_charset('utf8');

	$sql = "SELECT * FROM users 
			WHERE username = '" . $_POST['username'] . "';";


	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	if($results->num_rows <= 0) {
		echo "There are no matching users.";
		exit();
	}

	$row = $results->fetch_assoc();
	if($row['password_hash'] != hash('sha256', $_POST['password'])) {
		echo "Incorrect password.";
		exit();
	} else {
		$_SESSION['current_user'] = $row['user_id'];
	}

	// Close the connection.
	$mysqli->close();
	echo "successful_query";
?>