<?php
	session_start();
	// TODO TEMP REMOVE
	$_SESSION['current_user'] = 12;
	if(!isset($_SESSION['current_user']) || empty($_SESSION['current_user'])) {
		header("Location: login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/dashboard.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Host Dashboard</title>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container">
		<div class="dashboard_top">
			<h2 style="float:left; text-align: center;">Create an event code:</h2>
			<form action="dashboard.php" method="POST">
				<div>
					<label for="event-id" class="text-paragraph">Event Code:</label>
					<div>
						<input type="text" id="event-id" name="event" placeholder="Event Code">
					</div>
				</div> 
			</form>
		</div>
		<div class="clear"></div>
		<div class="dashboard_top">
			<p style="float:left;">or</p>
		</div>
		<div class="clear"></div>
		<div class="dashboard_top">
			<h2 style="float:left;">Select an existing code: </h2>
			<select class="select-event">
				<option value="">No available events.</option>
			</select>
		</div>
		<div class="clear"></div>
		<div class="dashboard_left" style="float:left; width:40%;">
			<h2>Plan your DJ set</h2>

			<select>
				<option value="">No available playlists.</option>
			</select>

			<button style="width:100%">Create new playlist</button>

			<div class="playlist-display">No playlist loaded.</div>
		</div>
		<div class="dashboard_right">
			<h2>Manage Requests</h2>
			<button>Refresh</button>
			<div class="request-display">No requests loaded.</div>
		</div>
		<div class="clear"></div>
	</div>

</body>
</html>