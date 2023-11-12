<?php
// Include your database connection code here
include './dbconnection.php'; // Replace with the actual path to your database connection code

// Check if the ID parameter is set
if (isset($_POST['id'])) {
    // Get the violation type ID from the POST data
    $violationTypeID = $_POST['id'];

    // Check if the srCode is set
    if (isset($_POST['srCode'])) {
        $srCode = $_POST['srCode'];

        // Initialize $reportStmt outside of the if conditions
        $reportStmt = null;

        // Check if srCode is not empty
        if (!empty($srCode)) {
            // Prepare and execute the SQL query to check the violation report
            $reportQuery = "SELECT * FROM `tbl_violationreport` WHERE SRCode = ? AND ViolationTypeID = ?";
            $reportStmt = $conn->prepare($reportQuery);
            $reportStmt->bind_param("si", $srCode, $violationTypeID);
            $reportStmt->execute();
            $reportResult = $reportStmt->get_result();
            $reportRowCount = $reportResult->num_rows;

            // If no rows, use FirstOffense column; if 1 row, use SecondOffense column; if 2 or more rows, use ThirdOffense column
            if ($reportRowCount == 0) {
                // If no violation report, use FirstOffense column from tbl_violationtypes
                $stmt = $conn->prepare("SELECT FirstOffense FROM `tbl_violationtypes` WHERE ViolationTypeID = ?");
            } elseif ($reportRowCount == 1) {
                // If 1 row in violation report, use SecondOffense column from tbl_violationtypes
                $stmt = $conn->prepare("SELECT SecondOffense FROM `tbl_violationtypes` WHERE ViolationTypeID = ?");
            } else {
                // If 2 or more rows in violation report, use ThirdOffense column from tbl_violationtypes
                $stmt = $conn->prepare("SELECT ThirdOffense FROM `tbl_violationtypes` WHERE ViolationTypeID = ?");
            }

            // Execute the appropriate SQL query
            $stmt->bind_param("i", $violationTypeID);
            $stmt->execute();
            $stmt->bind_result($punishment);

            // Fetch the result
            if ($stmt->fetch()) {
                // Return the punishment
                echo $punishment;
            } else {
                // Return an empty string if no punishment is found
                echo '';
            }

            // Close the statement
            $stmt->close();
        } else {
            // If srCode is empty, return an empty string
            echo '';
        }
    } else {
        // If srCode is not set, return an empty string
        echo '';
    }

    // Close the statement for violation report query if it's not null
    if ($reportStmt !== null) {
        $reportStmt->close();
    }
}

// Close the database connection
$conn->close();
?>
