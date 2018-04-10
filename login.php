<?php
	session_start();

	if(isset($_SESSION['account_created']) && !empty($_SESSION['account_created'])) {
		echo "SET";
		session_destroy();
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
	<div class="container">
		<div class="error">

		</div>
		<form action="login.php" method="POST">
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

	<script type="text/javascript">
		document.querySelector("form").onsubmit = function() {
			var validLogin = true;
			var username = document.querySelector("#username-id").value;
			var password = document.querySelector("#password-id").value;

			if(username.trim().length == 0) {
				validLogin = false;
			}
			if(password.trim().length == 0) {
				validLogin = false;
			}

			return validLogin;
	</script>
</body>
</html>