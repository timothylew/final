<?php
	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Request Song</title>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="error"></div>
	<div class="container" style="width:70%;"> 
		<form action="event.php" method="POST">
				<div>
					<label for="event-code" class="text-paragraph">Event Code:</label>
					<div style="float:left;">
						<input type="text" id="event-code" name="event-code" placeholder="Event Code" 
						style="height:60px; width:180px; text-align:center;">
					</div>
					<div>
						<p id="code-instruction">To request a song, you must have a 5 character event code. Your event planner will distribute this code.</p>
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
			eventCode.style.setProperty("background-color", "black");
			eventCode.style.setProperty("color", "white");
			var searchDiv = document.createElement("div");
			var searchField = document.createElement("input");
			var searchButton = document.createElement("button");
			searchField.id = "search-field";
			searchButton.id = "search-button";
			searchField.type = "text";
			searchDiv.appendChild(searchField);
			searchButton.innerHTML = "Search";
			searchDiv.appendChild(searchButton);
			document.querySelector("#search-area").appendChild(searchDiv);
			searchButton.onclick = function() {
				loadEventResults(searchField.value);
			}
		}

		function loadEventResults(query) {
			console.log(query);
			if(query.trim().length == 0) {
				createAlert("Search field cannot be empty.", "red");
			}
			else {
				// Make search request here.
				createEventElement("Test Object", "Test Artist", "Test Album", "https://i.scdn.co/image/f2798ddab0c7b76dc2d270b65c4f67ddef7f6718");
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
			request.innerHTML = "Request";

			container.appendChild(songName);
			container.appendChild(artistName);
			container.appendChild(albumName);
			container.appendChild(image);
			container.appendChild(request);

			document.querySelector("#search-results").appendChild(container);
		}

	</script>

</body>
</html>