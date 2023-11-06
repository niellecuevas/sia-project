    // Function to update date and time input fields with current date and time
    function setCurrentDateAndTime() {
        const currentDate = new Date();
        const dateInput = document.getElementById('dateInput');
        const timeInput = document.getElementById('timeInput');

        // Format date to 'YYYY-MM-DD' for the date input
        const formattedDate = currentDate.toISOString().slice(0, 10);
        dateInput.value = formattedDate;

        // Format time to 'HH:MM' for the time input
        const hours = String(currentDate.getHours()).padStart(2, '0');
        const minutes = String(currentDate.getMinutes()).padStart(2, '0');
        const formattedTime = `${hours}:${minutes}`;
        timeInput.value = formattedTime;
    }

    // Call the function to set the initial values when the page loads
    setCurrentDateAndTime();

// Check if the "status" parameter is present in the URL
const urlParams = new URLSearchParams(window.location.search);
const operationStatus = urlParams.get('status');

if (operationStatus === 'InsertSuccess') {
    // Display a SweetAlert2 success message
    Swal.fire({
        icon: 'success',
        title: 'Violation Recorded',
        text: 'Student Violation has been successfully recorded.',
        showConfirmButton: false,
        timer: 3000 // Automatically close after 2 seconds
    });

    // Redirect to another page after the alert
    setTimeout(() => {
        window.location.href = './createviolationreport.php';
    }, 3000); // Redirect after 2 seconds
}
else if (operationStatus === 'InsertFail') {
    // Display a SweetAlert2 failed message
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Error Occured',
        text: 'An error occured while recording the student violation, please contact your administrator.',
        showConfirmButton: false,
        timer: 3000 // Automatically close after 2 seconds
    });

    // Redirect to another page after the alert
    setTimeout(() => {
        window.location.href = './createviolationreport.php';
    }, 3000); // Redirect after 2 seconds
}
else if (operationStatus === 'Missing') {
    // Display a SweetAlert2 missing message
    Swal.fire({
        icon: 'error',
        title: 'Missing Files Detected',
        text: 'Missing Fields, please fill out all fields and try again.',
        showConfirmButton: false,
        timer: 3000 // Automatically close after 2 seconds
    });

        // Redirect to another page after the alert
        setTimeout(() => {
            window.location.href = './createviolationreport.php';
        }, 3000); // Redirect after 2 seconds
}
    
    
