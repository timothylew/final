<?php

/* * * * * 

	/api/search.php
	Retrieves a list of tracks by querying the Spotify Web API using the search parameters given.

	
* * * * */

	session_start();

	$curl = curl_init();

	$header = array('Authorization: Bearer ' . $_SESSION['token']);

	$request_parameters = array(
	);

	curl_setopt_array($curl, array(
		CURLOPT_URL 			=> 	'',
		CURLOPT_HTTPHEADER 		=> 	$header,
		//CURLOPT_SSL_VERIFYPEER 	=> 	false, // why?
		CURLOPT_RETURNTRANSFER 	=> 	true,
		CURLOPT_POST 			=> 	true,
		CURLOPT_POSTFIELDS		=> 	http_build_query($request_parameters)
	));

	var_dump(curl_exec($curl));

	//echo 'curl -X "POST" -H "Authorization: Basic '. base64_encode("b140bc470331497c8186640fe20f714f:3ae8624282af461cae06c369ddc9226d").'" -d grant_type=client_credentials https://accounts.spotify.com/api/token';


?>