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
        <title>TF_Forex | Checkout</title>

        <?php
        include 'sql/get_products.php';
        ?>
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
                <h1>Checkout</h1>
                <?php
                $currency = $_GET['currency'];
                $order_id = $_GET['order_id'];
                $customer_id = $_GET['customer_id'];

                $promoValue = getPromotions();
                echo '<br /><br />';
                $customerInfo = getcustomer();
                ?>
                <br />
                <a href=<?php echo "checkout_redirect.php?currency={$currency}&&order_id={$order_id}&&customer_id={$customer_id}" ?> > Proceed to Payment </a> <br /><br />';
            </div>
        </div>
    </body>
</html>