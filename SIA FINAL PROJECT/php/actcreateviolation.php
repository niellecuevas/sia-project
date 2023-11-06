<?php

require "./dbconnection.php";
include "../components/sidebar.php";

// Resume Session
session_start();

$srCode = $staffId = $violationType = $violationDate = $violationTime = $remarks = '';

// Function to sanitize user inputs
function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

if (isset($_POST['submit'])) {
    // Check if textboxes are filled and dropdown is not set to "violation"
    if (
        !empty($_POST['srcode']) &&
        !empty($_POST['violationtype']) &&
        $_POST['violationtype'] !== "Violation" && // Assuming "violation" is the default option
        !empty($_POST['violationdate']) &&
        !empty($_POST['violationtime']
    )) {
        // Clean and validate the inputs (you can add this part back here if needed)
        $srCode = sanitizeInput($_POST['srcode']);
        $staffId = $_SESSION['StaffID'];
        $violationType = sanitizeInput($_POST['violationtype']);
        $violationDate = date('Y-m-d', strtotime($_POST['violationdate']));
        $violationTime = date('H:i:s', strtotime($_POST['violationtime']));
        $remarks = sanitizeInput($_POST['remarks']);

        // Build and execute the SQL query
        $sqlQuery = "INSERT INTO `tbl_violationreport` (`SRCode`, `StaffID`, `ViolationTypeID`, `ViolationDate`, `ViolationTime`, `Remarks`) VALUES ('$srCode', '$staffId', '$violationType', '$violationDate', '$violationTime', '$remarks')";

        $result = $conn->query($sqlQuery);

        if ($result === TRUE) {
            $_SESSION['operation'] = true;
            header("Location: ../createviolationreport.php?status=InsertSuccess");
            exit();
        } else {
            header("Location: ../createviolationreport.php?status=InsertFail");
        }
    } else {
        header("Location: ../createviolationreport.php?status=Missing");
    }
}
?>
