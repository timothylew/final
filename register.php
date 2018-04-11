<?php
	session_start(); 

	if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['username']) && !empty($_POST['username'])){
		$_SESSION['account_created'] = "set";
		$password_hash = hash('sha256', $_POST['password']);

		// $email = $_POST['email'];
		// $subject = "Welcome to lucidity.";
		// $msg = "Thank you for making your lucidity account.";
		// $headers = "From: noreply@timothylew.com"
		// 		  . "\r\n"
		// 		  . "Content-Type: text/html";

		// if(mail($email, $subject, $msg, $headers)) {
		// 	echo '<script>console.log("Confirmation email sent.");</script>';
		// }
		// else {
		// 	echo '<script>console.log("Confirmation email failed to send.");</script>';
		// }

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
	<?php include 'nav.php'; ?>

	<div class="error"></div>
	<div class="container">
		<h1>Want to facilitate better communication between your event-goers and live musicians?</h1>
		<p>Your free Lucidity host account will allow you to: </p>
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
				<label for="email-id" class="text-paragraph">Email:</label>
				<div>
					<input type="email" id="email-id" name="email" placeholder="Email">
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

	<script type="text/javascript" src="alert.js"></script>

	<script type="text/javascript">
		document.querySelector("form").onsubmit = function() {

			// Remove existing error notifications.
			var errorDiv = document.querySelector(".error");
			while(errorDiv.hasChildNodes()) { 
				errorDiv.removeChild(errorDiv.firstChild);
			}

			var red = "#f44336";
			var validRegistration = true;
			var username = document.querySelector("#username-id");
			var password = document.querySelector("#password-id");
			var passwordConfirm = document.querySelector("#password-confirm");

			if(password.value != passwordConfirm.value) {
				validRegistration = false;
				createAlert("Your passwords do not match.", red);
			}
			if(username.value.trim().length == 0) {
				validRegistration = false;
				username.value = "";
				createAlert("Username must not be empty.", red);
				// Switch class here.
			}
			if(password.value.trim().length == 0) {
				validRegistration = false;
				createAlert("Password must not be empty.", red);
			}
			if(passwordConfirm.value.trim().length == 0) {
				validRegistration = false;
				createAlert("Confirm password must not be empty.", red)
			}

			return validRegistration;
		}

	</script>

</body>
</html>