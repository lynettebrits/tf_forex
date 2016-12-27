<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$database = "tf_forex";
$products = "products";
$user = "user";
$customer = "customer";
$promotions = "promotions";
$orders = "orders";

$conn = new mysqli($servername, $username, $password, $database);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
echo "Connected successfully <br />";

$sql = "CREATE TABLE IF NOT EXISTS $products (
product_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
currency VARCHAR (5) DEFAULT NULL,
value FLOAT DEFAULT NULL,
dateupdated DATETIME,
comment VARCHAR(300) DEFAULT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Products created successfully <br />";
} else {
    echo "Error creating products table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS $user (
user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR (45) NOT NULL,
lastname VARCHAR (45) NOT NULL,
email VARCHAR (155) NOT NULL,
password VARCHAR (155) NOT NULL,
comment VARCHAR(300) DEFAULT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table User created successfully <br />";
} else {
    echo "Error creating user table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS $customer (
customer_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR (45) NOT NULL,
lastname VARCHAR (45) NOT NULL,
email VARCHAR (155) NOT NULL,
password VARCHAR (155) NOT NULL,
cellphone VARCHAR (10) DEFAULT NULL,
comment VARCHAR(300) DEFAULT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Customer created successfully <br />";
} else {
    echo "Error creating customer table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS $promotions (
promotion_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
product_id INT(6) NOT NULL,
value FLOAT DEFAULT NULL,
comment VARCHAR(300) DEFAULT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Promotions created successfully <br />";
} else {
    echo "Error creating promotions table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS $orders (
order_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
customer_id INT (6) NOT NULL,
product_id INT(6) NOT NULL,
product_value FLOAT NOT NULL,
total DECIMAL NOT NULL,
date DATETIME,
comment VARCHAR(300) DEFAULT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Orders created successfully <br />";
} else {
    echo "Error creating orders table: " . $conn->error;
}

$conn->close();
?>
