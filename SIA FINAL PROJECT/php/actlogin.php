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
            header("Location: login.php?error=ID and Password are required");
            exit();
        }

        // Hash the password (you should use a secure hashing method) -- Enable lang ito pag may hashing na
        // $hashedPassword = sha1($password);  // Replace with a secure hashing method like password_hash()

        // SQL Query
        $sqlQuery = "SELECT * FROM tbl_adminaccount INNER JOIN tbl_staff ON tbl_adminaccount.StaffID = tbl_staff.StaffID WHERE tbl_adminaccount.StaffId='$id' AND PasswordEncrypted='$password'";

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

                header("Location: ../dashboard.php");
                exit();
            } else {
                header("Location: login.php?error=Invalid_ID_or_Password");
                exit();
            }
        } else {
            // Handle the database query error
            die("Database_Error: " . mysqli_error($conn));
        }
    }
?>
