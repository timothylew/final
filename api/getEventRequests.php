<?php

/* * * * * 

	/api/getEventRequests.php
	API function that lets users retrieve the requested songIDs given for a single event.
	
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

	$sql = "SELECT * FROM requests
			WHERE event_code = '" . $_GET['event_code'] . "';";

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// Close the connection.
	$mysqli->close();

	$array = array();

	while($row = $results->fetch_assoc()) {
		array_push($array, $row);
	}
	echo json_encode($array);
?>