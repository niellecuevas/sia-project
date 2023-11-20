<?php
require "./php/dbconnection.php"; // Assuming your database connection file is named dbconnection.php

header('Content-Type: application/json');

if (isset($_POST['srCode'])) {
    $srCode = $_POST['srCode'];

    // SQL query
    $sql = "SELECT CONCAT(tb_studinfo.firstname, ' ', tb_studinfo.lastname) AS name, tb_studinfo.course, tbstudentdepartment.department 
            FROM tb_studinfo 
            INNER JOIN tbstudentdepartment ON tb_studinfo.course = tbstudentdepartment.course 
            WHERE tb_studinfo.studid = ?";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $srCode);
    $stmt->execute();

    // Bind the result variables
    $stmt->bind_result($name, $course, $department);

    // Fetch the result
    $result = $stmt->fetch();

    // Close the statement
    $stmt->close();

    if ($result) {
        $data = array(
            'status' => 'success',
            'data' => array(
                'name' => $name,
                'course' => $course,
                'department' => $department
            )
        );
    } else {
        $data = array('status' => 'error', 'message' => 'No data found for the provided SR Code.');
    }

    // Return the result as JSON
    echo json_encode($data);
} else {
    // Handle the case where srCode is not set
    $data = array('status' => 'error', 'message' => 'SR Code not provided.');
    echo json_encode($data);
}
?>
