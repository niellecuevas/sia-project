<?php
// Include your database connection code here
include './dbconnection.php'; // Replace with the actual path to your database connection code

// Check if the ID parameter is set
if (isset($_POST['id'])) {
    // Get the violation type ID from the POST data
    $violationTypeID = $_POST['id'];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT Description FROM `tbl_violationtypes` WHERE ViolationTypeID = ?");
    $stmt->bind_param("i", $violationTypeID);
    $stmt->execute();
    $stmt->bind_result($description);

    // Fetch the result
    if ($stmt->fetch()) {
        // Return the description
        echo $description;
    } else {
        // Return an empty string if no description is found
        echo '';
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
