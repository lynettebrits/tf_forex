<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/styles.css" rel="stylesheet" />
        <title>TF_Forex | Home</title>

        <?php
        include 'sql/get_products.php';
        include 'sql/install.php'
        ?>

        <script>
            function update(element) {
                rob = element;
                var qty = element.parentElement.parentElement.children[2].children[0].value;
                var value = element.parentElement.parentElement.children[1].children[0].value;
                var surcharge = element.parentElement.parentElement.children[3].children[0].value;

                console.log(value, qty, surcharge);

                var subTotal = (value - 0) * (qty - 0);
                var surchargeTotal = subTotal * (surcharge - 0)/100;
                var total = subTotal+surchargeTotal;

                element.parentElement.parentElement.children[4].children[0].value = total;
            }
        </script>
    </head>
    <body>
        <header>
            <nav>
                <div class="navbar">
                    <div class="welcome">
                        <h1>TF_Forex</h1>
                    </div>
                    <div class="main_nav">
                        <ul>
                            <li>
                                <a href="index.php" class="active">Home</a>
                            </li>
                            <li>
                                <a href="cust_login">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="body_container">
            <div class="currency_summary">
                <h1>Buy Foreign Currency</h1>
                <?php
                if (isset($_GET['customer_id'])) {
                    $currency = $_GET['currency'];
                    $order_id = $_GET['order_id'];
                    $customer_id = $_GET['customer_id'];
                    ?>
                    <p>
                        Invoice Details:
                    </p>
                    <?php
                    $confirmOrder = confirmOrder();
                    echo '<br /><br />';
                    $customerInfo = getcustomer();
                    echo '<br /><br />';
                    ?>
                    <a href=" <?php echo "checkout.php?currency={$currency}&&order_id={$order_id}&&customer_id={$customer_id}" ?> "> Proceed to Payment </a> <br /><br />';
                    <?php
                } else if (isset($_GET['confirm'])) {
                    $currency = $_GET['currency'];
                    $order_id = $_GET['order_id'];
                    ?>
                    <p>
                        Please complete your personal information:
                    </p>
                    <?php
                    echo "<form name='customer_details' action='sql/customer_details.php?currency=$currency&&order_id=$order_id' method='post' class='customer_details'>";
                    echo formLabel("First Name", "firstname") . textBoxRequired("firstname") . "<br />";
                    echo formLabel("Last Name", "lastname") . textBoxRequired("lastname") . "<br />";
                    echo formLabel("Email Address", "email") . textBoxRequired("email") . "<br />";
                    echo formLabel("Password", "password") . textBoxRequired("password") . "<br />";
                    echo formLabel("Cellphone", "cellphone") . textBox("cellphone") . "<br />";
                    echo formLabel('') . submit("Proceed to Payment");
                    echo '<br /><br />';
                    echo "</form>";
                } else if (isset($_GET['order_id'])) {
                    $currency = $_GET['currency'];
                    $order_id = $_GET['order_id'];
                    ?>
                    <p>
                        Confirm order details:
                    </p>
                    <?php
                    $confirmOrder = confirmOrder();
                    ?>
                    <br />
                    <a href="<?php echo "buy_currency.php?currency=$currency&&order_id=$order_id&&confirm=true" ?>" class="confirm">Confirm Order</a>
                    <br />
                    <a href="<?php echo "buy_currency.php?currency=$currency" ?>" class="confirm">Edit Order</a>
                    <br /><br />
                    <?php
                } else if (isset($_GET['currency'])) {
                    ?>
                    <p>
                        Please input the amount of foreign currency that you would like to purchase::
                    </p>

                    <?php
                    $currency = $_GET['currency'];
                    echo "<form name=\"buyCurrency\" action=\"buy_currency_redirect.php?currency=$currency\" method=\"post\" id=\"buyCurrency\">";
                    $fetchCurrency = fetchCurrency();
                    ?>
                    <br /><br />
                    <input type="submit" value="Proceed">
                    <br /><br />
                    <?php
                } else {
                    ?>

                    <p>
                        Please select the type of foreign currency you would like to purchase:
                    </p>
                    <form name="buyCurrency" action="buy_currency_redirect.php" method="post" id="buyCurrency">
                        <?php
                        $buyCurrency = currencySelect();
                        $ctr = 1;
                        foreach ($buyCurrency as $value) {
                            $currency[$ctr]["value"] = $value[0];
                            $currency[$ctr]["name"] = $value[1];
                            $ctr++;
                        }
                        echo formLabel("Select Currency", "currency") . select("currency", $currency);
                        ?>
                        <br /><br />
                        <input type="submit" value="Proceed">
                        <br /><br />
                    </form>
                <?php } ?>
            </div>
        </div>
    </body>
</html>