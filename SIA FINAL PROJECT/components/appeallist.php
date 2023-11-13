<?php
require "./php/dbconnection.php";

// Check if a sort option is selected
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Fetch data using the stored procedure
$result = fetchAppeal($conn, $sortOption);

function fetchAppeal($conn, $sortOption)
{
    // Prepare the stored procedure call
    $stmt = $conn->prepare("CALL SP_GetAppeals(?)");
    $stmt->bind_param("s", $sortOption);

    // Execute the stored procedure
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Close the statement
    $stmt->close();

    // Return the result set
    return $result;
}
?>


<!-- Include the dropdown box code from adminsort.php -->

<!-- Rest of the code for the table -->
<div id="appealRequestList">
    <table>
        <tr class="mngreport-topic-heading">
            <th>ID</th>
            <th>SR Code</th>
            <th>Name</th>
            <th>Offense</th>
            <th>   </th>
        </tr>
        <?php
        // Dynamically generate table rows based on fetched data
        while ($row = $result->fetch_assoc()) {
            echo "<tr id = '" . 'ap'. $row['AppealID'] . 
                 "' dataAppealID = '" . $row['AppealID'] . 
                 "' dataSRCode = '" . $row['SRCode'] . 
                 "' dataStudentName = '" . $row['Name'] . 
                 "' dataViolationName = '" . $row['ViolationName'] . 
                 "' dataDepartment = '" . $row['Department'] . 
                 "' dataCourseName = '" . $row['CourseName'] . 
                 "' dataAppealDate = '" . $row['AppealDate'] . 
                 "' dataViolationName = '" . $row['ViolationName'] . 
                 "' dataViolationDate = '" . $row['ViolationDate'] . 
                 "' dataViolationTime = '" . $row['ViolationTime'] . 
                 "' dataStaffName = '" . $row['StaffName'] . 
                 "' dataRemarks = '" . $row['Remarks'] . 
                 "' dataAppeal = '" . $row['Appeal'] . 
                 "' dataViolationID = '" . $row['ViolationID'] . "'>";

            echo "<td id='appealid'>" . $row['AppealID'] . "</td>";
            echo "<td id='srcode'>" . $row['SRCode'] . "</td>";
            echo "<td id='name'>" . $row['Name'] . "</td>";
            echo "<td id='violation'>" . $row['ViolationName'] . "</td>";
            echo "<td class='centered-cell'>";
            echo "<button class='btncss openAppealReq' id='openAppealReq'>Review</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>

<script>
// Add click event listeners to each button using the unique AppealID
document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to all "Appeal" buttons
    var appealButtons = document.getElementsByClassName('openAppealReq');
    for (var i = 0; i < appealButtons.length; i++) {
        appealButtons[i].addEventListener('click', function () {
            var row = this.parentNode.parentNode;
            var appealID = row.getAttribute('dataAppealID');
            var srCode = row.getAttribute('dataSRCode');
            var studentName = row.getAttribute('dataStudentName');
            var violationName = row.getAttribute('dataViolationName');
            var department = row.getAttribute('dataDepartment');
            var courseName = row.getAttribute('dataCourseName');
            var appealDate = row.getAttribute('dataAppealDate');
            var violationDate = row.getAttribute('dataViolationDate');
            var violationTime = row.getAttribute('dataViolationTime');
            var staffName = row.getAttribute('dataStaffName');
            var remarks = row.getAttribute('dataRemarks');
            var appeal = row.getAttribute('dataAppeal');
            var violationID = row.getAttribute('dataViolationID');

            document.getElementById('apsrcode').value = srCode;
            document.getElementById('apstudentname').innerText = studentName;
            document.getElementById('apstudentdepartment').innerText = department;
            document.getElementById('apstudentprogram').innerText = courseName;
            document.getElementById('apstudentprogram').innerText = courseName;
            document.getElementById('apappealdate').value = appealDate;
            document.getElementById('apviolationname').innerText = violationName;
            document.getElementById('apviolationdate').innerText = violationDate;
            document.getElementById('apviolationtime').innerText = violationTime;
            document.getElementById('apstaffname').innerText = staffName;
            document.getElementById('apremarks').innerText = remarks;
            document.getElementById('apappeal').value = appeal;
            document.getElementById('apviolationid').innerHTML = violationID;
            document.getElementById('apappealid').innerHTML = appealID;

            // Display the pop-up container
            document.querySelector('.containerAppealRequest').style.display = 'block';
        });
    }
});
</script>