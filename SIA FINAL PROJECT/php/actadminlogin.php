<?php
// Start Session
session_start();

// Database Connection
require "dbconnection.php";

// Validation Method
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['id']) && isset($_POST['password'])) {
    // Validate user input
    $id = validate($_POST['id']);
    $password = validate($_POST['password']);

    // Check if data is empty
    if (empty($id) || empty($password)) {
        header("Location: ../loginadmin.php?error=ID and Password are required");
        exit();
    }

    // SQL Query for Admin
    $sqlQuery = "CALL SP_GetAdminAccount('$id', '$password')";

    // Execute Query
    $result = mysqli_query($conn, $sqlQuery);

    if ($result && mysqli_num_rows($result) == 1) {
        // Admin authenticated, store session information
        $user = mysqli_fetch_assoc($result);
        $_SESSION['AdminID'] = $user['AdminID'];
        $_SESSION['StaffID'] = $user['StaffID'];
        $_SESSION['PermissionLevel'] = $user['PermissionLevel'];
        $_SESSION['FirstName'] = $user['FirstName'];
        $_SESSION['MiddleName'] = $user['MiddleName'];
        $_SESSION['LastName'] = $user['LastName'];
        $_SESSION['ContactNumber'] = $user['ContactNumber'];
        $_SESSION['Position'] = $user['Position'];
        $_SESSION['PasswordEncrypted'] = $user['PasswordEncrypted'];

        header("Location: ../createviolationreport.php");
        exit();
    }

    // If the login fails, redirect to login.php with an error message
    header("Location: ../loginadmin.php?error=Invalid ID or Password");
    exit();
}
?>
