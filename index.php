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

        $query = "SELECT product_id FROM products";
        $conn = new mysqli($servername, $username, $password, $database);

        if (empty($conn)) {
            include_once 'install.php';
        }
            include'api_connection.php';
            ?>
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
                <div>
                    <h1>TF Forex - Current Rates</h1>
                    <table>
                        <tr>
                            <th>Currency</th>
                            <th>Rate</th>
                        </tr>
                        <tr>
                            <?php
                            $exchangeRates = apiConnection();
                            for ($i = 1; $i < 2; $i++) {
                                $usdstart = $exchangeRates['quotes']['USDUSD'];
                                $zarstart = $exchangeRates['quotes']['USDZAR'];
                                $gbpstart = $exchangeRates['quotes']['USDGBP'];
                                $eurstart = $exchangeRates['quotes']['USDEUR'];
                                $kesstart = $exchangeRates['quotes']['USDKES'];
                            }
                            $usd = round((($usdstart * $zarstart) / $usdstart), 5);
                            $gbp = round((($usdstart * $zarstart) / $gbpstart), 5);
                            $eur = round((($usdstart * $zarstart) / $eurstart), 5);
                            $kes = round((($usdstart * $zarstart) / $kesstart), 5);
                            ?>
                            <td>USD</td>
                            <td><?php echo 'R' . $usd ?></td>
                        </tr>
                        <tr>
                            <td>GBP</td>
                            <td><?php echo 'R' . $gbp ?></td>
                        </tr>
                        <tr>
                            <td>EUR</td>
                            <td><?php echo 'R' . $eur ?></td>
                        </tr>
                        <tr>
                            <td>KES</td>
                            <td><?php echo 'R' . $kes ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <footer>
            <div class="foot_nav">
                <a href="login">Login</a>
            </div>
        </footer>
    </body>
</html>