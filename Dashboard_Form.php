<!DOCTYPE html>
<html>
<head>
	<title>Inventory Management of Storage Lockers - Dashboard</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		.container {
			max-width: 1000px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            position: relative;
		}

		h1 {
			font-size: 32px;
			margin-bottom: 20px;
			text-align: center;
		}

		.menu {
			display: flex;
			justify-content: center; /* add this line */
			flex-wrap: wrap;
			margin: 0 -10px;
		}

		.menu-item {
			flex-basis: calc(33.33% - 20px);
			margin: 10px;
			padding: 20px;
			background-color: #f2f2f2;
			box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
			text-align: center;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.menu-item:hover {
			transform: translateY(-5px);
			box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
		}

		.menu-item h2 {
			font-size: 24px;
			margin-bottom: 10px;
		}

		.menu-item p {
			font-size: 16px;
			margin-bottom: 20px;
		}

		.menu-item img {
			width: 100%;
			height: auto;
			margin-bottom: 10px;
		}
        .title h2 {
            text-align: left;
        }
        .title p {
            text-align: center;
            font-weight: bold;
            font-size: 40px;
            color: #007bff;
        }
        .logout {
			position: absolute;
            top: 20px;
            right: 20px;
            text-align: right;
		}
		.logout button {
			background-color: #007bff;
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
		}
		.logout button:hover {
			background-color: #0056b3;
		}
	</style>
    <?php include("Login.php"); ?>
</head>
<body>
	<div class="container">
        <div class = "title">
		<h2>Welcome, <?php echo $_SESSION["first_name"];?>!</h2>
        <p>Store your stuff with us!</p>
        </div>
		<img src="https://irp.cdn-website.com/fb4b557e/dms3rep/multi/526.jpg" alt="Locker Image" style="max-width: 100%; max-height: 100%;">
		<div class="menu">
			<div class="menu-item" id = "rentals">
				<h2>Rentals</h2>
				<p>View and manage locker rentals</p>
				<img src="https://stownest.com/blog/uploads/images/image_750x_62161f88c2005.jpg" alt="Rentals Image">
			</div>
			<div class="menu-item" id = "payment">
				<h2>Make Payment</h2>
				<p>Pay outstanding balance</p>
				<img src="https://www.talk-business.co.uk/wp-content/uploads/2019/05/filadendron-iStock-1.jpg" alt="Payment Image">
			</div>
			<div class="menu-item" id = "availability">
				<h2>Locker Availability</h2>
				<p>View available lockers</p>
				<img src="https://uploads.website.storedge.com/35846e2f-fdf3-4db9-9f74-ae2ab032541d/advantage.jpg" alt="Availability Image">
			</div>
			<div class="menu-item" id = "records">
				<h2>Records</h2>
				<p>View customer records</p>
				<img src="https://www.owneractions.com/wp-content/uploads/2021/12/Depositphotos_26406703_xl-2015-scaled.jpg" alt="Records Image">
			</div>
		</div>
        <div class="logout">
            <form action="Logout.php" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
	</div>
    <script>
        var rentalsMenu = document.getElementById("rentals");
        var paymentsMenu = document.getElementById("payment");
		var availabilityMenu = document.getElementById("availability");
		var RecordsMenu =document.getElementById("records");

        rentalsMenu.addEventListener("click", function() {
            window.location.href = "Rentals_Form.php";
        });

        paymentsMenu.addEventListener("click", function() {
            window.location.href = "Payment_Form.php";
        })

		availabilityMenu.addEventListener("click", function() {
            window.location.href = "availability_Form.php";
        })

		RecordsMenu.addEventListener("click", function() {
            window.location.href = "Records_Form.php";
        })



    </script>
</body>
</html>