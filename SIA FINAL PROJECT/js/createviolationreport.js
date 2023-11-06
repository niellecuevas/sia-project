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
