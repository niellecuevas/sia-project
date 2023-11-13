function switchTable(tableId, buttonId) {
  // Hide all tables
  var tables = document.querySelectorAll('.mngreport-body > div');
  tables.forEach(function (table) {
      table.style.display = 'none';
  });

  // Show the selected table
  document.getElementById(tableId).style.display = 'block';

  // Remove the "highlighted" class from all buttons
  var buttons = document.querySelectorAll('.tab-button');
  buttons.forEach(function (btn) {
      btn.classList.remove('highlighted');
  });

  // Add the "highlighted" class to the clicked button
  document.getElementById(buttonId).classList.add('highlighted');
}

// Function to set the active tab based on the URL parameter
function setActiveTab() {
  var urlParams = new URLSearchParams(window.location.search);
  var tableParam = urlParams.get('table');

  // Default to "vio-list" if no table parameter is specified
  var defaultTab = 'vio-list';

  if (tableParam === 'appeal') {
    defaultTab = 'appeal-req';
  }

  // Switch to the specified tab
  switchTable(defaultTab, defaultTab);
}

// Function to reload the page when the sort option changes
document.getElementById('sortDropdown').addEventListener('change', function () {
  const sortOption = this.value;
  const currentUrl = new URL(window.location.href);
  currentUrl.searchParams.set('sort', sortOption);
  window.location.href = currentUrl;
});

// Function to get today's date in the format "YYYY-MM-DD"
function getCurrentDate() {
  const today = new Date();
  const year = today.getFullYear();
  const month = String(today.getMonth() + 1).padStart(2, '0');
  const day = String(today.getDate()).padStart(2, '0');
  return `${year}-${month}-${day}`;
}

// Set the value of the generateId input field to today's date
document.addEventListener('DOMContentLoaded', function () {
  const generateIdInput = document.getElementById('generateId');
  if (generateIdInput) {
    generateIdInput.value = getCurrentDate();
  }
});

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

  // Call the function to set the active tab
  setActiveTab();
});