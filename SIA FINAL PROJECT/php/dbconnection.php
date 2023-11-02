<?php 

    //Login Credentials to XAMPP
    $sname = "localhost";
    $uname = "root";
    $password = "";

    //Database Name
    $dbName = "sia";

    $conn = mysqli_connect($sname, $uname, $password, $dbName);

    if (!$conn) {
        echo "Connection failed";
    }

?>