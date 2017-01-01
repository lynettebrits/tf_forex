<?php

//phpinfo(32);
if (isset($_POST['firstname'])) {

    $connection = mysqli_connect($host = 'localhost', $user = 'root', $pass = '', $database = 'tf_forex');
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cellphone = $_POST['cellphone'];

    $order_id = $_GET['order_id'];
    $currency = $_GET['currency'];

    $sql = "INSERT INTO customer (firstname, lastname, email, password, cellphone)
	VALUE	('$firstname', '$lastname', '$email', '$password', '$cellphone')";
    $result = $connection->query($sql);
    if ($result === false) {
        echo "<p>" . $connection->error . "</p>";
    }

    $sql = "SELECT LAST_INSERT_ID() FROM customer";
    $result = $connection->query($sql);
    if ($result === false) {
        echo "<p>" . $connection->error . "</p>";
    }
    while ($row = $result->fetch_row()) {
        foreach ($row as $k => $customer_id) {
            $customer_id;
        }
    }

    $sql = "UPDATE orders SET customer_id=$customer_id WHERE order_id=$order_id";
    $result = $connection->query($sql);
    if ($result === false) {
        echo "<p>" . $conn->error . "</p>";
    }
    header("Location:../buy_currency.php?currency=$currency&&order_id=$order_id&&customer_id=$customer_id");
}  