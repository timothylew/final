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
	<div class="container"> 
		<h1> Request a Song </h1>
		<form action="event.php" method="POST">
				<div class="event-input">
					<label for="event-code" class="text-paragraph">Event Code:</label>
					<div>
						<input type="text" id="event-code" name="event-code" placeholder="Event Code">
					</div>
					<div>
						<p id="code-instruction">
							You may obtain a 5-character event code from your event planner. <br> <br>
							You must enter this code in the field above.
						</p>
					</div>
				</div> 
		</form>
		<div id="search-area"></div>
		<div class="clear"></div>
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
			searchField.onkeydown = function(event) {
				if(event.keyCode == 13) {
					loadEventResults(searchField.value);
				}
			}
			refreshToken(); //TODO
		}

		function loadEventResults(query) {
			var errorDiv = document.querySelector(".error");
			while(errorDiv.hasChildNodes()) {
				errorDiv.removeChild(errorDiv.firstChild);
			}

			var resultsDiv = document.querySelector("#search-results");
			while(resultsDiv.hasChildNodes()) {
				resultsDiv.removeChild(resultsDiv.firstChild);
			}

			console.log(query);
			if(query.trim().length == 0) {
				createAlert("Search field cannot be empty.", "red");
			}
			else {
				//refreshToken(); // Do this?
				var loadingIcon = document.createElement("img");
				loadingIcon.src = "img/loadIcon.gif";
				loadingIcon.classList.add("load-icon");
				resultsDiv.appendChild(loadingIcon);
				var results = lookupTrack(query, loadEventResultsCallback);
			}
		}

		function loadEventResultsCallback(results) {
			console.log(results);
			document.querySelector("#search-results").removeChild(document.querySelector(".load-icon"));
			var resultsArray = results.tracks.items;
			if(resultsArray.length <= 0) {
				var noResults = document.createElement("p");
				noResults.innerHTML = "No results found";
				document.querySelector("#search-results").appendChild(noResults);
			}
			for(var i = 0; i < resultsArray.length; i++) {
				var artistString = "";
				for(var j = 0; j < resultsArray[i].album.artists.length; j++) {
					artistString += resultsArray[i].album.artists[j].name;
					if(j != resultsArray[i].album.artists.length - 1) {
						artistString += ", ";
					}
				}
				createEventElement(resultsArray[i].name, artistString, resultsArray[i].album.name, resultsArray[i].album.images[0].url);
			}

		}

		function createEventElement(song, artist, album, imageURL) {
			// for each result, we must call this function
			var container = document.createElement("div");
			var songName = document.createElement("p");
			var artistName = document.createElement("p");
			var albumName = document.createElement("p");
			var image = document.createElement("img");
			var request = document.createElement("button");
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
			request.innerHTML = "Request";

			var songInformation = document.createElement("div");
			songInformation.appendChild(songName);
			songInformation.appendChild(artistName);
			songInformation.appendChild(albumName);
			songInformation.classList.add("list-item");

			image.style.float = "left";
			songInformation.style.float = "left";
			image.classList.add("list-item");

			request.classList.add("request");
			request.classList.add("list-item");

			request.onclick = function() {
				this.innerHTML = "Requested";
				this.classList.add("requested");
				// sendRequest()
			}

			column1.appendChild(image);
			column2.appendChild(songInformation);
			column3.appendChild(request);
			column1.classList.add("column1");
			column2.classList.add("column2");
			column3.classList.add("column3");


			row.appendChild(column1);
			row.appendChild(column2);
			row.appendChild(column3);

			table.appendChild(row);

			container.appendChild(table);

			container.classList.add("list-object");

			document.querySelector("#search-results").appendChild(container);
		}

		function sendRequest() {

		}

	</script>

</body>
</html>