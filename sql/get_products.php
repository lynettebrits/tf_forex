<?php
include 'form_functions.php';

function connection($host = 'localhost', $user = 'root', $pass = '', $database = 'tf_forex')
{
    $conn = mysqli_connect($host, $user, $pass, $database);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysql_select_db($database);
    return $conn;
}

function getCurrency() 
{
    $conn = connection();
    
    $sql = "SELECT currency, value FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC;";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='curr_table'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["currency"] . "</td>" . "<td>" .  textBoxFunctionReadonly('calc_value', $row["value"], 'update(this);')  . "</td>";
            echo "<td>" . textBoxFunction('calc_input', '', 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('calc_total', $row["value"], 'update(this);') ."</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function currencySelect()
{
    $connection = connection();
    $queryCurrency = "SELECT product_id, currency FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC;";
    $resultOne = mysqli_query($connection, $queryCurrency);
    while ($row = mysqli_fetch_array($resultOne)) {
        $resArrOne[] = $row;
    }
    return $resArrOne;
}

function fetchCurrency() 
{
    $conn = connection();
    
    $sql = "SELECT currency, value FROM products WHERE product_id={$_GET['currency']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='curr_fetch'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["currency"] . "</td>" . "<td>" .  textBoxFunctionReadonly('calc_value', $row["value"], 'update(this);')  . "</td>";
            echo "<td>" . textBoxFunction('calc_input', '', 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('calc_total', $row["value"], 'update(this);') ."</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function confirmOrder() 
{
    $conn = connection();
    
    $sql = "SELECT products.currency as currency, product_value, total FROM orders INNER JOIN products ON products.product_id=orders.product_id WHERE order_id={$_GET['order_id']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='confirm_order'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["currency"] . "</td>" . "<td>" .  $row["product_value"]  . "</td>";
            echo "<td>" . $row['total']/$row['product_value'] . "</td>" . "<td>" . $row["total"] ."</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}
?>