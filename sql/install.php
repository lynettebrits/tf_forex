<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

function installDb() {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'tf_forex';
    $connection = new mysqli($host, $user, $pass, $database);

    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    return $connection;

    $conn->close();
}

function connection() {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'tf_forex';
    $conn = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conn, $database);

    return $conn;
}

function createProducts() {
    $conn = connection();

    $sql = "CREATE TABLE IF NOT EXISTS products (
product_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
currency VARCHAR (5) DEFAULT NULL,
value FLOAT DEFAULT NULL,
surcharge FLOAT DEFAULT 0,
dateupdated DATETIME,
comment VARCHAR(300) DEFAULT NULL
)";

    if ($conn->query($sql) === TRUE) {
        return $sql;
    } else {
        echo "Error creating products table: " . $conn->error;
    }

    $conn->close();
}

function createUser() {
    $conn = connection();

    $sql = "CREATE TABLE IF NOT EXISTS user (
user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR (45) NOT NULL,
lastname VARCHAR (45) NOT NULL,
email VARCHAR (155) NOT NULL,
password VARCHAR (155) NOT NULL,
comment VARCHAR(300) DEFAULT NULL
)";

    if ($conn->query($sql) === TRUE) {
         return $sql;
    } else {
        echo "Error creating user table: " . $conn->error;
    }

    $conn->close();
}

function createCustomer() {
    $conn = connection();

    $sql = "CREATE TABLE IF NOT EXISTS customer (
customer_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR (45) NOT NULL,
lastname VARCHAR (45) NOT NULL,
email VARCHAR (155) NOT NULL,
password VARCHAR (155) NOT NULL,
cellphone VARCHAR (10) DEFAULT NULL,
comment VARCHAR(300) DEFAULT NULL
)";

    if ($conn->query($sql) === TRUE) {
        return $sql;
    } else {
        echo "Error creating customer table: " . $conn->error;
    }

    $conn->close();
}

function createPromotions() {
    $conn = connection();

    $sql = "CREATE TABLE IF NOT EXISTS promotions (
promotion_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
product_id INT(6) NOT NULL,
value FLOAT DEFAULT NULL,
comment VARCHAR(300) DEFAULT NULL
)";

    if ($conn->query($sql) === TRUE) {
        return $sql;
    } else {
        echo "Error creating promotions table: " . $conn->error;
    }

    $conn->close();
}

function createOrders() {
    $conn = connection();

    $sql = "CREATE TABLE IF NOT EXISTS orders (
order_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
customer_id INT (6) NOT NULL,
product_id INT(6) NOT NULL,
qty FLOAT NOT NULL,
product_value FLOAT NOT NULL,
total FLOAT NOT NULL,
date DATETIME,
paid INT(6) DEFAULT 0,
comment VARCHAR(300) DEFAULT NULL
)";

    if ($conn->query($sql) === TRUE) {
        return $sql;
    } else {
        echo "Error creating orders table: " . $conn->error;
    }

    $conn->close();
}

?>
