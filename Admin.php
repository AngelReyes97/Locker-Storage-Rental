<?php
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

    if (isset($_POST['admin_login']))
    {
        $username = "admin";
        $password = "Admin123";

        $stmt = $connection->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        // fetch the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row["password"])) {
        // redirect to dashboard
        header("Location: Admin_Dashboard_Form.php");
        exit();
        } else {
        // show error message
        echo "Invalid username or password";
        header("Refresh: 2; URL=Admin_Form.php");
        }
    }
    $connection->close();
}
?>