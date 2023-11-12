<?php
// Check if a sort option is selected
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'default';
?>

<div class="dropdown">
    <select id="sortDropdown" onchange="sortTable('violationList', this.value)">
        <option value="default" <?php echo ($sortOption == 'default') ? 'selected' : ''; ?>>Sort By ID</option>
        <option value="option1" <?php echo ($sortOption == 'option1') ? 'selected' : ''; ?>>Sort By Violation</option>
        <option value="option2" <?php echo ($sortOption == 'option2') ? 'selected' : ''; ?>>Sort By Student</option>
    </select>
</div>
