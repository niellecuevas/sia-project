document.addEventListener("DOMContentLoaded", function () {
    // Select all delete buttons
    const deleteButtons = document.querySelectorAll(".delete-button");

    // Add click event listener to each delete button
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Get the ViolationID from the data-id attribute
            const id = button.dataset.id;

            // Confirm deletion
            if (confirm("Are you sure you want to delete this record?")) {
                // Send AJAX request to delete record
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "./deleteviolation.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Reload the page or update the table as needed
                        // For example: window.location.reload();
                    }
                };
                xhr.send("id=" + id);
            }
        });
    });
});