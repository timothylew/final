<?php

/* * * * * 

	/api/retrieveSeveralTracks.php
	Retrieves several tracks by querying the Spotify Web API using a list of Spotify song IDs.
	You MUST know the song IDs beforehand - this is NOT a normal search query.
	Maximum: 50IDs at a time.

	
* * * * */
	include '../config/config.php';

	session_start();

	$curl = curl_init();

	$header = array('Authorization: Bearer ' . $_SESSION['token']);

	curl_setopt_array($curl, array(
		CURLOPT_URL 			=> 	'https://api.spotify.com/v1/tracks/?ids=' . $_GET['ids'],
		CURLOPT_HTTPHEADER 		=> 	$header,
		//CURLOPT_SSL_VERIFYPEER 	=> 	false, // why?
		CURLOPT_RETURNTRANSFER 	=> 	true,
		CURLOPT_POST 			=> 	false,
	));

	$response = curl_exec($curl);
	$response_array = json_decode($response, true);
	
	if(isset($response_array['error']) && !empty($response_array['error'])) {
		echo "response_error";
		$email_header = "From: " . DEBUG_FROM . "\r\n" . "Content-Type: text/html";
		mail(DEBUG_TO, "[Lucidity] RetrieveSeveral API Error: " . date("Y-m-d h:i:sa"), $response, $email_header);
	}
	else {
		echo $response;
	}
?>