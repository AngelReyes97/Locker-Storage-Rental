
<!DOCTYPE html>
<html>
<head>
<title>Availability Results</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <style>
        .container {
            max-width: 1400px;
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
        .logout {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
</body>
    <div class="container">
    <div class="logout">
            <form action="Admin_Logout.php" method="POST">
                <input type="submit" value="Logout">
            </form>
        </div>
        <h1>Staff Records</h1>
        <?php
            $servername = "localhost:3306";
            $username = "root";
            $password = "mysql";
            $dbname = "Inventory_Management_of_Storage_Lockers";
            // Create a connection
            $connection = new mysqli($servername, $username, $password, $dbname);
        
            // Check the connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
        
            // Query the locker_units table
            $sql = "SELECT * FROM locker_units WHERE status = 'occupied'";
            $result = $connection->query($sql);
        
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Output data of each row in a table
                echo "<table>";
                echo "<tr><th>Unit ID</th><th>Locker Size</th><th>Status</th><th>Price</th><th>User ID</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th><th>Remaining Balance</th><th>Check In</th><th>Check Out</th><th>Change Status</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["unit_id"]."</td><td>".$row["size"]."</td><td>".$row["status"]."</td><td>".$row["price"]."</td><td>".$row["user_id"]."</td><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["phone_number"]."</td><td>".$row["email"]."</td><td>".$row["balance_owe"]."</td><td>".$row["checkin_date"]."</td><td>".$row["checkout_date"]."</td><td><a href='Admin_Edit_Form.php?unit_id=".$row["unit_id"]."'>available</a></td></tr>";
                }
                echo "</table>";
            } else {
                echo "No results found.";
            }
        // Close the connection
        $connection->close();
        ?>
    </div>
</html>
