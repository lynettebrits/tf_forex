<?php

//phpinfo(32);
$conn = mysqli_connect($host = 'localhost', $user = 'root', $pass = '', $database = 'tf_forex');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "UPDATE orders SET paid=1, total={$_GET['grandtotal']} WHERE order_id={$_GET['order_id']}";
$result = $conn->query($sql);
if ($result === false) {
    echo "<p>" . $conn->error . "</p>";
}

$currency = $_GET['currency'];

if ($currency == 'EUR') {
    $sql = "SELECT email FROM customer WHERE customer_id={$_GET['customer_id']} ";
    $result = $conn->query($sql);
    if ($result === false) {
        echo "<p>" . $conn->error . "</p>";
    }
    while ($row = $result->fetch_row()) {
        foreach ($row as $k => $email) {
            $email;
        }
    }
    $email_to = $email;

    $email_subject = "Forex Order Recieved";

    $email_message = "Your order has been recieved. \n\n Form more information please contact us instore.";

    function clean_string($string) {

        $bad = array("content-type", "bcc:", "to:", "cc:", "href");

        return str_replace($bad, "", $string);
    }

// create email headers

    $headers = 'From: ' . 'lynbrits@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    @mail($email_to, $email_subject, $email_message, $headers);
}

header("Location:index.php?forex=paid");
?>

