document.getElementById("openEditForm").addEventListener("click", function() {
    document.querySelector(".containerEditVio").style.display = "block";
});
 function closeEditVio() {
    document.querySelector(".containerEditVio").style.display = "none";
}

document.getElementById("openCallSlipForm").addEventListener("click", function() {
    document.querySelector(".containerCallSlipForm").style.display = "block";
});
 function closeCallSlipForm() {
    document.querySelector(".containerCallSlipForm").style.display = "none";
}

 function closeAppealRequest() {
    document.querySelector(".containerAppealRequest").style.display = "none";
}