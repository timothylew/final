<?php
	session_start(); 

	if(isset($_POST['password']) && !empty($_POST['password'])){
		$_SESSION['account_created'] = "set";
		$password_hash = hash('sha256', $_POST['password']);
		header("Location: login.php");
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
	<div class="container">
		<h1>Want to facilitate better communication between your event-goers and live musicians?</h1>
		<p>A host account on _______ will let you do that!  Right now, this service is free for you to use, within our Terms of Service.</p>
	</div>
	<div class="container">
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
			var username = document.querySelector("#username-id").value;
			var password = document.querySelector("#password-id").value;
			var passwordConfirm = document.querySelector("#password-confirm").value;

			if(password != passwordConfirm) {
				validRegistration = false;
			}
			if(username.trim().length == 0) {
				validRegistration = false;
			}
			if(password.trim().length == 0) {
				validRegistration = false;
			}
			if(passwordConfirm.trim().length == 0) {
				validRegistration = false;
			}

			return validRegistration;
		}

	</script>

</body>
</html>