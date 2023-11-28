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
            <th>Appeal Date</th>
            <th>   </th>
        </tr>
        <?php
        // Dynamically generate table rows based on fetched data
        while ($row = $result->fetch_assoc()) {
            echo "<tr id = '" . 'ap'. $row['appealid'] . 
                 "' dataAppealID = '" . $row['appealid'] . 
                 "' dataStudID = '" . $row['studid'] . 
                 "' dataStudentName = '" . $row['name'] . 
                 "' dataViolationName = '" . $row['violationame'] . 
                 "' dataDepartment = '" . $row['department'] . 
                 "' dataCourseName = '" . $row['course'] . 
                 "' dataAppealDate = '" . $row['appealdate'] . 
                 "' dataViolationName = '" . $row['violationame'] . 
                 "' dataViolationDate = '" . $row['violationdate'] . 
                 "' dataViolationTime = '" . $row['violationtime'] . 
                 "' dataStaffName = '" . $row['staffname'] . 
                 "' dataRemarks = '" . $row['remarks'] . 
                 "' dataAppeal = '" . $row['appeal'] . 
                 "' dataViolationID = '" . $row['violationid'] . 
                 "' dataEvidence = '" . $row['evidence'] . 
                 "' dataStatus = '" . $row['status'] . "'>";

            echo "<td id='appealid'>" . $row['appealid'] . "</td>";
            echo "<td id='srcode'>" . $row['studid'] . "</td>";
            echo "<td id='name'>" . $row['name'] . "</td>";
            echo "<td id='violation'>" . $row['violationame'] . "</td>";
            echo "<td id='appealdate'>" . $row['date'] . "</td>";
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
            var studid = row.getAttribute('dataStudID');
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
            var evidence = row.getAttribute('dataEvidence');
            var status = row.getAttribute('dataStatus');

            document.getElementById('apstudid').innerText = studid;
            document.getElementById('apstudentname').innerText = studentName;
            document.getElementById('apstudentdepartment').innerText = department;
            document.getElementById('apstudentprogram').innerText = courseName;
            document.getElementById('apstudentprogram').innerText = courseName;
            document.getElementById('apappealdate').innerText = appealDate;
            document.getElementById('apviolationname').innerText = violationName;
            document.getElementById('apviolationdate').innerText = violationDate;
            document.getElementById('apviolationtime').innerText = violationTime;
            document.getElementById('apstaffname').innerText = staffName;
            document.getElementById('apremarks').innerText = remarks;
            document.getElementById('apappeal').innerText = appeal;
            document.getElementById('apviolationid').innerHTML = violationID;
            document.getElementById('apappealid').innerHTML = appealID;
            document.getElementById('apviolationstatus').innerHTML = status;
            document.getElementById('apevidence').src = "./img/violationEvidence/" + evidence;

            // Display the pop-up container
            document.querySelector('.containerAppealRequest').style.display = 'block';
        });
    }
});
</script>