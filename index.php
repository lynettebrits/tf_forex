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
        include 'sql/install.php';        
        installDb();
        createProducts();
        createUser();
        createCustomer();
        createPromotions();
        createOrders();
        
        include 'sql/populate_products.php';
        include 'sql/get_products.php';
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
            
            function calculate(element) {
                rob = element;
                var qty = element.parentElement.parentElement.children[0].children[0].value;
                var value = element.parentElement.parentElement.children[2].children[0].value;
                var surcharge = element.parentElement.parentElement.children[3].children[0].value;

                console.log(value, qty, surcharge);

                var subTotal = (qty - 0) / (value - 0);
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
                        <h1>Welcome to TF_Forex</h1>
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
                <h1>TF Forex - Current Rates Calculator</h1>
                <?php
                if (isset($_GET['forex'])) {
                    echo '<p>Your order is confirmed</p>';
                }
                ?>
                <form name="buyCurrency" action="buy_currency.php" method="post" id="buyCurrency">
                    <?php
                    $currencies = getCurrency();
                    echo '<br /><br />';
                    $zarAvailable = randsAvailable();
                    ?>
                    <br /><br />
                    <input type="submit" value="Purchase">
                    <br /><br />
                </form>
            </div>
        </div>
    </body>
</html>