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
    $sqlQuery = "CALL SP_GetAdminAccount('$id');";

    // Execute Query
    $result = mysqli_query($conn, $sqlQuery);

    if ($result && mysqli_num_rows($result) == 1) {
        // Admin found, verify the password
        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['passwordencrypted'];

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, store session information
            $_SESSION['AdminID'] = $user['adminid'];
            $_SESSION['EmpID'] = $user['empid'];
            $_SESSION['Username'] = $user['username'];
            $_SESSION['FirstName'] = $user['firstname'];
            $_SESSION['LastName'] = $user['lastname'];
            $_SESSION['PasswordEncrypted'] = $user['passwordencrypted'];

            header("Location: ../createviolationreport.php");
            exit();
        } else {
            header("Location: ../loginadmin.php?error=Password Verification Failed!");
            exit();
        }
    } else {
        header("Location: ../loginadmin.php?error=User not found");
        exit();
    }

    // If the login fails, redirect to login.php with an error message
    header("Location: ../loginadmin.php?error=Invalid ID or Password");
    exit();
}
?>
