<?php

/* * * * * 

	/api/deleteEvent.php
	API function that lets an administrator delete an event
	
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

	$sql = "DELETE FROM events
			WHERE event_code = '" . $_GET['event_code'] . "';";

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	$sql = "DELETE FROM requests 
			WHERE event_code = '" . $_GET['event_code'] . "';"; 

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// Close the connection.
	$mysqli->close();
	echo "successful_query";

?>