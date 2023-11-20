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
        header("Location: ../login.php?error=ID and Password are required");
        exit();
    }

    // Query for Student Role
    $sqlQuery = "CALL SP_GetStudentAccount('$id')";

    // Execute Query
    $result = mysqli_query($conn, $sqlQuery);

    if ($result) {
        // Check if there is a matching user
        if (mysqli_num_rows($result) == 1) {
            // User authenticated, store session information
            $user = mysqli_fetch_assoc($result);
            $hashedPassword = $user['passwordencrypted'];

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['UserID'] = $user['userid'];
                $_SESSION['SRCode'] = $user['studid'];
                $_SESSION['PasswordEncrypted'] = $user['passwordencrypted'];
                $_SESSION['FirstName'] = $user['firstname'];
                
                $_SESSION['LastName'] = $user['lastname'];
                $_SESSION['CourseName'] = $user['course'];
                $_SESSION['Department'] = $user['department'];
    
                $fullName = $user['firstname'] . ' ' . $user['lastname'];
    
                // Store the combined FullName in the session
                $_SESSION['FullName'] = $fullName;
    
                header("Location: ../newstudenthomepage.php");
                exit();
            } else {
                header("Location: ../login.php?error=Password Verification Failed!");
                exit();
            }
        } else {
            header("Location: ../login.php?error=User not found");
            exit();
        }
    }

    // If login fails, redirect to login.php with an error message
    header("Location: ../login.php?error=Invalid ID or Password");
    exit();
}
?>