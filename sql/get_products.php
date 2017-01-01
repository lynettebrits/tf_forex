<?php
include 'form_functions.php';

//function connection($host = 'localhost', $user = 'root', $pass = '', $database = 'tf_forex')
//{
//    $conn = mysqli_connect($host, $user, $pass, $database);
//    if (mysqli_connect_errno()) {
//        echo "Failed to connect to MySQL: " . mysqli_connect_error();
//    }
//    mysql_select_db($database);
//    return $conn;
//}

function getCurrency() 
{
    $conn = connection();
    
    $sql = "SELECT currency, value, surcharge FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC;";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='curr_table'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Surcharge (%)</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["currency"] . "</td>" . "<td>" .  textBoxFunctionReadonly('calc_value', $row["value"], 'update(this);')  . "</td>";
            echo "<td>" . textBoxFunction('calc_input', '', 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('surchage', $row['surcharge'], 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('calc_total', $row["value"], 'update(this);') ."</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function randsAvailable() 
{
    $conn = connection();
    
    $sql = "SELECT currency, value, surcharge FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC;";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='zar_table'>";
        echo "<tr><th>ZAR Available</th><th>Currency</th><th>Value</th><th>Surcharge (%)</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . textBoxFunction('zar_input', '', 'calculate(this);') . "</td>" . "<td>" . $row["currency"] . "</td>" . "<td>" .  textBoxFunctionReadonly('zar_value', $row["value"], 'update(this);')  . "</td>";
            echo "<td>" . textBoxFunctionReadonly('zar_surchage', $row['surcharge'], 'calculate(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('zar_total', $row["value"], 'calculate(this);') ."</td>" . "</tr>";
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

function getcustomer() 
{
    $conn = connection();
    
    $sql = "SELECT firstname, lastname, email, cellphone FROM customer WHERE customer_id={$_GET['customer_id']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='customer_info'>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email Address</th><th>Cellphone</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["firstname"] . "</td>" . "<td>" .  $row["lastname"]  . "</td>";
            echo "<td>" . $row['email'] . "</td>" . "<td>" . $row["cellphone"] ."</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Customer Details";
    }
}

function getPromotions() 
{
    $conn = connection();
    
    $sql = "SELECT products.currency as currency, orders.product_value as product_value, orders.total as total, promotions.value as promotion FROM orders INNER JOIN products ON products.product_id=orders.product_id INNER JOIN promotions ON promotions.product_id=products.product_id WHERE order_id={$_GET['order_id']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='confirm_order'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Total</th><th>Discount %</th><th>Discount Total</th><th>Grand Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['promotion'] == 0) {
                $promoValue = 0;
            } else {
            $promoValue = $row['total']/$row["promotion"]*100;
            }
            $grandTotal = $row['total']-($promoValue);
            echo "<tr>" . "<td>" . $row["currency"] . "</td>" . "<td>" .  $row["product_value"]  . "</td>";
            echo "<td>" . $row['total']/$row['product_value'] . "</td>" . "<td>" . $row["total"] ."</td>" . "<td>" . $row["promotion"] . "%" ."</td>" . "<td>" . $promoValue ."</td>" . "<td>" . $grandTotal . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
    
}
?>