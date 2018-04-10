<?php
	session_start(); 

	if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['username']) && !empty($_POST['username'])){
		$_SESSION['account_created'] = "set";
		$password_hash = hash('sha256', $_POST['password']);
		header("Location: login.php");
	}
	else if(isset($_SESSION['registration_submit']) && !empty($_SESSION['registration_submit'])) {
		$error = "There was an error processing your registration.  Please try again or contact an administrator.";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
</head>
<body>
	<div class="error"></div>
	<div class="container">
		<h1>Want to facilitate better communication between your event-goers and live musicians?</h1>
		<p>A host account on _______ will let you do that!  Right now, this service is free for you to use, within our Terms of Service.</p>
	</div>
	<div class="container">

		<!-- <?php if(isset($error) && !empty($error)) : ?>
			<div class="error">
				<?php echo $error; ?>
			</div>
		<?php endif; ?> -->

		<form action="register.php" method="POST">
			<div>
				<label for="username-id" class="text-paragraph">Username:</label>
				<div>
					<input type="text" id="username-id" name="username" placeholder="Username">
				</div>
			</div> 

			<div>
				<label for="password-id" class="text-paragraph">Password:</label>
				<div class="col-sm-9">
					<input type="password" id="password-id" name="password" placeholder="Password">
				</div>
			</div> 

			<div>
				<label for="password-confirm" class="text-paragraph">Confirm Password:</label>
				<div class="col-sm-9">
					<input type="password" id="password-confirm" name="password-confirm" placeholder="Confirm Password">
				</div>
			</div> 
			<div>
				<button type="submit">Register</button>
			</div> 
		</form>
	</div>

	<script type="text/javascript">
		document.querySelector("form").onsubmit = function() {
			var validRegistration = true;
			var username = document.querySelector("#username-id");
			var password = document.querySelector("#password-id");
			var passwordConfirm = document.querySelector("#password-confirm");

			if(password.value != passwordConfirm.value) {
				validRegistration = false;
				createAlert("Your passwords do not match.");
			}
			if(username.value.trim().length == 0) {
				validRegistration = false;
				username.value = "";
				createAlert("Username must not be empty.");
				// Switch class here.
			}
			if(password.value.trim().length == 0) {
				validRegistration = false;
				createAlert("Password must not be empty.");
			}
			if(passwordConfirm.value.trim().length == 0) {
				validRegistration = false;
				createAlert("Confirm password must not be empty.")
			}

			return validRegistration;
		}

		function createAlert(message) {
			var alertDiv = document.createElement("div");
			alertDiv.innerText = message;

			var alertSpan = document.createElement("span");
			alertSpan.innerHTML = "&times;";
			alertSpan.classList.add("closebtn");

			alertSpan.onclick = function() {
				alertDiv.classList.add("close-alert");
			}

			alertDiv.style.setProperty("top", (document.querySelector(".error").childElementCount * 70) + "px");
			console.log(alertDiv.style.top);
			alertDiv.appendChild(alertSpan);
			alertDiv.classList.add("alert");

			document.querySelector(".error").appendChild(alertDiv);
		}

	</script>

</body>
</html>