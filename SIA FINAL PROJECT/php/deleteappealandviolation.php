<?php

// Include the database connection file
include "./dbconnection.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get appealID and violationID from the POST data
    $appealID = $_POST["appealID"];
    $violationID = $_POST["violationID"];

    try {
        // Perform your SQL queries to delete records
        $stmtAppeal = $conn->prepare("CALL SP_DeleteAppeal(?)");
        $stmtAppeal->bind_param("i", $appealID);
        $stmtAppeal->execute();

        $stmtViolation = $conn->prepare("CALL SP_DeleteViolationReport(?)");
        $stmtViolation->bind_param("i", $violationID);
        $stmtViolation->execute();

        // Prepare the response
        $response = array("success" => true);

        // Send the JSON response
        header("Content-Type: application/json");
        echo json_encode($response);
    } catch (Exception $e) {
        // Handle database errors
        $response = array("success" => false, "error" => $e->getMessage());
        header("Content-Type: application/json");
        echo json_encode($response);
    }
} else {
    // Invalid request method
    http_response_code(405);
    echo "Method Not Allowed";
}
