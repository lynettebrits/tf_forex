<?php

function connection($host = 'localhost', $user = 'root', $pass = '', $database = 'tf_forex') {
    $conn = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conn, $database);

    return $conn;
}

//phpinfo(32);
if (isset($_POST["promoval"])) {
    $conn = connection();

    $row_count = count($_POST['promoval']);
    $values = array();
    for ($i = 0; $i < $row_count; $i++) {
        // variable sanitation...
        $promoval = trim(stripslashes($_POST['promoval'][$i]));
        $currency = trim(stripslashes($_POST['currency'][$i]));
        $values[] = '(' . $promoval . ', ' . $currency . ')';

        foreach ($_POST['promoval'] as $key => $j) {
            $sql = "SELECT product_id FROM products WHERE currency='$currency' ORDER BY product_id DESC";
            $result = $conn->query($sql);
            if ($result === false) {
                echo "<p>" . $conn->error . "</p>";
            }
            while ($row = $result->fetch_row()) {
                foreach ($row as $k => $product_id) {
                    $product_id;
                }
            }

            $query = "UPDATE promotions SET value = $promoval WHERE currency = '$currency'";
            $result = $conn->query($query);
            if ($result === false) {
                echo "<p>" . $conn->error . "</p>";
            }
        }
    }

    header("Location:dashboard.php");
}
?>
