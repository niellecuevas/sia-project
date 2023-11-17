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