<?php

include 'form_functions.php';

function getCurrency() {
    $conn = connection();

    $sql = "SELECT currency, value, surcharge FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC;";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='curr_table'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Surcharge (%)</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["currency"] . "</td>" . "<td>" . textBoxFunctionReadonly('calc_value', $row["value"], 'update(this);') . "</td>";
            echo "<td>" . textBoxFunction('calc_input', '', 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('surchage', $row['surcharge'], 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('calc_total', $row["value"], 'update(this);') . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function randsAvailable() {
    $conn = connection();

    $sql = "SELECT currency, value, surcharge FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC;";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='zar_table'>";
        echo "<tr><th>ZAR Available</th><th>Currency</th><th>Value</th><th>Surcharge (%)</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . textBoxFunction('zar_input', '', 'calculate(this);') . "</td>" . "<td>" . $row["currency"] . "</td>" . "<td>" . textBoxFunctionReadonly('zar_value', $row["value"], 'update(this);') . "</td>";
            echo "<td>" . textBoxFunctionReadonly('zar_surchage', $row['surcharge'], 'calculate(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('zar_total', $row["value"], 'calculate(this);') . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function currencySelect() {
    $connection = connection();
    $queryCurrency = "SELECT product_id, currency FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC;";
    $resultOne = mysqli_query($connection, $queryCurrency);
    while ($row = mysqli_fetch_array($resultOne)) {
        $resArrOne[] = $row;
    }
    return $resArrOne;
}

function fetchCurrency() {
    $conn = connection();

    $sql = "SELECT currency, value, surcharge FROM products WHERE product_id={$_GET['currency']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='curr_fetch'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Surcharge</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["currency"] . "</td>" . "<td>" . textBoxFunctionReadonly('calc_value', $row["value"], 'update(this);') . "</td>";
            echo "<td>" . textBoxFunction('calc_input', '', 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('calc_total', $row["surcharge"], 'update(this);') . "</td>" . "<td>" . textBoxFunctionReadonly('calc_total', $row["value"], 'update(this);') . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function confirmOrder() {
    $conn = connection();

    $sql = "SELECT products.currency as currency, product_value, total, products.surcharge, qty FROM orders INNER JOIN products ON products.product_id=orders.product_id WHERE order_id={$_GET['order_id']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='confirm_order'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Surcharge</th><th>Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $currency = $row['currency'];
            $value = $row['product_value'];
            $amount = $row['qty'];
            $surcharge = $row['surcharge'];
            $total = $row['total'];

            echo "<tr>" . "<td>" . $currency . "</td>" . "<td>" . $value . "</td>";
            echo "<td>" . $amount . "</td>" . "<td>" . $surcharge . "</td>" . "<td>" . $total . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function getcustomer() {
    $conn = connection();

    $sql = "SELECT firstname, lastname, email, cellphone FROM customer WHERE customer_id={$_GET['customer_id']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='customer_info'>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email Address</th><th>Cellphone</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . $row["firstname"] . "</td>" . "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row['email'] . "</td>" . "<td>" . $row["cellphone"] . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Customer Details";
    }
}

function promotions() {
    $conn = connection();

    $sql = "SELECT promotions.value as promovalue, promotions.currency as currency, products.value as productvalue FROM promotions INNER JOIN products ON products.currency=promotions.currency ORDER BY products.product_id DESC LIMIT 4 ;";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='promos'>";
        echo "<tr><th>Currency</th><th>Product Value</th><th>Promo Value</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>" . "<td>" . textBoxreadonly('currency[]', $row["currency"]) . "</td>" . "<td>" . $row['productvalue'] . "</td>";
            echo "<td>" . textBox('promoval[]', $row['promovalue']) . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}

function getPromotions() {
    $conn = connection();
    $currencyid = $_GET['currency'];
                $order_id = $_GET['order_id'];
                $customer_id = $_GET['customer_id'];
                

    $sql = "SELECT promotions.currency as currency, orders.product_value as product_value, orders.qty as qty, products.surcharge as surcharge, orders.total as total, promotions.value as promotion FROM orders INNER JOIN products ON products.product_id=orders.product_id INNER JOIN promotions ON promotions.currency=products.currency WHERE order_id={$_GET['order_id']};";
    //echo "<p> . $sql . </p>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='confirm_order'>";
        echo "<tr><th>Currency</th><th>Value</th><th>Amount</th><th>Surcharge</th><th>Total</th><th>Discount %</th><th>Discount Total</th><th>Grand Total</th></tr>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['promotion'] == 0) {
                $promoValue = 0;
            } else {
                $promoValue = $row['total'] * ($row['promotion'] / 100);
            }
            $grandTotal = $row['total'] + ($promoValue);
            echo hidden('currencyid', $currencyid);
            echo hidden('order_id', $order_id);
            echo hidden('customer_id', $customer_id);
            echo "<tr>" . "<td>" . textBoxreadonly('currency', $row["currency"]) . "</td>" . "<td>" . textBoxreadonly('value', $row["product_value"]) . "</td>";
            echo "<td>" . textBoxreadonly('quantity', $row['qty']) . "</td>" . "<td>" . textBoxreadonly('surcharge', $row["surcharge"]) . "</td>";
            echo "<td>" . textBoxreadonly('total', $row["total"]) . "</td>" . "<td>" . textBoxreadonly('promotion', $row["promotion"] . "%") . "</td>";
            echo "<td>" . textBoxreadonly('promovalue', $promoValue) . "</td>" . "<td>" . textBoxreadonly('grandtotal', $grandTotal) . "</td>" . "</tr>";
        }
        echo "</table>";
    } else {
        echo "No Foreign Exchange to Select";
    }
}
?>