<!DOCTYPE html>
<html>
<head>
	<title>Rental Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        h1 {
            text-align: center;
            margin-top: 50px;
        }
        
        form {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        form div {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        input[type="radio"] {
            display: none;
        }
        
        input[type="radio"] + label {
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 10px;
        }
        
        input[type="radio"]:checked + label {
            border-color: #007bff;
            color: #007bff;
        }
        
        img {
            display: block;
            width: 100%;
			height: auto;
            margin: 10px auto;
        }
        
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }
        
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        
        #payment-error {
            display: block;
            margin-top: 5px;
            font-size: 14px;
        }
        
        input[type="text"][readonly] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
            color: #666;
            font-weight: bold;
            text-align: center;
        }
        
        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        button[type="submit"]:hover:not([disabled]) {
            background-color: #0069d9;
        }
        
        button[type="submit"]:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
	<h1>Lock & Load!</h1>
	<form action = "Rentals.php" method = "post">
    <input type="hidden" name="myVariable" value="someValue">
		<div>
			<label for="locker-size">Checkout our deals!</label><br>
			<input type="radio" id="small" name="locker-size" value="small" onclick="calculateTotal()"> 
			<label for="small">Small: $4.20 per/day</label>
			<img src="https://www.storageguyz.com/uploaded_images/0ca9ae0f984f191b99e5c690051af071good-30%20(Medium).jpg" alt="Small Locker"><br>
			<input type="radio" id="medium" name="locker-size" value="medium" onclick="calculateTotal()"> 
			<label for="medium">Medium: $9.25 per/day</label>
			<img src="https://www.mapleleafstorage.com/drive/uploads/2015/09/IMG_1113-770x520.jpg" alt="Medium Locker"><br>
			<input type="radio" id="large" name="locker-size" value="large" onclick="calculateTotal()"> 
			<label for="large">Large: 13.75 per/day</label>
			<img src="https://static.seekingalpha.com/cdn/s3/uploads/getty_images/1280808958/image_1280808958.jpg?io=getty-c-crop-4-3" alt="Large Locker"><br>
		</div>
		<br>
		<div>
			<label for="movein-date">Move-in Date:</label>
			<input type="date" id="movein-date" name="movein-date" onchange="calculateTotal()" required>
			<label for="moveout-date">Move-out Date:</label>
			<input type="date" id="moveout-date" name="moveout-date" onchange="calculateTotal()" required>
		</div>
		<br>
		<div>
			<label for="down-payment">Down Payment:</label>
			<input type="number" id="down-payment" name="down-payment" min="0" step="0.01" onchange="validatePayment()" required>
			<span id="payment-error" style="color:red"></span>
		</div>
		<br>
		<div>
			<label for="total-price">Total Price:</label>
			<input type="text" id="total-price" name="total-price" readonly>
		</div>
		<br>
		<button type="submit" id="checkout-btn" name = "checkout-btn" disabled>Checkout</button>
	</form>

	<script>
		function calculateTotal() {
			var lockerPrice = 0;
			var startDate = new Date(document.getElementById("movein-date").value);
			var endDate = new Date(document.getElementById("moveout-date").value);
			var days = (endDate.getTime() - startDate.getTime()) / (1000 * 60 * 60 * 24);
			if (document.getElementById("small").checked) {
				lockerPrice = 4.20;
			} else if (document.getElementById("medium").checked) {
				lockerPrice = 9.25;
			} else if (document.getElementById("large").checked) {
				lockerPrice = 13.75;
			}
			var totalPrice = lockerPrice * days;
			document.getElementById("total-price").value = "$" + totalPrice.toFixed(2);
			if (totalPrice > 0) {
				document.getElementById("checkout-btn").disabled = false;
			} else {
				document.getElementById("checkout-btn").disabled = true;
			}
		}

		function validatePayment() {
			var totalPrice = parseFloat(document.getElementById("total-price").value.slice(1));
			var payment = parseFloat(document.getElementById("down-payment").value);
			if (isNaN(payment) || payment < 0 || payment > totalPrice) {
				document.getElementById("payment-error").innerHTML = "Please enter a valid payment amount.";
				document.getElementById("checkout-btn").disabled = true;
            } 
            else {
                document.getElementById("payment-error").innerHTML = "";
                document.getElementById("checkout-btn").disabled = false;
            }
        }
    </script>
    </body>
</html>