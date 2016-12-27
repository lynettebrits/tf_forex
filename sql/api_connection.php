<?php

function apiConnection() {
    // set API Endpoint and access key (and any options of your choice)
    $endpoint = 'live';
    $access_key = 'dbfb0c0691b79245c570b0c90514cbf0';
//    $source = '&source=ZAR';
//    $currencies = '&currencies=USD,GBP';
// Initialize CURL:
    $ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

// Decode JSON response:
    $exchangeRates = json_decode($json, true);
    //print_r($exchangeRates);
// Access the exchange rate values, e.g. GBP:
    $usd = $exchangeRates['quotes']['USDUSD'];
    $gbp = $exchangeRates['quotes']['USDGBP'];
    $eur = $exchangeRates['quotes']['USDEUR'];
    $kes = $exchangeRates['quotes']['USDKES'];
    $zar = $exchangeRates['quotes']['USDZAR'];
    
    return $exchangeRates;
}
?>