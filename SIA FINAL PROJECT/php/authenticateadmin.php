<?php

    require "dbconnection.php";

    // Start or resume the session
    session_start();

    // Check if the user is authenticated
    if (!isset($_SESSION['Username'])) {
        header("Location: loginadmin.php");
        exit();
    }

    // Access user information from the session (Add this to the page itself)
    //$user_id = $_SESSION['user_id'];
    //$user_name = $_SESSION['user_name'];
?>