<?php
// Include the database connection file
require "dbconnection.php";

$violationId = $date = $request = '';

// Set the default value for Status
$status = 'pending';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the violation ID
    $violationId = $_POST['violationId'];

    // Get other form data
    $date = $_POST['date'];
    $request = $_POST['request'];

    // Prepare and execute the stored procedure with the default value for Status
    $stmt = $conn->prepare("CALL SP_StudentAppeal(?, ?, ?, ?)");
    $stmt->bind_param("isss", $violationId, $date, $request, $status);

    // Check if the stored procedure was executed successfully
    if ($stmt->execute()) {
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
