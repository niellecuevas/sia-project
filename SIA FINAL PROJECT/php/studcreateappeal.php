<?php
// Include the database connection file
require "dbconnection.php";

$violationId = $date = $request = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the violation ID
    $violationId = $_POST['violationId'];

    // Get other form data
    $date = $_POST['date'];
    $request = $_POST['request'];

    // Prepare and execute the stored procedure with the default value for Status
    $stmt = $conn->prepare("CALL SP_StudentAppeal(?, ?, ?)");
    $stmt->bind_param("iss", $violationId, $date, $request);

    // Check if the stored procedure was executed successfully
    if ($stmt->execute()) {
        // Check additional success conditions if necessary
        // For example, if the stored procedure returns a result set, you might want to fetch the results
        // $result = $stmt->get_result();
        
        // Redirect to the new student homepage upon successful appeal submission
        header("Location: ../newstudenthomepage.php");
        exit();
    } else {
        // Redirect to the new student homepage with an error status
        header("Location: ../newstudenthomepage.php?status=Error");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect or handle the case where the form is not submitted
    exit();
}

// Close the database connection (moved outside the if-else block)
$conn->close();
?>
