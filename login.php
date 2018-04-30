<?php 
	session_start();

	if(isset($_SESSION['current_user']) && !empty($_SESSION['current_user'])) {
		header("Location: dashboard.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/login.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="error"></div>
	<div class="container">
		<h1>Welcome back.</h1>
		<form action="dashboard.php" method="POST">
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
				<button type="submit">Login</button>
			</div> 
		</form>

		<p class="text-paragraph">Don't have a host account? <a href="register.php">Sign Up</a></p>
	</div>

	<script type="text/javascript" src="util.js"></script>
	<script type="text/javascript">
		document.querySelector("form").onsubmit = function() {
			var errorDiv = document.querySelector(".error");
			while(errorDiv.hasChildNodes()) { 
				errorDiv.removeChild(errorDiv.firstChild);
			}
			
			var validLogin = true;
			var username = document.querySelector("#username-id").value;
			var password = document.querySelector("#password-id").value;

			if(username.trim().length == 0) {
				validLogin = false;
				createAlert("Username must not be empty.", "red");
			}
			if(password.trim().length == 0) {
				validLogin = false;
				createAlert("Password must not be empty.", "red");
			}

			// TODO verify login

			if(validLogin) {
				authenticateUser(username, password);
			}

			return false;
		}

		function authenticateUser(username, password) {
			var request = new XMLHttpRequest();
			request.addEventListener("readystatechange", function() {
				if(request.readyState == XMLHttpRequest.DONE) {
					if(request.status == 200) {
						console.log(request.responseText);
						if(request.responseText != "successful_query") {
							createAlert(request.responseText, "red");
						}
						else {
							window.location.replace("dashboard.php");
						}
					}
					else {
						createAlert("AJAX Error " + request.status + ": " + request.statusText, "red");
					}
				}
			});

			request.open("POST", "api/authenticate.php");
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send("username=" + username + "&password=" + password);
		}
	</script>
</body>
</html>

<!--  The conditional scripts must load AFTER HTML resolves. -->
<?php
	if(isset($_SESSION['account_created']) && !empty($_SESSION['account_created'])) {
		echo '<script type="text/javascript" src="util.js"></script>';
		echo '<script type="text/javascript">createAlert("Account successfully created.", "green");</script>';
		session_destroy();
	}
?>