<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="input-box">
    <label style="font-weight: bold;">Sanction</label>
    <input type="text" id="remarks" name="remarks" placeholder="Sanction"required />
</div>

<script>
$(document).ready(function() {
    // Function to update remarks based on selected violation type
    function updateRemarks() {
        // Get the selected violation type ID
        var selectedViolationTypeID = $('#violationtype').val();
        var selectedSRCode = $('#srCode').val();

        // Check if a violation type is selected
        if (selectedViolationTypeID) {
            // Make an AJAX request to fetch the description
            $.ajax({
                type: 'POST',
                url: './php/getdescription.php', // Replace with the actual path to your PHP file
                data: { id: selectedViolationTypeID, srCode: selectedSRCode },
                success: function(response) {
                    // Update the remarks textbox with the fetched description
                    $('#remarks').val(response);
                }
            });
        } else {
            // Clear the remarks textbox if no violation type is selected
            $('#remarks').val('');
        }
    }

    // Attach the updateRemarks function to the change event of the violation type dropdown
    $('#violationtype').on('change', updateRemarks);

    // Call updateRemarks on page load to handle any pre-selected violation type
    updateRemarks();
});
</script>
