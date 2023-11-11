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
