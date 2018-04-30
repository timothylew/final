function createAlert(message, color) {
	console.log(message);
	var alertDiv = document.createElement("div");
	alertDiv.innerText = message;

	var alertSpan = document.createElement("span");
	alertSpan.innerHTML = "&times;";
	alertSpan.classList.add("closebtn");

	alertSpan.onclick = function() {
		alertDiv.classList.add("close-alert");
	}

	alertDiv.style.setProperty("top", 80 + (document.querySelector(".error").childElementCount * 70) + "px");
	alertDiv.style.setProperty("background-color", color);
	console.log(alertDiv.style.top);
	alertDiv.appendChild(alertSpan);
	alertDiv.classList.add("alert");


	document.querySelector(".error").appendChild(alertDiv);
}



// AJAX Functions:

/*
	0 = UNSENT
	1 = OPENED
	2 = HEADERS_RECEIVED
	3 = LOADING
	4 = DONE
*/

function refreshToken() {
	var request = new XMLHttpRequest();
	request.addEventListener("readystatechange", function() {
		if(request.readyState == XMLHttpRequest.DONE) {
			if(request.status == 200) {
				if(request.responseText == "response_error") {
					createAlert("Spotify token validation error - An administrator has been notified", "red");
				}
				// Otherwise, request resolved properly.
				console.log(request.responseText);
			}
			else {
				createAlert("AJAX Error " + request.status + ": " + request.statusText, "red");
			}
		}
	});
	request.open("POST", "api/token.php"); // this might need to be a GET.
	request.send();
}

function lookupTrack(query, code, callback) {
	var spotifyQuery = "?q=" + query.replace(" ", "+");
	console.log(spotifyQuery);
	var request = new XMLHttpRequest();
	request.addEventListener("readystatechange", function() {
		if(request.readyState == XMLHttpRequest.DONE) {
			if(request.status == 200) {
				//console.log(request.responseText);
				callback(JSON.parse(request.responseText), code);
			}
			else {
				createAlert("AJAX Error " + request.status + ": " + request.statusText, "red");
			}
		}
	});
	request.open("GET", "api/search.php" + spotifyQuery);
	request.send();
}

function retrieveSeveralTracks(idList, callback) {
	//refreshToken(); TODO need to figure out token authenticity somehow
	var spotifyQuery = "?ids=" + idList;
	var request = new XMLHttpRequest();
	request.addEventListener("readystatechange", function() {
		if(request.readyState == XMLHttpRequest.DONE) {
			if(request.status == 200) {
				//console.log(request.responseText);
				callback(JSON.parse(request.responseText));
			}
			else {
				createAlert("AJAX Error " + request.status + ": " + request.statusText, "red");
			}
		}
	});
	request.open("GET", "api/retrieveSeveralTracks.php" + spotifyQuery);
	request.send();
}

function getEventRequests(eventCode, callback) {
	var request = new XMLHttpRequest();
	request.addEventListener("readystatechange", function() {
		if(request.readyState == XMLHttpRequest.DONE) {
			if(request.status == 200) {
				console.log(request.responseText);
				callback(JSON.parse(request.responseText));
			}
			else {
				createAlert("AJAX Error " + request.status + ": " + request.statusText, "red");
			}
		}
	});
	request.open("GET", "api/getEventRequests.php?event_code=" + eventCode);
	request.send();
}