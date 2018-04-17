<?php
	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/event.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Request Song</title>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="error"></div>
	<div class="container" style="width:70%;"> 
		<h1 style="text-align: center;"> Request a Song </h1>
		<form action="event.php" method="POST">
				<div class="event-input">
					<label for="event-code" class="text-paragraph">Event Code:</label>
					<div>
						<input type="text" id="event-code" name="event-code" placeholder="Event Code" 
						style="height:50px; width:180px; text-align:center;">
					</div>
					<div>
						<p id="code-instruction">
							You may obtain an event code from your event planner. <br> <br>
							You must enter this code in the field above.
						</p>
					</div>
				</div> 
		</form>
		<div id="search-area"></div>
		<div id="search-results"></div>
	</div>

	<script type="text/javascript" src="util.js"></script>
	<script type="text/javascript">
		var eventCode = document.querySelector("#event-code");
		eventCode.oninput = function() {
			console.log(eventCode.value.length);
			if(eventCode.value.length >= 5) {
				eventCode.disabled = true;
				document.querySelector("#code-instruction").innerHTML = "<a href=event.php>Enter a different code.</a>";
				processEventCode(eventCode.value);
			}
		}

		function processEventCode(code) {
			eventCode.classList.add("code-submitted");
			var searchDiv = document.createElement("div");
			var searchField = document.createElement("input");
			var searchButton = document.createElement("button");
			searchField.id = "search-field";
			searchField.placeholder = "Search for a song...";
			searchButton.id = "search-button";
			searchField.type = "text";
			searchDiv.appendChild(searchField);
			searchButton.innerHTML = "Search";
			searchDiv.appendChild(searchButton);
			document.querySelector("#search-area").appendChild(searchDiv);
			searchButton.onclick = function() {
				loadEventResults(searchField.value);
			}

			refreshToken(); //TODO
		}

		function loadEventResults(query) {
			console.log(query);
			if(query.trim().length == 0) {
				createAlert("Search field cannot be empty.", "red");
			}
			else {
				//refreshToken(); // Do this?
				var results = lookupTrack(query, loadEventResultsCallback);
				//console.log("RESULTS:" + results);
				// Make search request here.
				//createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718");
			}
		}

		function loadEventResultsCallback(results) {
			console.log(results);
			var resultsArray = results.tracks.items;
			for(var i = 0; i < resultsArray.length; i++) {
				createEventElement(resultsArray[i].name, "Artist", resultsArray[i].album.name, resultsArray[i].album.images[0].url);
				//console.log(resultsArray[i].name);
			}

		}

		function createEventElement(song, artist, album, imageURL) {
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

			document.querySelector("#search-results").appendChild(container);
		}

	</script>

</body>
</html>