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
            <th>   </th>
            <th>SR Code</th>
            <th>Name</th>
            <th>Offense</th>
            <th>   </th>
        </tr>
        <?php
        // Dynamically generate table rows based on fetched data
        while ($row = $result->fetch_assoc()) {
            echo "<tr >";
            echo "<td id='appealid'>" . $row['AppealID'] . "</td>";
            echo "<td id='srcode'>" . $row['SRCode'] . "</td>";
            echo "<td id='name'>" . $row['Name'] . "</td>";
            echo "<td id='violation'>" . $row['ViolationName'] . "</td>";
            echo "<td class='centered-cell'>";
            echo "<button class='btncss' id='openAppealReq'>Review</button>";
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
    var appealButtons = document.getElementsByClassName('containerAppealRequest');
    for (var i = 0; i < appealButtons.length; i++) {
        appealButtons[i].addEventListener('click', function () {
            // Display the pop-up container
            document.querySelector('.containerAppealRequest').style.display = 'block';
        });
    }
});
</script>