
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