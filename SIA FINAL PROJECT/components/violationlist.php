<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
require "./php/dbconnection.php";
// Check if a sort option is selected
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Fetch data using the function
$result = fetchData($conn, $sortOption);

function fetchData($conn, $sortOption)
{
    // Define the default query without ORDER BY clause
    $query = "SELECT ViolationID, tbl_students.SRCode, CONCAT(FirstName, ' ', SUBSTRING(MiddleName, 1, 1), '. ', LastName) AS Name, Department, CourseName, ViolationDate, ViolationTime, ViolationName, Remarks, tbl_violationreport.ViolationTypeID FROM `tbl_violationreport` INNER JOIN tbl_students ON tbl_violationreport.SRCode = tbl_students.SRCode INNER JOIN tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID";

    // Modify the query based on the selected sort option
    switch ($sortOption) {
        case 'option1':
            $query .= " ORDER BY ViolationName";
            break;
        case 'option2':
            $query .= " ORDER BY Name";
            break;
        case 'default':
            $query .= " ORDER BY ViolationID";
            break;
    }

    // Execute the modified query
    $result = $conn->query($query);

    // Return the result set
    return $result;
}
?>
<!-- Include the dropdown box code from adminsort.php -->
<style>
      .sweetalert-z-index {
    z-index: 5000 !important; /* Adjust the z-index value as needed */
  }
</style>

    <div id="violationList">
        <table>
            <tr class="mngreport-topic-heading">
                <th>ID</th>
                <th>Name</th>
                <th>Violation</th>
                <th>Date</th>
                <th>   </th>
                <th>   </th>
            </tr>
            <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr id='" . $row['ViolationID'] . "' data-vio-id='" . $row['ViolationID'] . "' data-srcode='" . $row['SRCode'] . "' data-name='" . 
                        $row['Name'] . "' data-department='" . $row['Department'] . "' data-course-name='" . $row['CourseName']. "' data-violation-date='" . 
                        $row['ViolationDate'] . "' data-violation-time='" . $row['ViolationTime'] . "' data-violation='" . $row['ViolationName'] . "' data-remarks='" . 
                        $row['Remarks']. "' data-violation-type-id ='" . $row['ViolationTypeID'] . "' >";
                    echo "<td id='violationid'>" . $row['ViolationID'] . "</td>";
                    echo "<td id='name'>" . $row['Name'] . "</td>";
                    echo "<td id='violation'>" . $row['ViolationName'] . "</td>";
                    echo "<td id='violationdate'>" . $row['ViolationDate'] . "</td>";
                    echo "<td class='centered-cell'>";
                    echo "<button class='btncss update-button' id='openEditForm'>Update</button>";
                    echo "</td>";
                    echo "<td class='centered-cell'>";
                    echo "<button class='btncss delete-button' data-id='" . $row['ViolationID'] . "'>";
                    echo "<span class='fas fa-trash'></span> Delete </button>";
                    echo "</td>";
                    echo "</tr>";
            }
            ?>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./js/studentdata.js"></script>
<script src="./js/violationlist.js"></script>
