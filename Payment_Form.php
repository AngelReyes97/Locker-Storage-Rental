<!DOCTYPE html>
<html>
<head>
<title>Payment Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
            background-color: #f8f8f8;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            text-align: center; /* Center align the container */
        }
        h1 {
            font-size: 28px;
            font-weight: 500;
            margin-top: 0;
        }
        /* Table style */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: 500;
        }
        /* Message style */
        p {
            margin-top: 20px;
        }
        /* Button style */
        input[type="button"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            margin-top: 20px;
            border-radius: 3px;
        }

        input[type="button"]:hover {
            background-color: #0056b3;
        }
    </style>
    <?php include("Login.php"); ?>
</head>
<body>
</body>
    <div class="container">
        <h1>Current Balance(s)</h1>
        <?php
        $servername = "localhost:3306";
        $username = "root";
        $password = "mysql";
        $dbname = "Inventory_Management_of_Storage_Lockers";
        $user_id = $_SESSION["user_id"];
        //create a connection
        $connection = new mysqli($servername,$username,$password, $dbname);
        
        //Check the connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT unit_id, locker_size, total_cost, initial_down_pay, balance_owe, last_payment_date FROM balances_and_rentals WHERE balance_owe <> 0 AND user_id = '$user_id'";
        $result = $connection->query($sql);

        // Display search results as a table
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Unit No.</th><th>Locker Size</th><th>Total Cost</th><th>Initial Down Payment</th><th>Remaining Balance</th><th>Last Payment</th><th>Make Payment</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["unit_id"]."</td><td>".$row["locker_size"]."</td><td>".$row["total_cost"]."</td><td>".$row["initial_down_pay"]."</td><td>".$row["balance_owe"]."</td><td>".$row["last_payment_date"]."</td><td><a href='Pay_Form.php?unit_id=".$row["unit_id"]."&balance=".$row["balance_owe"]."&last_pay_date=".$row["last_payment_date"]."'>Pay</a></td></tr>";//might want to take this off
            }
            echo "</table>";
        } else {
            echo "<p>No results found.</p>";
        }

        $connection->close();
        ?>
        <input type="button" value="Back" onclick="location.href='Dashboard_Form.php';">
    </div>
</html>