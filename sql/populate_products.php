<?php

include'api_connection.php';

function setDate() {
    $conn = connection();
    $checkDate = "SELECT DATE_FORMAT(dateupdated, '%Y-%m-%d') FROM products WHERE DATE_FORMAT(dateupdated, '%Y-%m-%d')=CURDATE() ORDER BY dateupdated DESC LIMIT 1";
    $result = $conn->query($checkDate);
    if ($result === false) {
        echo "<p>" . $conn->error . "</p>";
    }
    while ($row = $result->fetch_row()) {
        foreach ($row as $k => $date) {
            return $date;
        }
    }
}

function populateProducts() {
    $conn = connection();
    $date = setDate();
    if (empty($date)) {
        $exchangeRates = apiConnection();
        for ($i = 1; $i < 2; $i++) {
            $usdstart = $exchangeRates['quotes']['USDUSD'];
            $zarstart = $exchangeRates['quotes']['USDZAR'];
            $gbpstart = $exchangeRates['quotes']['USDGBP'];
            $eurstart = $exchangeRates['quotes']['USDEUR'];
            $kesstart = $exchangeRates['quotes']['USDKES'];

            $usd = ($usdstart * $zarstart) / $usdstart;
            $gbp = ($usdstart * $zarstart) / $gbpstart;
            $eur = ($usdstart * $zarstart) / $eurstart;
            $kes = ($usdstart * $zarstart) / $kesstart;

            $sql = "INSERT INTO products (currency, value, surcharge, dateupdated) VALUE ('USD', '$usd', '7.5', now()), ('GBP', $gbp, 5, now()), ('EUR', $eur, 5, now()), ('KES', $kes, 2.5, now());";
            $result = $conn->query($sql);
            if ($result === false) {
                echo "<p>" . $conn->error . "</p>";
            }
        }
        return $sql;
    }
}
