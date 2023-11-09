<?php
require "./php/dbconnection.php";

// Database query to fetch student data
if (isset($_POST['srCode'])) {
    $srCode = $_POST['srCode'];
    $sql = "SELECT CONCAT(FirstName, ' ', LEFT(MiddleName, 1), '. ', LastName) AS Name, CourseName, Department 
            FROM tbl_students 
            INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID 
            WHERE SRCode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $srCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(null);
    }
    $stmt->close();
    $conn->close();
    exit;
}
?>