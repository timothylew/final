<?php

/* * * * * 

	/api/search.php
	Retrieves a list of tracks by querying the Spotify Web API using the search parameters given.

	
* * * * */

	session_start();

	$curl = curl_init();

	$query = str_replace(" ", "+", $_GET['q']);

	$header = array('Authorization: Bearer ' . $_SESSION['token']);

	// $request_parameters = array(
		
	// );

	curl_setopt_array($curl, array(
		CURLOPT_URL 			=> 	'https://api.spotify.com/v1/search?q=' . $query . '&type=track',
		CURLOPT_HTTPHEADER 		=> 	$header,
		//CURLOPT_SSL_VERIFYPEER 	=> 	false, // why?
		CURLOPT_RETURNTRANSFER 	=> 	true,
		CURLOPT_POST 			=> 	false,
		//CURLOPT_POSTFIELDS		=> 	http_build_query($request_parameters)
	));

	//var_dump(curl_exec($curl));
	$response = curl_exec($curl);
	$response_array = json_decode($response, true);
	
	if(isset($response_array['error']) && !empty($response_array['error'])) {
		echo "response_error";
		$email_header = "From: " . DEBUG_FROM . "\r\n" . "Content-Type: text/html";
		mail(DEBUG_TO, "[Lucidity] Search API Error: " . date("Y-m-d h:i:sa"), $response, $email_header);
	}
	else {
		echo $response;
	}
?>