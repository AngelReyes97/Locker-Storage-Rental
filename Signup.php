<?php

$servername = "localhost:3306";
$username = "root";
$password = "mysql";
$dbname = "Inventory_Management_of_Storage_Lockers";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //create a connection
    $connection = new mysqli($servername,$username,$password,$dbname);

    //Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    //get user input from Sign Up Form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];
    $first_name = $_POST["fname"];
    $last_name = $_POST["lname"];
    $phone_number = $_POST["phoneNumber"];
    $email = $_POST["email"];

    //Begin by checking if username, Phone Number, or email already exists
    // Prepare the SQL statement with placeholders
    $sql = "SELECT * FROM users WHERE username=? OR phone_number=? OR email=?";
    // Prepare the statement
    $stmt = $connection->prepare($sql);
    // Bind the user input to the placeholders
    $stmt->bind_param("sss", $username, $phone_number, $email);
    // Bind the user input to the placeholders
    $stmt->execute();
    // Fetch the results
    $results = $stmt->get_result();
    //close the statement
    $stmt->close();

    //if result returns at least 1 than there is a user that already exists
    if($results->num_rows > 0) { 
        echo "Username, Phone Number, or email already exists.";
        header("Refresh: 2; URL=Signup_Form.php");
    }
    else { //otherwise no user was found hop to the next step by checking if passwords match
        if ($password != $password_confirm) {
            echo "Passwords do not match.";
            header("Refresh: 1; URL=Signup_Form.php");
        }
        else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); //hash the password

            // Insert the user into the database
            $sql = "INSERT INTO users (username, password, first_name, last_name, phone_number, email)
            VALUES (?, ?, ?, ?, ?, ?)";
            
            //prepare the statement
            $stmt = $connection->prepare($sql);
            //bind the values to the placeholders in a way that prevents SQL injection values are strings
            $stmt->bind_param("ssssss", $username, $hashed_password, $first_name, $last_name, $phone_number, $email);

            if ($stmt->execute()) {
                // User successfully created
                echo "Registration Successful!";
                header("Refresh: 1; URL=Welcome.php");
            }
            else {
                // Error creating user
                echo "Error creating user.";
                header("Refresh: 1; URL=Signup_Form.php");
            }
            $stmt->close(); //close the connection
        }
    }
    $connection->close(); //close the connection
}

?>