<?php

/* * * * * 

	/api/token.php
	Retrieves a Spotify access token by submitting a request to the Spotify API.
	Token must be refreshed every 60 minutes.
	
* * * * */

	$curl = curl_init();

	$header = array('Authorization: Basic ' . base64_encode("b140bc470331497c8186640fe20f714f:3ae8624282af461cae06c369ddc9226d"));

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

	var_dump(curl_exec($curl));

	//echo 'curl -X "POST" -H "Authorization: Basic '. base64_encode("b140bc470331497c8186640fe20f714f:3ae8624282af461cae06c369ddc9226d").'" -d grant_type=client_credentials https://accounts.spotify.com/api/token';


?>