<?php

/* * * * * 

	/api/updateEvent.php
	API function that lets an administrator update an event
	
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

	$sql = "UPDATE requests 
			SET event_code = '" . $_GET['new_event_code'] . "'
			WHERE event_code = '" . $_GET['old_event_code'] . "';"; 

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	$sql = "UPDATE events 
			SET event_code = '" . $_GET['new_event_code'] . "'
			WHERE event_code = '" . $_GET['old_event_code'] . "';"; 

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// Close the connection.
	$mysqli->close();
	echo "successful_query";

?>