<?php
	session_start();
	require '../config/config.php';

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// Checks to see if there is an error number and then prints out the error
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	// Set character encoding
	$mysqli->set_charset('utf8');

	$sql = "SELECT * FROM events 
			WHERE owner_id = '" . $_SESSION['current_user'] . "';"; 

	$results = $mysqli->query($sql);
	if(!$results) {
		echo $mysqli->error;
		exit();
	}
	
	$array = array();

	while($row = $results->fetch_assoc()) {
		array_push($array, $row);
	}

	echo json_encode($array);

	// Close the connection.
	$mysqli->close();

?>