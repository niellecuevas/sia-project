
$(document).ready(function () {
  // Get the Accept button
  var acceptButton = $("#acceptbutton");

  // Add click event listener
  acceptButton.on("click", function () {
    // Get the values from the hidden p elements
    var appealID = $("#apappealid").text();
    var violationID = $("#apviolationid").text();

    // Run the SQL deletion
    deleteRecords(appealID, violationID);
  });

  function deleteRecords(appealID, violationID) {
    $.ajax({
      type: "POST",
      url: "./php/deleteappealandviolation.php",
      data: { appealID: appealID, violationID: violationID },
      success: function (response) {
        // Show SweetAlert2 notification based on the response
        if (response.success) {
          closeAppealRequest();
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Records deleted successfully',
          }).then(function() {
            location.reload(); // Reload the page after success
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to delete records',
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Failed to communicate with the server',
        });
      },
    });
  }

  // Function to close the container
  function closeAppealRequest() {
    document.querySelector('.containerAppealRequest').style.display = 'none';
  }
});