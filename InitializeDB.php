<?php
$servername = "localhost:3306";
$username = "root";
$password = "mysql";
$dbname = "Inventory_Management_of_Storage_Lockers";

//create a connection
$connection = new mysqli($servername,$username,$password);

//Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//create the DataBase
$sql_create_database = "CREATE DATABASE IF NOT EXISTS $dbname";

//check the Database created
if ($connection->query($sql_create_database) === FALSE) {
    die("Error creating database: " . $connection->error);
  }
  else {
    echo "DATABASE CREATED.";
    header("Refresh: 2; URL=Welcome.php");
}

$connection->select_db($dbname);


//Create tables if they do not exists
//create user table table
$sql_create_users_table = "CREATE TABLE IF NOT EXISTS users (
    user_id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE (username),
    UNIQUE (phone_number),
    UNIQUE (email)
)";

//check if user table was created
if ($connection->query($sql_create_users_table) === FALSE) {
    die("Error creating user table: " . $connection->error);
}


//create Locker units table
$sql_create_locker_units_table = "CREATE TABLE IF NOT EXISTS locker_units (
    unit_id INT NOT NULL AUTO_INCREMENT,
    size VARCHAR(20) DEFAULT NULL,
    status VARCHAR(30) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    user_id INT DEFAULT NULL,
    first_name VARCHAR(50) DEFAULT NULL,
    last_name VARCHAR(50) DEFAULT NULL,
    phone_number VARCHAR(20) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL,
    balance_owe DECIMAL(10,2) DEFAULT NULL,
    checkin_date DATE DEFAULT NULL,
    checkout_date DATE DEFAULT NULL,
    PRIMARY KEY (unit_id)
)";

// Check if table is created
if ($connection->query($sql_create_locker_units_table) === FALSE) {
    die("Error creating locker untis table: " . $connection->error);
} 
else {
        echo "<br> Locker units table created successfully.";
        // Check if table is empty
        $sql_check_data = "SELECT COUNT(*) AS total_rows FROM locker_units";
        $result = $connection->query($sql_check_data);
        $row = $result->fetch_assoc();
        $total_rows = $row["total_rows"];

        if ($total_rows == 0) {
        // Insert multiple rows into the table
        $sql_insert_data = "INSERT INTO locker_units (unit_id, size, status, price)
                            VALUES (101, 'small', 'available', 4.20), 
                                   (102, 'small', 'available', 4.20), 
                                   (103, 'small', 'available', 4.20), 
                                   (201, 'medium', 'available', 9.25), 
                                   (202, 'medium', 'available', 9.25), 
                                   (203, 'medium', 'available', 9.25), 
                                   (301, 'large', 'available', 13.75), 
                                   (302, 'large', 'available', 13.75), 
                                   (303, 'large', 'available', 13.75);";
                                   
        if ($connection->query($sql_insert_data) === TRUE) {
            echo "<br>Data inserted successfully";
        } else {
            echo "Error: " . $sql_insert_data . "<br>" . $connection->error;
        }
    } 
    else {
        echo "<br>Table already contains data";
    }
}

//create locker rentals table
$sql_create_locker_rental_table = "CREATE TABLE IF NOT EXISTS balances_and_rentals (
    rental_id INT NOT NULL AUTO_INCREMENT,
    unit_id INT DEFAULT NULL,
    user_id INT DEFAULT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    locker_size VARCHAR(10) NOT NULL,
    total_cost DECIMAL(10,2) NOT NULL,
    initial_down_pay DECIMAL(10,2) NOT NULL,
    balance_owe DECIMAL(10,2) NOT NULL,
    last_payment_date DATE NOT NULL,
    locker_checkin_date DATE NOT NULL,
    locker_checkout_date DATE NOT NULL,
    PRIMARY KEY (rental_id)

)";

//check if locker rentals table was created
if ($connection->query($sql_create_locker_rental_table) === FALSE) {
    die("Error creating locker rental table: " . $connection->error);
}

$admin = "CREATE TABLE IF NOT EXISTS admin (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
  )";

if ($connection->query($admin) === FALSE) {
    die("Error creating admin table: " . $connection->error);
}
else {
    // Check if table is empty
    $sql_check_data = "SELECT COUNT(*) AS total_rows FROM admin";
    $result = $connection->query($sql_check_data);
    $row = $result->fetch_assoc();
    $total_rows = $row["total_rows"];

    if ($total_rows == 0) {
        $default_username = 'admin';
        $default_password = 'Admin123';
        $hashed_password = password_hash($default_password, PASSWORD_DEFAULT);
        $insert_query = "INSERT INTO admin (username, password) VALUES ('$default_username', '$hashed_password')";
                               
    if ($connection->query($insert_query) === TRUE) {
        echo "<br> Admin data inserted successfully";
    } else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
    }
} 
else {
    echo "<br> Admin table already contains data";
}
}


//close the connection
$connection->close();

?>