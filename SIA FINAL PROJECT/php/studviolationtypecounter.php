<?php

// Database Connection
require "dbconnection.php";

$majorViolations = 0; // Initialize as 0
$minorViolations = 0; // Initialize as 0

if (isset($_SESSION['SRCode'])) {
    $id = $_SESSION['SRCode'];

    // Query to call the SP_StudentViolationTypeCounter stored procedure
    $sqlQuery = "CALL SP_StudentViolationTypeCounter('$id')";

    // Execute the stored procedure
    $result = mysqli_query($conn, $sqlQuery);

    // Check if the query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        // Update the PHP variables with the values from the database
        $majorViolations = $row['MajorViolations'];
        $minorViolations = $row['MinorViolations'];
    } else {
        // Handle the case where the query failed, e.g., log an error or show a message
        echo "Database query failed: " . mysqli_error($conn);
    }
} else {
    // Redirect to the login page if the SRCode is not set in the session
    header("Location: ../studentHomepage.php");
    exit();
}
?>
