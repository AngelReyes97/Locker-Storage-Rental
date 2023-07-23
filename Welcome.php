<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page</title>
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
		input[type=text], input[type=password] {
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
	<form method="post">
		<h2 class = "center" >Welcome!</h2>
		<div class="container">
			<div class="errorContainer">
				<p id="errors"><p>
			</div>
            <button type="submit" formaction="Login_Form.php" formmethod="post">Login</button>
            <button type="submit" formaction="SignUp_Form.php" formmethod="post">SignUp</button>
			<button type="submit" formaction="Admin_Form.php" formmethod="post">Admin Login</button>
			<button type="submit" formaction="InitializeDB.php" formmethod="post">Initialize Database</button>
		</div>
	</form>
</body>
</html>