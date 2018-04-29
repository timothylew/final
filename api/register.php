<?php

/* * * * * 

	/api/register.php
	Registers user into database and allows them to log in to the host system.
	
* * * * */
	require '../config/config.php';
	session_start();
	
	// DB Connection
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		$password_hash = hash('sha256', $_POST['password']); 

		// Checks to see if there is an error number and then prints out the error
		if($mysqli->connect_errno) {
			echo $mysqli->connect_error;
			exit();
		}

		// Set character encoding
		$mysqli->set_charset('utf8');

		$sql = "INSERT INTO users (username, email, password_hash)
				VALUES('" . $_POST['username'] . "', '" .
					$_POST['email'] . "', '" .
					$password_hash . "');";

		$results = $mysqli->query($sql);
		if(!$results) {
			echo $mysqli->error;
			exit();
		}

		// Close the connection.
		$mysqli->close();
		$_SESSION['account_created'] = "set";
		echo "successful_query";
?>