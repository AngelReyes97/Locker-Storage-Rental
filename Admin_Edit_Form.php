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

    $unit_id = $_GET['unit_id'];
    
    $sql = "UPDATE locker_units SET status = 'available', user_id = NULL, first_name = NULL, last_name = NULL, phone_number = NULL, email = NULL, balance_owe = NULL, Checkin_date = NULL, checkout_date = NULL WHERE unit_id = '$unit_id'";

    if($connection->query($sql) === TRUE) {
        echo "Locker now Available!";
        header("Refresh: 2; URL=Admin_Dashboard_Form.php");
       
    }
    else {
        echo "Error updating locker status: " . $connection->error;
    }
    $connection->close();
?>