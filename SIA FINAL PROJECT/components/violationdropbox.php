<?php

// Fetch the violation types from the database
// Call the stored procedure "GetViolationTypes" in the database
$query = "CALL SP_GetViolationTypes()";
// Execute the stored procedure and store the result in the $result variable
$result = $conn->query($query);

?>

<div class="input-box address">
    <label style="font-weight: bold;">Violation</label>
    <div class="select-box">
        <select name="violationtype" id="violationtype">
            <!-- Default hidden option in the dropdown -->
            <option value="Violation" hidden>Select Violation</option>

            <?php
            // Dynamically generate the options using data from the database result
            while ($row = $result->fetch_assoc()) {
                // Generate an <option> element for each violation type with the ViolationTypeID as the value and ViolationName as the label
                echo "<option value='" . $row['violationtypeid'] . "'>" . $row['violationame'] . "</option>";
            }
        ?>
        </select>
    </div>
</div>
