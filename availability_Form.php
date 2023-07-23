<!DOCTYPE html>
<html>
<head>
<title>Availability Results</title>
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
</head>
<body>
</body>
    <div class="container">
        <h1>Available Lockers</h1>
        <?php
        $servername = "localhost:3306";
        $username = "root";
        $password = "mysql";
        $dbname = "Inventory_Management_of_Storage_Lockers";
        
        //create a connection
        $connection = new mysqli($servername,$username,$password, $dbname);
        
        //Check the connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM locker_units WHERE status = 'available'";
        $result = $connection->query($sql);

        // Display search results as a table
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Unit No.</th><th>Locker Size</th><th>Availability</th><th>Price</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["unit_id"]."</td><td>".$row["size"]."</td><td>".$row["status"]."</td><td>".$row["price"]."</td></tr>";//might want to take this off
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