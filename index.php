<?php
	echo 'curl -X "POST" -H "Authorization: Basic '. base64_encode("b140bc470331497c8186640fe20f714f:3ae8624282af461cae06c369ddc9226d").'" -d grant_type=client_credentials https://accounts.spotify.com/api/token';

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
</head>
<body>
	<?php include 'nav.php'; ?>

	<div class="container">
		<!-- form goes here -->

	</div>
</body>
</html>