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
            $reportQuery = "CALL SP_GetViolationReport(?,?)";
            $reportStmt = $conn->prepare($reportQuery);
            $reportStmt->bind_param("ii", $srCode, $violationTypeID);
            $reportStmt->execute();
            $reportResult = $reportStmt->get_result();
            $reportRowCount = $reportResult->num_rows;

            // Store the row count in a variable
            $rowCount = $reportRowCount;

            // Free the result set for the violation report query
            $reportStmt->free_result();
            $reportStmt->close();

            // If no rows, use FirstOffense column; if 1 row, use SecondOffense column; if 2 or more rows, use ThirdOffense column
            if ($rowCount == 0) {
                // If no violation report, use FirstOffense column from tbl_violationtypes
                $offensestmt = $conn->prepare("CALL SP_GetFirstOffense(?)");
            } elseif ($rowCount == 1) {
                // If 1 row in violation report, use SecondOffense column from tbl_violationtypes
                $offensestmt = $conn->prepare("CALL SP_GetSecondOffense(?)");
            } else {
                // If 2 or more rows in violation report, use ThirdOffense column from tbl_violationtypes
                $offensestmt = $conn->prepare("CALL SP_GetThirdOffense(?)");
            }

            // Execute the appropriate SQL query
            $offensestmt->bind_param("i", $violationTypeID);
            $offensestmt->execute();
            $offensestmt->bind_result($punishment);

            // Fetch the result
            if ($offensestmt->fetch()) {
                // Return the punishment
                echo $punishment;
            } else {
                // Return an empty string if no punishment is found
                echo '';
            }

            // Close the statement for the main query
            $offensestmt->close();
        } else {
            // If srCode is empty, return an empty string
            echo '';
        }
    } else {
        // If srCode is not set, return an empty string
        echo '';
    }
}

// Close the database connection
$conn->close();
?>
