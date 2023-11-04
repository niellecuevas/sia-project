function switchTable(tableId) {
    var tables = document.querySelectorAll('.mngreport-body > div');
    for (var i = 0; i < tables.length; i++) {
        tables[i].style.display = 'none';
    }
    document.getElementById(tableId).style.display = 'block';
}