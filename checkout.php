<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/styles.css" rel="stylesheet" />
        <title>TF_Forex | Checkout</title>

        <?php
        include 'sql/get_products.php';
        include 'sql/install.php';
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
                $currencyid = $_GET['currency'];
                $order_id = $_GET['order_id'];
                $customer_id = $_GET['customer_id'];
                
                echo "<form name='confirmOrder' action='checkout_redirect.php'  method='get' class='checkout'>";

                
                
                $promoValue = getPromotions();
                echo '<br /><br />';
                $customerInfo = getcustomer();
                echo '<br />';
                echo submit('Proceed with order');
                echo '</form>';
                ?>

            </div>
        </div>
    </body>
</html>