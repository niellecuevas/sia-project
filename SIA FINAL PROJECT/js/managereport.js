function switchTable(tableId, buttonId) {
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
  }