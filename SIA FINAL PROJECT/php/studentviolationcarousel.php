<?php
// Database Connection
require "dbconnection.php";

if (isset($_SESSION['SRCode'])) {
    $sr = $_SESSION['SRCode'];

    // Query to fetch student violation data using SR Code
    $sqlQuery = "CALL SP_StudentViolationCarousel('$sr')";

    // Execute Query
    $result = mysqli_query($conn, $sqlQuery);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Fetch violation data
            $violations = array();

            while ($row = mysqli_fetch_assoc($result)) {
                // Convert the time to 12-hour clock format
                $formattedTime = date("h:i A", strtotime($row['violationtime']));
            
                // Build the file path for the evidence image
                $evidenceFileName = $row['evidence']; // Store only the file name
            
                $violation = array(
                    'ViolationID' => $row['violationid'],
                    'ViolationName' => $row['violationame'],
                    'ViolationLevel' => $row['violationlevel'],
                    'ViolationDate' => $row['violationdate'],
                    'ViolationTime' => $formattedTime,
                    'Remarks' => $row['remarks'],
                    'Status' => $row['status'],
                    'Evidence' => $evidenceFileName  // Use only the file name
                );
            
                $violations[] = $violation;
            }

            // Store violation data in a local variable
            $studentViolations = $violations;
        }
    }
} else {
    // Redirect to the login page if the SR Code is not set in the session
    header("Location: ../studentHomepage.php");
    exit();
}
?>
