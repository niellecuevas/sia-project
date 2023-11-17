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
            var vstatus = row.getAttribute('data-status'); // Add this line to define vstatus
    
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
            document.getElementById('violationstatus').value = vstatus; // Correct the ID here
    
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
    var status = document.getElementById('violationstatus').value;

    // Construct the data to be sent in the request
    var data = {
        violationID: violationID,
        srCode: srCode,
        violationDate: violationDate,
        violationTime: violationTime,
        remarks: remarks,
        violationType: violationType,
        status: status
    };

    // Send an AJAX request to update the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './php/updateviolationreport.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Handle the response from the server
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Show SweetAlert success message with adjusted z-index
            Swal.fire({
                icon: 'success',
                title: 'Update successful!',
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'sweetalert-z-index' // Add a custom class for styling
                }
            });

            // Close the container
            closeEditVio();
        } else {
            // Show SweetAlert error message with adjusted z-index
            Swal.fire({
                icon: 'error',
                title: 'Update failed',
                text: 'There was an error updating the data.',
                customClass: {
                    popup: 'sweetalert-z-index' // Add a custom class for styling
                }
            });
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
        header('violationlist.php?status=done')
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