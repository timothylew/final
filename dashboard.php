<?php
	session_start();
	if(!isset($_SESSION['current_user']) || empty($_SESSION['current_user'])) {
		header("Location: login.php");
	}
	else {
		require 'config/config.php';

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

		// Close the connection.
		$mysqli->close();
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
	<div class="error"></div>
	<div class="container">
		<table>
			<tr>
				<td class="dashboard-left">
					<div class="dashboard-manage-events">
						<p style="font-size: 20px; padding-top: 20px; color: black;">Create Event Code</p>
						<form action="dashboard.php" method="POST">
							<div>
								<label for="event-id" class="text-paragraph">Event Code:</label>
								<div>
									<input type="text" id="event-id" name="event" placeholder="Event Code">
								</div>
							</div> 
						</form>
						<button class="create-code">Submit</button>
						<!-- <table class="manage-event">
							<tr>
								<td><h2>Create an event code:</h2></td>
								<td class="input-cell">
									<form action="dashboard.php" method="POST">
									<div>
										<label for="event-id" class="text-paragraph">Event Code:</label>
										<div>
											<input type="text" id="event-id" name="event" placeholder="Event Code">
										</div>
									</div> 
									</form>
								</td>
							</tr>
							<tr>
								<td><h2>Select an existing code:</h2></td>
								<td class="input-cell">
									<select class="select-option event-select">
										<option value="">No available events.</option>
									</select>
								</td>
							</tr>
						</table> -->
					
					</div>
				</td>
			

			<!-- <div class="dashboard_container"> -->

				<td class="dashboard-right">
					<div class="dashboard-manage-requests">
						<p style="font-size: 20px; padding-top: 20px; color: black;">Manage Requests</p>
						<!-- <table style="width: 70%;">
							<tr>
								<td><p>Select an event code:</p></td>
								<td class="input-cell">
									<select class="select-option event-select">
										<option value="">No available events.</option>
									</select>
								</td>
							</tr>
						</table> -->
						<div>
							<select class="select-option event-select">
								<option value="">--Select event code--</option>
								<?php while($row = $results->fetch_assoc()) : ?>
									<option value="<?php echo $row['event_code']; ?>">
										<?php echo $row['event_code']; ?>
									</option>
								<?php endwhile; ?>
							</select>
						</div>
						<div>
							<button class="request-refresh">Refresh</button>
						</div>
						<div class="request-display">No requests loaded.</div>
					</div>
					<div class="dashboard-manage-playlists">
						<p style="font-size: 20px; padding-top: 20px; color: black;">Playlists</p>

						<select class="select-option playlist-select">
							<option value="">--Select a playlist--</option>
							<option value="test"> Test item </option>
						</select>

						<!-- <button class="create-playlist">Create new playlist</button> -->

						<div class="playlist-display">No playlist loaded.</div>
					</div>
				</td>
			</tr>
		</table>
		<!-- </div> -->
		<div class="clear"></div>
	</div>

	<script type="text/javascript" src="util.js"></script>
	<script type="text/javascript">
		var eventCode = document.querySelector("#event-id");
		var createEvent = document.querySelector(".create-code");
		var eventSelect = document.querySelector(".event-select");
		var playlistSelect = document.querySelector(".playlist-select");
		var playlistDiv = document.querySelector(".playlist-display");
		var refreshButton = document.querySelector(".request-refresh");

		eventCode.onkeydown = function(event) {
			console.log(eventCode.value.length);
			if(eventCode.value.length >= 5 && (event.keyCode != 8 && event.keyCode != 46)) {
				// Prevent the user from typing in more than 5 characters.
				return false;
			}
		}

		createEvent.onclick = function() {
			var errorDiv = document.querySelector(".error");
			while(errorDiv.hasChildNodes()) {
				errorDiv.removeChild(errorDiv.firstChild);
			}
			console.log(eventCode.value);
			if(eventCode.value.length < 5) {
				createAlert("Code must be 5 characters long.", "red");
			}
			else {
				insertEvent(eventCode.value);
			}
		}

		eventSelect.onchange = function() {
			console.log(eventSelect.value);
			refreshRequests(eventSelect.value);
		}

		playlistSelect.onchange = function() {
			console.log(playlistSelect.value);
			if(playlistSelect.value.length == 0) {
				playlistDiv.innerHTML = "No playlist selected.";
			}
			else {
				playlistDiv.innerHTML = "";
				loadPlaylist(playlistSelect.value);
			}
		}

		refreshButton.onclick = function() {
			refreshRequests(eventSelect.value);
		}

		function loadPlaylist(playlist) {
			//Logic to load playlist. For now we have a test object.
			createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "playlist");
			createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "playlist");
		}

		function refreshRequests(code) {
			document.querySelector(".request-display").innerHTML = ""; // TODO fix this
			//Test objects

			if(code != "") {
				// createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "request");
				// createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "request");
				getEventRequests(code, refreshRequestsCallback);
			}
		}

		function refreshRequestsCallback(results) {
			console.log(results);
			//TODO implement logic to split into sets of 50 later...
			if(results.length > 0) {
				var spotifyQuery = "";
				for(var i = 0; i < results.length; i++) {
					spotifyQuery += results[i]['song_id'];
					if(i != results.length - 1) {
						spotifyQuery += ",";
					}
				}

				console.log(spotifyQuery);
				retrieveSeveralTracks(spotifyQuery, retrieveTracksCallback);
			}
			else {
				var noResults = document.createElement("p");
				noResults.innerHTML = "No requests at the moment.";
				document.querySelector(".request-display").appendChild(noResults);
			}
		}

		function retrieveTracksCallback(results) {
			console.log(results);
			var resultsArray = results.tracks;
			if(resultsArray.length <= 0) {
				var noResults = document.createElement("p");
				noResults.innerHTML = "No requests at the moment.";
				document.querySelector(".request-display").appendChild(noResults);
			}
			for(var i = 0; i < resultsArray.length; i++) {
				var artistString = "";
				for(var j = 0; j < resultsArray[i].album.artists.length; j++) {
					artistString += resultsArray[i].album.artists[j].name;
					if(j != resultsArray[i].album.artists.length - 1) {
						artistString += ", ";
					}
				}
				createEventElement(resultsArray[i].name, artistString, resultsArray[i].album.name, resultsArray[i].album.images[0].url, "request");
			}
		}

		function createEventElement(song, artist, album, imageURL, type) {
			// for each result, we must call this function
			// for each result, we must call this function
			var container = document.createElement("div");
			var songName = document.createElement("p");
			var artistName = document.createElement("p");
			var albumName = document.createElement("p");
			var image = document.createElement("img");
			var dismiss = document.createElement("span");
			var table = document.createElement("table");
			var row = document.createElement("tr");
			var column1 = document.createElement("td");
			var column2 = document.createElement("td");
			var column3 = document.createElement("td");
			songName.innerHTML = song;
			artistName.innerHTML = artist;
			albumName.innerHTML = album;
			image.src = imageURL;
			image.classList.add("list-image");
			dismiss.innerHTML = "&times;";
			dismiss.classList.add("dismiss-button");

			var songInformation = document.createElement("div");
			songInformation.appendChild(songName);
			songInformation.appendChild(artistName);
			songInformation.appendChild(albumName);
			songInformation.classList.add("list-item");

			image.style.float = "left";
			songInformation.style.float = "left";
			image.classList.add("list-item");

			dismiss.onclick = function() {
				container.classList.add("remove-item");
			}

			column1.appendChild(image);
			column2.appendChild(songInformation);
			column3.appendChild(dismiss);
			column1.classList.add("column1");
			column2.classList.add("column2");
			column3.classList.add("column3");


			row.appendChild(column1);
			row.appendChild(column2);
			row.appendChild(column3);

			table.appendChild(row);

			container.appendChild(table);

			container.classList.add("list-object");

			if(type == "request") {
				document.querySelector(".request-display").appendChild(container);

			}
			else if(type == "playlist"){
				document.querySelector(".playlist-display").appendChild(container);
			}
		}

		function insertEvent(code) {
			var request = new XMLHttpRequest();
			request.addEventListener("readystatechange", function() {
				if(request.readyState == XMLHttpRequest.DONE) {
					if(request.status == 200) {
						if(request.responseText == "successful_query") {
							createAlert("Code successfully created.", "green");
						}
						else {
							createAlert(request.responseText, "red");
						}
					}
					else {
						createAlert("AJAX Error " + request.status + ": " + request.statusText, "red");
					}
				}
			});
			request.open("GET", "api/createEvent.php?event_code=" + code);
			request.send();
		}


	</script>

</body>
</html>