// Get the ID input and the form
const idInput = document.getElementById("idInput");
const loginForm = document.getElementById("loginForm");

// Add an event listener to the radio buttons
const radioButtons = document.querySelectorAll(".radio");
radioButtons.forEach((radio) => {
    radio.addEventListener("change", function () {
        if (this.value === "admin") {
            // If Admin is selected, change the ID input placeholder
            idInput.placeholder = "Staff Id";
            // Update the form action for Admin
            loginForm.action = "./php/actlogin.php?role=admin";
        } else {
            // If User is selected, change the ID input placeholder
            idInput.placeholder = "SR Code";
            // Update the form action for User
            loginForm.action = "./php/actlogin.php?role=user";
        }
    });
});