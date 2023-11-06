<?php 

    //Login Credentials to XAMPP
    $sname = "localhost";
    $uname = "root";
    $password = "";

    //Database Name
    $dbName = "db_ba3102";

    $conn = mysqli_connect($sname, $uname, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection Failed".$conn->connect_error);
    }

?>