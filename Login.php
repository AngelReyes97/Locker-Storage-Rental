<?php
session_start();

//connect to database
$servername = "localhost:3306";
$username = "root";
$password = "mysql";
$dbname = "Inventory_Management_of_Storage_Lockers";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

     //create a connection
     $connection = new mysqli($servername,$username,$password,$dbname);

     //Check the connection
     if ($connection->connect_error) {
         die("Connection failed: " . $connection->connect_error);
        }

    if (isset($_POST['login']))
    {
        //Get user input
        $username = $_POST["username"];
        $password = $_POST["password"];

        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        // fetch the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row["password"])) {
        // get data from current user login and set session variables
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["last_name"] = $row["last_name"];
        $_SESSION["phone_number"] =$row["phone_number"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["logged_in"] = true;

        // redirect to dashboard
        header("Location: Dashboard_Form.php");
        exit();
        } else {
        // show error message
        echo "Invalid username or password";
        header("Refresh: 2; URL=Login_Form.php");
        }
    }
    $connection->close();
}
?>