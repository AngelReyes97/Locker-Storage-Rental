<?php

include("Login.php");
$servername = "localhost:3306";
$username = "root";
$password = "mysql";
$dbname = "Inventory_Management_of_Storage_Lockers";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //create a connection
    $connection = new mysqli($servername,$username,$password,$dbname);

    //Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }


    if(isset($_POST['checkout-btn']))
    //get user input from rentals form
    $down_payment = floatval($_POST["down-payment"]);
    $total_balance = floatval(str_replace("$", "", $_POST["total-price"]));
    $remaining_balance = $total_balance - $down_payment;
    $selected_radio = $_POST['locker-size'];
   
    $Check_in_data = $_POST["movein-date"];
    $Check_out_date = $_POST["moveout-date"];
    $user_id = $_SESSION["user_id"];
    $first_name = $_SESSION["first_name"];
    $last_name = $_SESSION["last_name"];
    $phone = $_SESSION["phone_number"];
    $email = $_SESSION["email"];
    $last_payment_date = date("Y-m-d");

    //find the first available locker if there is one
    $sql_find_locker = "SELECT unit_id FROM locker_units WHERE size='$selected_radio' AND status='available' LIMIT 1";
    
    $result = $connection->query($sql_find_locker);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $locker_id = $row["unit_id"];

        // update the status of the first available locker to occupied
        $sql_update_locker = "UPDATE locker_units SET status='occupied', user_id = '$user_id', first_name = '$first_name', last_name = '$last_name', phone_number = '$phone', email = '$email', balance_owe = '$remaining_balance', checkin_date = '$Check_in_data', checkout_date = '$Check_out_date' WHERE unit_id=$locker_id";

        if ($connection->query($sql_update_locker) === TRUE) {
            echo "Locker $locker_id is now occupied<br>";
            $stmt = $connection->prepare("INSERT INTO balances_and_rentals (unit_id, user_id, first_name, last_name, locker_size, total_cost, initial_down_pay, balance_owe, last_payment_date, locker_checkin_date, locker_checkout_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss",$locker_id, $user_id, $first_name, $last_name, $selected_radio, $total_balance, $down_payment, $remaining_balance, $last_payment_date, $Check_in_data, $Check_out_date);
            if($stmt->execute()) {
                echo "Locker purchased!";
                header("Refresh: 2, URL=Dashboard_Form.php");
        
            }
            else {
                echo "Error inserting item: " . $stmt->error;
            }
            $stmt->close();
        } 
        else {
            echo "Error updating record: " . $connection->error;
        }
    } 
    else {
        echo "No available lockers of size $selected_radio.";
        header("Refresh: 2, URL=Dashboard_Form.php");
    }
    
    $connection->close();
}
?>