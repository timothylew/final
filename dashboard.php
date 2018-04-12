<?php
	session_start();
	// TODO TEMP REMOVE
	$_SESSION['current_user'] = 12;
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Host Dashboard</title>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container" style="width:75%;">
		<div class="dashboard_top">
			<h2>Event Code:</h2>
			<form action="dashboard.php" method="POST">
				<div>
					<label for="event-id" class="text-paragraph">Event Code:</label>
					<div>
						<input type="text" id="event-id" name="event" placeholder="Event Code">
					</div>
				</div> 
			</form>
		</div>
		<div class="dashboard_left" style="float:left; width:50%;">
			<h2>Plan your DJ set</h2>
			<button style="width:100%">Create new playlist</button>

			<div class="playlist-display">No playlist loaded.</div>
		</div>
		<div class="dashboard_right">
			<h2>Manage Requests</h2>
			<div class="request-display">No requests loaded.</div>
		</div>
		<div class="clear"></div>
	</div>

</body>
</html>