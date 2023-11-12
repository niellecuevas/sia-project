<?php
include('./dbconnection.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' and 'action' parameters are set
    if (isset($_POST['id']) && isset($_POST['action'])) {
        // Get the values from the POST request
        $id = $_POST['id'];
        $action = $_POST['action'];

        // Check if the action is 'delete'
        if ($action === 'delete') {
            try {
                // Prepare and execute the delete query
                $sql = "CALL SP_DeleteViolationReport(?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();

                // Check if the delete was successful
                if ($stmt->affected_rows > 0) {
                    echo 1; // Success
                } else {
                    echo 0; // No rows were affected
                }

                // Close the statement
                $stmt->close();
            } catch (Exception $e) {
                // Catch any exceptions, such as foreign key constraint violation
                echo 0; // Failure
            }
        }
    } else {
        // Parameters not set
        echo "Invalid request";
    }
} else {
    // Not a POST request
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>
