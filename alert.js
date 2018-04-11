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

	alertDiv.style.setProperty("top", (document.querySelector(".error").childElementCount * 70) + "px");
	alertDiv.style.setProperty("background-color", color);
	console.log(alertDiv.style.top);
	alertDiv.appendChild(alertSpan);
	alertDiv.classList.add("alert");


	document.querySelector(".error").appendChild(alertDiv);
}
