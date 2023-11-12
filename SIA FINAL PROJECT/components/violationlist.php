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
                    echo "<tr id='" . $row['ViolationID'] . "' data-vio-id='" . $row['ViolationID'] . "' data-name='" . $row['Name'] . "' data-violation='" . $row['ViolationName'] . "' data-date='" . $row['ViolationDate'] . "'>";
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // // Add event listeners to all "Update" buttons
    // var updateButtons = document.getElementsByClassName('update-button');
    // for (var i = 0; i < updateButtons.length; i++) {
    //     updateButtons[i].addEventListener('click', function () {
    //         // Get the ViolationID from the data attribute
    //         var violationID = this.parentNode.parentNode.getAttribute('data-vio-id');
            
    //         // Display the ViolationID using an alert (you can customize this part)
    //         alert('ViolationID: ' + violationID);
    //         document.querySelector(".containerEditVio").style.display = "block";
    //     });
    // }

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
});

function deleteData(id) {
    // Use SweetAlert for confirmation
    Swal.fire({
        title: 'Are you sure?',
        text: `This is a non reversible action! Violation ${id} will not be recovered`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('start');
            $(document).ready(function() {
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
                    success:function(response) {
                        console.log('done');
                        // Response is the output of the action
                        if(response == 1) {
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

</script>
