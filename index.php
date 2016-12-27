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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "tf_forex";

        $conn = new mysqli($servername, $username, $password, $database);
        $query = "SELECT product_id FROM products";
        if (empty($conn)) {
            include_once 'install.php';
        }
        include 'sql/populate_products.php';
        include 'sql/get_products.php';
        ?>

        <script>
            function update(element) {
                rob = element;
                var qty = element.parentElement.parentElement.children[2].children[0].value;
                var value = element.parentElement.parentElement.children[1].children[0].value;
                
                console.log(value, qty);
                
                var total = (value - 0) * (qty - 0);
                
                element.parentElement.parentElement.children[3].children[0].value = total;
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
                <form name="buyCurrency" action="buy_currency.php" method="post" id="buyCurrency">
                <?php
                $currencies = getCurrency();
                ?>
                    <br /><br />
                    <input type="submit" value="Proceed to Buy Currency">
                    <br /><br />
                </form>
            </div>
        </div>
        <footer>
            <div class="foot_nav">
                <a href="login">Login</a>
            </div>
        </footer>
    </body>
</html>