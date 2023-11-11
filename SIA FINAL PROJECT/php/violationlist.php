<?php
require "dbconnection.php";

// Define the default query without ORDER BY clause
$query = "SELECT ViolationID, CONCAT(FirstName, ' ', SUBSTRING(MiddleName, 1, 1), '. ', LastName) AS Name, ViolationName, ViolationDate FROM `tbl_violationreport` INNER JOIN tbl_students ON tbl_violationreport.SRCode = tbl_students.SRCode INNER JOIN tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID";

// Check if a sort option is selected
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : '';

// Modify the query based on the selected sort option
switch ($sortOption) {
    case 'option1':
        $query .= " ORDER BY ViolationName";
        break;
    case 'option2':
        $query .= " ORDER BY Name";
        break;
    case 'default':
        break;
}

// Execute the modified query
$result = $conn->query($query);

// Dynamically generate table rows based on fetched data
while ($row = $result->fetch_assoc()) {
    echo "<tr data-vio-id='" . $row['ViolationID'] . "' data-name='" . $row['Name'] . "' data-violation='" . $row['ViolationName'] . "' data-date='" . $row['ViolationDate'] . "'>";
    echo "<td id='violationid'>" . $row['ViolationID'] . "</td>";
    echo "<td id='name'>" . $row['Name'] . "</td>";
    echo "<td id='violation'>" . $row['ViolationName'] . "</td>";
    echo "<td id='violationdate'>" . $row['ViolationDate'] . "</td>";
    echo "<td class='centered-cell'>";
    echo "<button class='btncss' id='openEditForm'>Update</button>";
    echo "</td>";
    echo "<td class='centered-cell'>";
    echo "<button class='btncss delete-button' data-id='" . $row['ViolationID'] . "'>";
    echo "<span class='fas fa-trash'></span> Delete";
    echo "</button>";
    echo "</td>";
    echo "</tr>";
}
?>
