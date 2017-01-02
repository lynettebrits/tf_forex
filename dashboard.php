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
    </head>
    <body>
        <header>
            <nav>
                <div class="navbar">
                    <div class="welcome">
                        <h1>Welcome <?php echo $_SESSION['firstname'] ?></h1>
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
                <form name="promos" action="change_promo.php" method="post" id="promos">
                    <?php
                    $promo = promotions();
                    ;
                    ?>
                    <br /><br />
                    <input type="submit" value="Edit">
                    <br/>
                    <a href="logout.php">Log Out </a>
                    <br /><br />
                </form>
            </div>
        </div>
    </body>
</html>