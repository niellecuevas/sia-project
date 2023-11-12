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
                    echo "<span class='fas fa-trash'></span> Delete";
                    echo "</button>";
                    echo "</td>";
                    echo "</tr>";
            }
            ?>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./js/studentdata.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to all "Update" buttons
    var updateButtons = document.getElementsByClassName('update-button');
    for (var i = 0; i < updateButtons.length; i++) {
        updateButtons[i].addEventListener('click', function () {
            // Get the data from the clicked row
            var row = this.parentNode.parentNode;
            var violationID = row.getAttribute('data-vio-id');
            var srCode = row.getAttribute('data-srcode');
            var name = row.getAttribute('data-name');
            var department = row.getAttribute('data-department');
            var courseName = row.getAttribute('data-course-name');
            var violationDate = row.getAttribute('data-violation-date');
            var violationTime = row.getAttribute('data-violation-time');
            var violation = row.getAttribute('data-violation');
            var remarks = row.getAttribute('data-remarks');
            var violationTypeId = row.getAttribute('data-violation-type-id');

            // Fill the textbox values in the pop-up container
            document.getElementById('violationID').value = violationID;
            document.getElementById('studentsrcode').value = srCode;
            document.getElementById('studentname').innerText = name;
            document.getElementById('studentdept').innerText = department;
            document.getElementById('studentprogram').innerText = courseName;

            document.getElementById('violationreportdate').value = violationDate;

            document.getElementById('violationtime').value = violationTime;
            document.getElementById('violationtype').value = violationTypeId;
            document.getElementById('remark').value = remarks;

            // Update other fields as needed

            // Display the pop-up container
            document.querySelector('.containerEditVio').style.display = 'block';
        });
    }

    // Add event listeners to all "Delete" buttons
    var deleteButtons = document.getElementsByClassName('delete-button');
    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', function () {
            // Get the ViolationID from the data attribute
            var violationID = this.parentNode.parentNode.getAttribute('data-vio-id');

            // Call the deleteData function with the ViolationID
            deleteData(violationID);
        });
    }

    // Add event listener to the "Confirm Changes" button
    document.getElementById('confirmchanges').addEventListener('click', function () {
        // Get values from the form
        var violationID = document.getElementById('violationID').value;
        var srCode = document.getElementById('studentsrcode').value;
        var violationDate = document.getElementById('violationreportdate').value;
        var violationTime = document.getElementById('violationtime').value;
        var remarks = document.getElementById('remark').value;
        var violationType = document.getElementById('violationtype').value;

        // Construct the data to be sent in the request
        var data = {
            violationID: violationID,
            srCode: srCode,
            violationDate: violationDate,
            violationTime: violationTime,
            remarks: remarks,
            violationType: violationType
        };

        // Send an AJAX request to update the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './php/updateviolationreport.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        // Handle the response from the server
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Handle a successful response
                console.log('Update successful');

                // Close the container
                closeEditVio();
            } else {
                // Handle errors
                console.error('Update failed');
            }
        };

        // Convert the data to JSON and send the request
        xhr.send(JSON.stringify(data));
    });

    // Function to close the container
    function closeEditVio() {
        // Add your logic to close the container here
        // For example, you can hide the container or remove it from the DOM
        document.querySelector('.containerEditVio').style.display = 'none';
        header('./managereport.php')
    }

    function deleteData(id) {
        // Use SweetAlert for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: `This is a non-reversible action! Violation ${id} will not be recovered`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#a50113',
            cancelButtonColor: '#008000',
            confirmButtonText: 'Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('start');
                $(document).ready(function () {
                    console.log('ajax starting');
                    $.ajax({
                        // Action
                        url: './php/deleteviolationreport.php',
                        // Method
                        type: 'POST',
                        data: {
                            // Get Value
                            id: id,
                            action: "delete"
                        },
                        success: function (response) {
                            console.log('done');
                            // Response is the output of the action
                            if (response == 1) {
                                // Use SweetAlert for success message
                                Swal.fire(
                                    'Deleted!',
                                    'Data has been deleted.',
                                    'success'
                                );
                                document.getElementById(id).style.display = "none";
                            }
                            else if (response == 0) {
                                // Use SweetAlert for failure message
                                Swal.fire(
                                    'Error!',
                                    'Data cannot be deleted. Other functionality currently uses this information',
                                    'error'
                                );
                            }
                        }
                    });
                });
            }
        });
    }

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
});
</script>
