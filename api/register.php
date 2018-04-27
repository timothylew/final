<?php

/* * * * * 

	/api/register.php
	Registers user into database and allows them to log in to the host system.
	
* * * * */
	require '../config/config.php';
	session_start();
	
	// DB Connection
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		hash('sha256', $_POST['password']); //TODO

		// Checks to see if there is an error number and then prints out the error
		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		// Set character encoding
		$mysqli->set_charset('utf8');


		$sql = "INSERT INTO users (username, email, password_hash)
				VALUES('" . $_POST['username'] . "', " .
					$genre_id . ", " .
					$rating_id . ", " .
					$label_id . ", " . 
					$format_id . ", " .
					$sound_id;

		if($nullAward) {
			$sql = $sql . ", " . $award . ", "; 
		}
		else {
			$sql = $sql . ", '" . $award . "', "; 
		}

		if($release_date == "null") {
			$sql = $sql . $release_date;
		}
		else {
			$sql = $sql . "DATE'" . $release_date . "'";
		}
					
		$sql = $sql . ");";

		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
			exit();
		}

		// Close the connection.
		$mysqli->close();

?>