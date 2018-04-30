<?php

/* * * * * 

	/api/validateEvent
	API function that echos true or false to tell the caller whether or not an event code exists in the database.
	
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

	$sql = "SELECT * FROM events 
			WHERE event_code = '" . $_GET['event_code'] . "';"; 

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	if($results->num_rows <= 0) {
		echo "false";
	}
	else {
		echo "true";
	}

	// Close the connection.
	$mysqli->close();
?>