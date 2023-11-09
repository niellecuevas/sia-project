<?php

// Fetch the violation types from the database
// Call the stored procedure "GetViolationTypes" in the database
$query = "CALL SP_GetViolationTypes()";
// Execute the stored procedure and store the result in the $result variable
$result = $conn->query($query);

?>

<select name="violationtype">
    <!-- Default hidden option in the dropdown -->
    <option value="Violation" hidden>Select Violation</option>
    <?php
    // Dynamically generate the options using data from the database result
    while ($row = $result->fetch_assoc()) {
        // Generate an <option> element for each violation type with the ViolationTypeID as the value and ViolationName as the label
        echo "<option value='" . $row['ViolationTypeID'] . "'>" . $row['ViolationName'] . "</option>";
    }
    ?>
</select>
