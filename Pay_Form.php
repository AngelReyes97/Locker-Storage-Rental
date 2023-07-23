<!DOCTYPE html>
<html>
<head>
	<title>Payment Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
    * {
	box-sizing: border-box;
}

body {
	background-color: #f7f7f7;
	font-family: Arial, sans-serif;
}

.container {
	margin: 50px auto;
	max-width: 500px;
	padding: 20px;
	background-color: #fff;
	box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
	border-radius: 5px;
	text-align: center;
}

h1 {
	font-size: 32px;
	font-weight: 600;
	margin-top: 0;
	margin-bottom: 30px;
	color: #007bff;
}

.input-group {
	margin-bottom: 20px;
}

.input-group label {
	display: block;
	font-size: 18px;
	font-weight: 500;
	margin-bottom: 10px;
	color: #555;
}

.input-group input[type="number"],
.input-group select {
	display: block;
	width: 100%;
	padding: 10px;
	font-size: 16px;
	border: none;
	border-bottom: 2px solid #ddd;
	background-color: #f5f5f5;
	color: #333;
}

.input-group input[type="number"]:focus,
.input-group select:focus {
	outline: none;
	border-color: #007bff;
}

.buttons {
	margin-top: 30px;
}

.buttons input[type="submit"],
.buttons input[type="button"] {
	display: inline-block;
	padding: 10px 20px;
	font-size: 18px;
	font-weight: 500;
	color: #fff;
	background-color: #007bff;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	transition: background-color 0.2s;
}
.buttons input[type="submit"]:hover,
.buttons input[type="button"]:hover {
	background-color: #0056b3;
}
    </style>
</head>
<body>
	<div class="container">
		<h1>Make Payment</h1>
		<form method="POST" action="Process_payment.php?balance=<?php echo $_GET['balance']; ?>&unit_id=<?php echo $_GET['unit_id']; ?>">
			<input type="hidden" name="unit_id" value="<?php echo $_GET['unit_id']; ?>">
			<div class="input-group">
				<label for="amount">Amount:</label>
				<input type="number" name="amount" min="1"  step="0.01" max="<?php echo $_GET['balance']; ?>" required>
			</div>
			<div class="input-group">
				<label for="method">Payment Method:</label>
				<select name="method" required>
					<option value="">-- Select Payment Method --</option>
					<option value="Credit Card">Credit Card</option>
					<option value="Debit Card">Debit Card</option>
				</select>
			</div>
			<div class="buttons">
				<input type="submit" value="Submit">
				<input type="button" value="Cancel" onclick="location.href='Dashboard_Form.php';">
			</div>
			<div class="message">
				<p>Last Payment Date: <?php echo $_GET['last_pay_date']; ?></p>
				<p>Balance Owed: <?php echo $_GET['balance']; ?></p>
			</div>
		</form>
	</div>
</body>
</html>