<?php
// Include the file to establish a database connection
require "./dbconnection.php";

// Resume an existing session or start a new one
session_start();

// Initialize variables to store user inputs
$srCode = $staffId = $violationType = $violationDate = $violationTime = $remarks = '';

// Function to sanitize user inputs
function sanitizeInput($input)
{
    // Remove leading and trailing whitespace
    $input = trim($input);
    // Unquote escaped characters
    $input = stripslashes($input);
    // Convert HTML special characters to their respective entities
    $input = htmlspecialchars($input);
    return $input;
}

// Check if the form with the name "submit" was submitted
if (isset($_POST['submit'])) {
     //Check if required fields are not empty and violation type is not "Violation"
     if (!empty($_POST['srCode']) && !empty($_POST['violationtype']) && $_POST['violationtype'] !== "Violation" &&
         !empty($_POST['violationdate']) &&  !empty($_POST['status']) && !empty($_POST['violationtime'])) {

        // Clean and validate the inputs
        $srCode = sanitizeInput($_POST['srCode']);
        $staffId = $_SESSION['EmpID'];
        $violationType = sanitizeInput($_POST['violationtype']);
        // Convert the date and time inputs to specific formats
        $violationDate = date('Y-m-d', strtotime($_POST['violationdate']));
        $violationTime = date('H:i:s', strtotime($_POST['violationtime']));
        $remarks = sanitizeInput($_POST['remarks']);
        $status = sanitizeInput($_POST['status']);
        // Validate uploaded image
        if ($_FILES['image']['error'] === 4) {
            // If no file was uploaded, redirect with a "MissingAttachment" status
            header("Location: ../createviolationreport.php?status=MissingAttachment");
            exit();
        } else {
            // Retrieve file information
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $tmpName = $_FILES['image']['tmp_name'];

            // Define allowed image extensions
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            // Get the actual file extension and convert it to lowercase
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            // Check if the file extension is allowed
            if (!in_array($imageExtension, $validImageExtension)) {
                // Display an error message and exit if the extension is not allowed
                echo "<script>alert('Use only jpg, jpeg, or png files')</script>";
                exit();
            } else {
                // Generate a unique image name by combining a unique ID with the file extension
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                // Set the destination directory path
                $destinationDirectory = '../img/violationEvidence/';
                // Move the uploaded file to the specified destination
                move_uploaded_file($tmpName, $destinationDirectory . $newImageName);
            }
        }

        // Call the stored procedure to insert data
        $query = $conn->prepare("CALL SP_InsertViolationReport(?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssisssss", $srCode, $staffId, $violationType, $violationDate, $violationTime, $remarks, $newImageName, $status);

        if ($query->execute()) {
            // If the query is successful, set a session variable and redirect with "InsertSuccess" status
            $_SESSION['operation'] = true;
            header("Location: ../createviolationreport.php?status=InsertSuccess");
            exit();
        } else {
            // If the query fails, redirect with "InsertFail" status
            header("Location: ../createviolationreport.php?status=InsertFail");
            exit();
        }
     } else {
         // If required fields are missing, redirect with a "Missing" status
         header("Location: ../createviolationreport.php?status=Missing");
         exit();
     }
}
?>
