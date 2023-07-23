<?php

$servername = "localhost:3306";
$username = "root";
$password = "mysql";
$dbname = "Inventory_Management_of_Storage_Lockers";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $balance = $_GET['balance'];
    $unit_id = $_GET['unit_id'];
    $amount = $_POST['amount'];
    $new_balance = $balance - $amount;
    $updated_last_payment_date = date('Y-m-d');
    

    //create a connection
    $connection = new mysqli($servername,$username,$password, $dbname);
        
    //Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "UPDATE balances_and_rentals SET balance_owe = '$new_balance', last_payment_date = '$updated_last_payment_date' WHERE unit_id = '$unit_id'";

    if($connection->query($sql) === TRUE) {
        $sql_locker_units = "UPDATE locker_units SET balance_owe = '$new_balance' WHERE unit_id = '$unit_id'";
        
        if($connection->query($sql_locker_units) === TRUE) {
            echo "Payment updated!";
            header("Refresh: 2; URL=Dashboard_Form.php");
        }
        else {
            echo "Error updating unit_table balance: " . $connection->error;
        }
    }
    else {
        echo "Error updating rental table balance: " . $connection->error;
    }

    $connection->close();
}
?>