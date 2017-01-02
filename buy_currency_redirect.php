<?php

function connection($host = 'localhost', $user = 'root', $pass = '', $database = 'tf_forex') {
    $conn = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysql_select_db($database);
    return $conn;
}

//phpinfo(32);
if (isset($_POST["currency"])) {
    $currency = $_POST["currency"];
    header("Location:buy_currency.php?currency=$currency");
}

if (isset($_POST["calc_input"])) {
    $connection = connection();


    $value = $_POST["calc_value"];
    $qty = $_POST["calc_input"];
    $total = $_POST["calc_total"];

    $currency = $_GET['currency'];

    $sql = "INSERT INTO orders (product_id, product_value, qty, total, date)
	VALUE	($currency, $value, $qty, $total, NOW())";
    $result = $connection->query($sql);
    if ($result === false) {
        echo "<p>" . $connection->error . "</p>";
    }
    
    $sql = "SELECT LAST_INSERT_ID() FROM orders";
    $result = $connection->query($sql);
    if ($result === false) {
        echo "<p>" . $connection->error . "</p>";
    }
    while ($row = $result->fetch_row()) {
        foreach ($row as $k => $order_id) {
            $order_id;
        }
    }
    header("Location:buy_currency.php?currency=$currency&&order_id=$order_id");
}
?>
