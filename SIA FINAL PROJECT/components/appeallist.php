<?php
require "./php/dbconnection.php";

// Check if a sort option is selected
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Fetch data using the function
$result = fetchAppeal($conn, $sortOption);

function fetchAppeal($conn, $sortOption)
{
    // Define the default query without ORDER BY clause
    $query = "SELECT AppealID, tbl_students.SRCode, CONCAT(FirstName, ' ', SUBSTRING(MiddleName, 1, 1), '. ', LastName) AS Name, ViolationName FROM `tbl_appeal` INNER JOIN tbl_violationreport ON tbl_appeal.ViolationID = tbl_violationreport.ViolationID INNER JOIN tbl_students ON tbl_violationreport.SRCode = tbl_students.SRCode INNER JOIN tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID";

    // Modify the query based on the selected sort option
    switch ($sortOption) {
        case 'option1':
            $query .= " ORDER BY ViolationName";
            break;
        case 'option2':
            $query .= " ORDER BY Name";
            break;
        case 'default':
            $query .= " ORDER BY AppealID";
            break;
    }

    // Execute the modified query
    $result = $conn->query($query);

    // Return the result set
    return $result;
}
?>

<!-- Include the dropdown box code from adminsort.php -->

<!-- Rest of the code for the table -->
<div id="appealRequestList">
    <table>
        <tr class="mngreport-topic-heading">
            <th>   </th>
            <th>SR Code</th>
            <th>Name</th>
            <th>Offense</th>
            <th>   </th>
        </tr>
        <?php
        // Dynamically generate table rows based on fetched data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td id='appealid'>" . $row['AppealID'] . "</td>";
            echo "<td id='srcode'>" . $row['SRCode'] . "</td>";
            echo "<td id='name'>" . $row['Name'] . "</td>";
            echo "<td id='violation'>" . $row['ViolationName'] . "</td>";
            echo "<td class='centered-cell'>";
            echo "<button class='btncss' id='openAppealReq'>";
            echo "Review";
            echo "</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<script>
// Add click event listeners to each button using the unique AppealID
<?php
$result->data_seek(0); // Reset the result pointer to the beginning
while ($row = $result->fetch_assoc()) {
    echo "document.getElementById('openAppealReq_" . $row['AppealID'] . "').addEventListener('click', function() {
        alert('1');
    });";
}
?>
</script>