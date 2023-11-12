<?php
require "dbconnection.php";
echo "<script>alert('starts deleting')</script>";
// Check if the violationID parameter is set
if (isset($_GET['violationID'])) {
    $violationID = $_GET['violationID'];

    // Prepare and execute the SQL DELETE query
    $stmt = $conn->prepare("DELETE FROM tbl_violationreport WHERE ViolationID = ?");
    $stmt->bind_param("i", $violationID);

    if ($stmt->execute()) {
        // If the deletion is successful, send a success response
        echo json_encode(["status" => "success"]);
    } else {
        // If there is an error, send an error response
        echo json_encode(["status" => "error", "message" => "Error deleting the record"]);
    }

    // Close the statement
    $stmt->close();
    echo "<script>alert('deleted')</script>";
} else {
    // If violationID is not set, send an error response
    echo json_encode(["status" => "error", "message" => "ViolationID parameter is not set"]);
}

// Close the database connection
$conn->close();
?>
