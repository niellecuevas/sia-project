<?php
// Database Connection
require "dbconnection.php";

// Validation Method
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user input
    $staffId = validate($_POST['staffId']);
    $adminId = validate($_POST['adminId']);
    $password = validate($_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the data into tbl_adminaccount
    $insertQuery = "INSERT INTO tbl_adminaccount (StaffID, AdminID, PasswordEncrypted) VALUES ('$staffId', '$adminId', '$hashedPassword')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Account created successfully!";
    } else {
        echo "Error creating account: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
