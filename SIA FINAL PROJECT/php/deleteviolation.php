<?php
require "dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    // Perform the delete operation
    require "dbconnection.php";
    $sql = "DELETE FROM tbl_violationreport WHERE ViolationID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>