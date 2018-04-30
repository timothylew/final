<?php

/* * * * * 

	/api/submitRequest.php
	API function that lets users submit song requests to a specific event code.
	
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
			WHERE event_code = '" . $_GET['event_code'] . "'
			AND song_id = '" . $_GET['songID'] . "';";

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	if($results->num_rows <= 0) {
		$sql = "INSERT INTO requests(event_code, song_id, frequency)
			VALUES('" . $_GET['event_code'] . "', '" . $_GET['songID'] . "', 1);";
	}
	else {
		$row = $results->fetch_assoc();
		$sql = "UPDATE requests 
				SET frequency = " . ($row['frequency'] + 1) . "
				WHERE request_id = " . $row['request_id'] . ";"; 
	}



	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}

	// Close the connection.
	$mysqli->close();
	echo "successful_query";

?>