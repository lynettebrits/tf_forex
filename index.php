<!DOCTYPE html>
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
        populateProducts();
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
                var surchargeTotal = subTotal * (surcharge - 0) / 100;
                var total = subTotal + surchargeTotal;

                element.parentElement.parentElement.children[4].children[0].value = total;
            }

            function calculate(element) {
                rob = element;
                var qty = element.parentElement.parentElement.children[0].children[0].value;
                var value = element.parentElement.parentElement.children[2].children[0].value;
                var surcharge = element.parentElement.parentElement.children[3].children[0].value;

                console.log(value, qty, surcharge);

                var subTotal = (qty - 0) / (value - 0);
                var surchargeTotal = subTotal * (surcharge - 0) / 100;
                var total = subTotal + surchargeTotal;

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
                if (isset($_GET['message'])) {
                    echo '<p>Incorrect Login Details. Please try again.  </p>';
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
            <form action="checklogin.php" method="post">
                <div class="container">
                    <label>Username</label>
                    <input type="text" placeholder="Email" name="email" required>
                    <br />
                    <label><b>Password</b></label>
                    <input type="text" placeholder="Password" name="password" required>
                    <br />
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </body>
</html>