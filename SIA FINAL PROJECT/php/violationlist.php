<?php
require "dbconnection.php";
// Check if a sort option is selected
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Fetch data using the function
$result = fetchData($conn, $sortOption);

function fetchData($conn, $sortOption)
{
    // Define the default query without ORDER BY clause
    $query = "SELECT ViolationID, CONCAT(FirstName, ' ', SUBSTRING(MiddleName, 1, 1), '. ', LastName) AS Name, ViolationName, ViolationDate FROM `tbl_violationreport` INNER JOIN tbl_students ON tbl_violationreport.SRCode = tbl_students.SRCode INNER JOIN tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID";

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

    // Return the result set
    return $result;
}
?>
<!-- Include the dropdown box code from adminsort.php -->

    <div id="violationList">
        <table>
            <tr class="mngreport-topic-heading">
                <th>   </th>
                <th>Name</th>
                <th>Violation</th>
                <th>Date</th>
                <th>   </th>
                <th>   </th>
            </tr>
            <?php
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
    </table>
</div>

<script>
function sortTable(containerId, sortOption) {
    // Make an asynchronous request to the server to fetch sorted data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the table content with the sorted data
            document.getElementById(containerId).innerHTML = xhr.responseText;
        }
    };

    // Send the request with the selected sort option
    xhr.open("GET", "./php/violationlist.php?sort=" + sortOption, true);
    xhr.send();
}
</script>
