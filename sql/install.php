<?php

// Connect to MySQL
$link = mysqli_connect('localhost', 'root', 'password');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

// Make my_db the current database
$db_selected = mysql_select_db('tf_forex', $link);

if (!$db_selected) {
    // If we couldn't, then it either doesn't exist, or we can't see it.
    $sql = 'CREATE DATABASE tf_forex';

    if (mysql_query($sql, $link)) {
        echo "Database tf_fx created successfully\n";
    } else {
        echo 'Error creating database: ' . mysql_error() . "\n";
    }
}

mysql_close($link);
?>
