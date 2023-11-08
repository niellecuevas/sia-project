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
    $sqlQuery = "CALL SP_GetStudentwithViolation('$id', '$password')";

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
            $_SESSION['ViolationLevel'] = $user['ViolationLevel'];

            // Count the Minor and Major Offenses without additional queries
            $minorOffensesCount = 0;
            $majorOffensesCount = 0;

            // Add logic to calculate the offenses from the retrieved data
            foreach ($user as $key => $value) {
                if (strpos($key, 'ViolationLevel') === 0) {
                    if ($value === 'Minor') {
                        $minorOffensesCount++;
                    } elseif ($value === 'Major') {
                        $majorOffensesCount++;
                    }
                }
            }

            $_SESSION['MinorOffenses'] = $minorOffensesCount;
            $_SESSION['MajorOffenses'] = $majorOffensesCount;

            $middleInitial = !empty($user['MiddleName']) ? strtoupper(substr($user['MiddleName'], 0, 1) . '.') : '';
            $fullName = $user['FirstName'] . ' ' . $middleInitial . ' ' . $user['LastName'];

            // Store the combined FullName in the session
            $_SESSION['FullName'] = $fullName;

            header("Location: ../studentHomepage.php");
            exit();
        }
    }

    // If login fails, redirect to login.php with an error message
    header("Location: ../login.php?error=Invalid ID or Password");
    exit();
}
?>