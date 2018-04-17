<?php

/* * * * * 

	/api/token.php
	Retrieves a Spotify access token by submitting a request to the Spotify API.
	Token must be refreshed every 60 minutes.

* * * * */
	include '../config/config.php';

	session_start();
	date_default_timezone_set('America/Los_Angeles');

	$curl = curl_init();

	$header = array('Authorization: Basic ' . base64_encode(SPOTIFY_CLIENT_ID . ':' . SPOTIFY_SECRET_KEY));

	$request_parameters = array(
		'grant_type' => 'client_credentials'
	);

	curl_setopt_array($curl, array(
		CURLOPT_URL 			=> 	'https://accounts.spotify.com/api/token',
		CURLOPT_HTTPHEADER 		=> 	$header,
		//CURLOPT_SSL_VERIFYPEER 	=> 	false, // why?
		CURLOPT_RETURNTRANSFER 	=> 	true,
		CURLOPT_POST 			=> 	true,
		CURLOPT_POSTFIELDS		=> 	http_build_query($request_parameters)
	));

	$response = curl_exec($curl);
	$response_array = json_decode($response, true);
	if(isset($response_array['error']) && !empty($response_array['error'])) {
		echo "response_error";
		$email_header = "From: " . DEBUG_FROM . "\r\n" . "Content-Type: text/html";
		mail(DEBUG_TO, "[Lucidity] Token Error: " . date("Y-m-d h:i:sa"), $response, $email_header);
	}
	else if(isset($response_array['access_token']) && !empty($response_array['access_token'])){
		$_SESSION['token'] = $response_array['access_token'];
		echo $_SESSION['token'];
	}
	else {
		echo "unknown_issue";
	}
?>