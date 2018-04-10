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
	<div class="container-center">
		<div class="error">

		</div>
		<form action="login.php" method="POST">
			<div>
				<label for="username-id" class="text-paragraph">Username:</label>
				<div>
					<input type="text" id="username-id" name="username">
				</div>
			</div> 

			<div>
				<label for="password-id" class="text-paragraph">Password:</label>
				<div class="col-sm-9">
					<input type="password" id="password-id" name="password">
				</div>
			</div> 

			<div>
				<div>
					<button type="submit">Login</button>
				</div>
			</div> 
		</form>

		<p class="text-paragraph">Don't have an account? <a href="register.html">Sign Up</a></p>
	</div>
</body>
</html>