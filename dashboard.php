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
			<select class="select-option event-select">
				<option value="">No available events.</option>
			</select>
		</div>
		<div class="clear"></div>

		<!-- <div class="dashboard_container"> -->


			<div class="dashboard_left">
				<h2>Plan your DJ set</h2>

				<select class="select-option playlist-select">
					<option value="">--Select a playlist--</option>
					<option value="test"> Test item </option>
				</select>

				<button class="create-playlist">Create new playlist</button>

				<div class="playlist-display">No playlist loaded.</div>
			</div>


			<div class="dashboard_right">
				<h2>Manage Requests</h2>
				<button class="request-refresh">Refresh</button>
				<div class="request-display">No requests loaded.</div>
			</div>
		<!-- </div> -->
		<div class="clear"></div>
	</div>

	<script type="text/javascript" src="util.js"></script>
	<script type="text/javascript">
		var eventCode = document.querySelector("#event-id");
		var eventSelect = document.querySelector(".event-select");
		var playlistSelect = document.querySelector(".playlist-select");
		var playlistDiv = document.querySelector(".playlist-display");
		var refreshButton = document.querySelector(".request-refresh");

		// eventCode.oninput = function() {
		// 	console.log(eventCode.value.length);
		// 	if(eventCode.value.length >= 5) {
		// 		eventCode.disabled = true;
		// 		document.querySelector("#code-instruction").innerHTML = "<a href=event.php>Enter a different code.</a>";
		// 		processEventCode(eventCode.value);
		// 	}
		// }

		eventSelect.onchange = function() {
			console.log(eventSelect.value);
			processEventCode(eventSelect.value);
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
			refreshRequests();
		}

		function loadPlaylist(playlist) {
			//Logic to load playlist. For now we have a test object.
			createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "playlist");
			createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "playlist");
		}

		function refreshRequests() {
			document.querySelector(".request-display").innerHTML = ""; // TODO fix this
			//Test objects
			createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "request");
			createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718", "request");
		}

		// function processEventCode(code) {
		// 	//eventCode.classList.add("code-submitted");
		// 	var searchDiv = document.createElement("div");
		// 	var searchField = document.createElement("input");
		// 	var searchButton = document.createElement("button");
		// 	searchField.id = "search-field";
		// 	searchField.placeholder = "Search for a song...";
		// 	searchButton.id = "search-button";
		// 	searchField.type = "text";
		// 	searchDiv.appendChild(searchField);
		// 	searchButton.innerHTML = "Search";
		// 	searchDiv.appendChild(searchButton);
		// 	document.querySelector("#search-area").appendChild(searchDiv);
		// 	searchButton.onclick = function() {
		// 		loadEventResults(searchField.value);
		// 	}
		// }

		// function loadEventResults(query) {
		// 	console.log(query);
		// 	if(query.trim().length == 0) {
		// 		createAlert("Search field cannot be empty.", "red");
		// 	}
		// 	else {
		// 		// Make search request here.
		// 		createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718");
		// 	}
		// }

		function createEventElement(song, artist, album, imageURL, type) {
			// for each result, we must call this function
			var container = document.createElement("div");
			var songName = document.createElement("h3");
			var artistName = document.createElement("p");
			var albumName = document.createElement("p");
			var image = document.createElement("img");
			var request = document.createElement("button");
			songName.innerHTML = song;
			artistName.innerHTML = artist;
			albumName.innerHTML = album;
			image.src = imageURL;
			image.style.setProperty("width", "100px");
			request.innerHTML = "Request";

			var songInformation = document.createElement("div");
			songInformation.appendChild(songName);
			songInformation.appendChild(artistName);
			songInformation.appendChild(albumName);
			songInformation.classList.add("list-item");

			image.style.float = "left";
			image.classList.add("list-item");

			request.style.float = "left";
			request.classList.add("request");
			request.classList.add("list-item");

			request.onclick = function() {
				this.innerHTML = "Requested";
				this.classList.add("requested");
			}

			container.appendChild(request);
			container.appendChild(image);
			container.appendChild(songInformation);

			container.classList.add("list-object");

			if(type == "request") {
				document.querySelector(".request-display").appendChild(container);

			}
			else if(type == "playlist"){
				document.querySelector(".playlist-display").appendChild(container);
			}
		}
	</script>

</body>
</html>