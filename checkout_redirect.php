<?php

$connection = mysqli_connect($host = 'localhost', $user = 'root', $pass = '', $database = 'tf_forex');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "UPDATE orders SET paid=1 WHERE order_id={$_GET['order_id']}";
$result = $connection->query($sql);
if ($result === false) {
    echo "<p>" . $conn->error . "</p>";
}
header("Location:index.php?forex=paid");
?>

