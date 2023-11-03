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

if (isset($_POST['id']) && isset($_POST['password']) && isset($_POST['role'])) {
    // Validate user input
    $id = validate($_POST['id']);
    $password = validate($_POST['password']);
    $role = $_POST['role']; // Get the role from the POST data

    // Check if data is empty
    if (empty($id) || empty($password)) {
        header("Location: ../login.php?error=ID and Password are required");
        exit();
    }

    // Hash the password (you should use a secure hashing method) -- Enable lang ito pag may hashing na
    // $hashedPassword = sha1($password);  // Replace with a secure hashing method like password_hash()

    // SQL Query based on the role
    if ($role === 'admin') {

        /*
        =========================================================================================================
                                                        Admin Role
        =========================================================================================================
        */

        //Query
        $sqlQuery = "CALL SP_GetAdminAccount('$id', '$password')";

        // Execute Query
        $result = mysqli_query($conn, $sqlQuery);

        if ($result) {
            // Check if there is a matching user
            if (mysqli_num_rows($result) == 1) {
                // User authenticated, store session information
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

                header("Location: ../adminDashboard.php");
                exit();
            }
        }
    } else {

        /*
        =========================================================================================================
                                                        Student Role
        =========================================================================================================
        */

        // Query
        $sqlQuery = "CALL SP_GetStudentAccount('$id', '$password')";

        // Execute Query
        $result = mysqli_query($conn, $sqlQuery);

        if ($result) {
            // Check if there is a matching user
            if (mysqli_num_rows($result) == 1) {
                // User authenticated, store session information
                $user = mysqli_fetch_assoc($result);
                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['SRCode'] = $user['SRCode'];
                $_SESSION['PasswordEncrypted'] = $user['PasswordEncrypted'];
                $_SESSION['FirstName'] = $user['FirstName'];
                $_SESSION['MiddleName'] = $user['MiddleName'];
                $_SESSION['LastName'] = $user['LastName'];
                $_SESSION['CourseName'] = $user['CourseName'];
                $_SESSION['Department'] = $user['Department'];

                $middleInitial = !empty($user['MiddleName']) ? strtoupper(substr($user['MiddleName'], 0, 1) . '.') : '';
                $fullName = $user['FirstName'] . ' ' . $middleInitial . ' ' . $user['LastName'];

                // Store the combined FullName in the session
                $_SESSION['FullName'] = $fullName;

                header("Location: ../studentHomepage.php");
                exit();
            }
        }
    }

    // If none of the above conditions are met (login failed), redirect to login.php with an error message
    header("Location: ../login.php?error=Invalid Id or Password");
    exit();
}
?>
