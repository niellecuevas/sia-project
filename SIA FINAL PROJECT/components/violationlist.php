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
    $query = "SELECT tbviolationreport.violationid, tb_studinfo.studid, CONCAT(tb_studinfo.firstname, ' ', tb_studinfo.lastname) AS name, tbstudentdepartment.department, tb_studinfo.course, tbviolationreport.violationdate, tbviolationreport.violationtime, tbviolationtypes.violationame, tbviolationreport.remarks, tbviolationreport.violationtypeid, tbviolationreport.status AS violationstatus FROM tbviolationreport INNER JOIN tb_studinfo ON tbviolationreport.studid = tb_studinfo.studid INNER JOIN tbstudentdepartment ON tb_studinfo.course = tbstudentdepartment.course INNER JOIN tbviolationtypes ON tbviolationreport.violationtypeid = tbviolationtypes.violationtypeid";

    // Modify the query based on the selected sort option
    switch ($sortOption) {
        case 'option1':
            $query .= " ORDER BY violationame";
            break;
        case 'option2':
            $query .= " ORDER BY name";
            break;
        case 'default':
            $query .= " ORDER BY violationid";
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
                    echo "<tr id='" . $row['violationid'] . 
                         "' data-vio-id = '" . $row['violationid'] . 
                         "' data-srcode = '" . $row['studid'] . 
                         "' data-name = '" . $row['name'] . 
                         "' data-department = '" . $row['department'] . 
                         "' data-course-name = '" . $row['course']. 
                         "' data-violation-date = '" . $row['violationdate'] . 
                         "' data-violation-time = '" . $row['violationtime'] . 
                         "' data-violation = '" . $row['violationame'] . 
                         "' data-remarks = '" . $row['remarks']. 
                         "' data-violation-type-id = '" . $row['violationtypeid'] . 
                         "' data-status = '" . $row['violationstatus'] . "'>";
                    echo "<td id='violationid'>" . $row['violationid'] . "</td>";
                    echo "<td id='name'>" . $row['name'] . "</td>";
                    echo "<td id='violation'>" . $row['violationame'] . "</td>";
                    echo "<td id='violationdate'>" . $row['violationdate'] . "</td>";
                    echo "<td class='centered-cell'>";
                    echo "<button class='btncss update-button' id='openEditForm'>Update</button>";
                    echo "</td>";
                    echo "<td class='centered-cell'>";
                    echo "<button class='btncss delete-button' data-id='" . $row['violationid'] . "'>";
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
<script src="./js/openviolations.js"></script>
