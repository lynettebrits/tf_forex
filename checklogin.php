<?php
session_start();
//phpinfo(32);
if (!isset($_POST["email"]) AND ! isset($_POST["password"])) { //login form not submitted
    header("location:index.php?message=1"); //1 : "Invalid login - please try again...
} else { //login form is submitted
    //submitted login details
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $conn = new mysqli("localhost", "root", "", "tf_forex"); //establish connection to database
    $sql = "SELECT * FROM user";
    $sql.= " WHERE email = '$email' AND password = '$pwd'"; //formulate SQL query
    $result = $conn->query($sql); //execute query
    $numrows = $result->num_rows;
    if ($numrows == 1) { //match; correct login - set session variables and redirect to the back-end menu page
        $row = $result->fetch_array();
        $_SESSION["userid"] = $row[0];
        $_SESSION["firstname"] = $row[1];
        $_SESSION["surname"] = $row[2];
        $_SESSION["email"] = $row[3];
        $conn->close(); //close conection
        header("location:dashboard.php?userid={$_SESSION["userid"]}");
    } else { //incorrect login - redirect to login page
        $conn->close(); //close connection
        header("location:index.php?message=1"); //1 : "Invalid login - please try again..."
    }
}
?>	