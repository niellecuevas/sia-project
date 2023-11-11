
function switchTable(tableId, buttonId, sortOption) {
    var tables = document.querySelectorAll('.mngreport-body > div');
    for (var i = 0; i < tables.length; i++) {
      tables[i].style.display = 'none'; 
    }
    document.getElementById(tableId).style.display = 'block';
  
    var buttons = document.querySelectorAll('.tab-button');
    buttons.forEach(function (btn) {
      btn.classList.remove('highlighted');
    });
  
    document.getElementById(buttonId).classList.add('highlighted');
    header("Location: ../managereport.php?sort=" + sortOption);
  }

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
