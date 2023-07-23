<!DOCTYPE html>
<html>
<head>
	<title>SignUp Page</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f1f1f1;
		}
		form {
			border: 3px solid #f1f1f1;
			background-color: #fff;
			padding: 20px;
			width: 300px;
			margin: 50px auto;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
		}
		input[type=text], input[type=password], [type = tel] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}
		button {
			background-color: #007bff;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
		}
		button:hover {
			opacity: 0.8;
		}
		.container {
			padding: 16px;
		}
		.errorCheck {
			font-size: 40px;
			color: white;
		}
		.center {
			text-align: center;
		}
	</style>
</head>
<body>
	<form action="Signup.php" method="post">
		<h2 class = "center" >SignUp Form</h2>
		<div class="container">
			<div class="errorContainer">
				<p id="errors"><p>
			</div>
			<label for="username"><b>Username</b></label>
			<input id="username" type="text" placeholder="Enter Username" name="username" required>

			<label for="password"><b>Password</b></label>
			<input id="password" type="password" placeholder="Enter Password" name="password" required>

			<label for="password_confirm"><b>Re-Enter Password</b></label>
			<input id="password_confirm" type="password" placeholder="Re-Enter Password" name="password_confirm" required>

			<label for="fname"><b>First Name</b></label>
			<input id="fname" type="text" placeholder="Enter Frist Name" name="fname" required>

			<label for="lname"><b>Last Name</b></label>
			<input id="lname" type="text" placeholder="Enter Last Name" name="lname" required>

            <label for="phoneNumber"><b>phoneNumber</b></label>
			<input id="phoneNumber" type="tel" placeholder="Enter Phone Number" name="phoneNumber" required>

			<label for="email"><b>Email</b></label>
			<input id="email" type="text" placeholder="Enter Email Address" name="email" required>

			<button type="register" name="register">SignUp</button>
		</div>
	</form>
</body>
</html>