<?php require "./php/authenticateadmin.php"?>
<?php require "./php/dbconnection.php"?>
<?php include "./components/sidebar.php" ?>


<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="css/generatereport.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<title>Generate Report Student Conduct Management System</title>
</head>
<body>
<!-- Generate Report Form  -->
    <section class="container">
        <div class="overview">
            <h1>Create Violation Report</h1>
        </div>
        <form action="./php/actcreateviolation.php" method="POST" class="form" enctype="multipart/form-data">
        <div class="column">
              <div class="input-box">
                <label>SR Code</label>
                <input type="text" id="srCode" name="srCode" placeholder="Enter SR Code" required />
              </div>
              <div class="input-box">
                <button>Scan</button>
          </div>
          </div>
          <div class="column">
            <div class="input-box">
              <label>Date</label>
              <input type="date" id="dateInput" placeholder="Enter date" name="violationdate" required />
            </div>
            <div class="input-box">
              <label>Time</label>
              <input type="time" id="timeInput" placeholder="Enter time" name="violationtime" required />
            </div>
          </div>

          <div class="input-box">
            <label>Name</label>
            <div class="auto-input">
              <p name="studentname">Student Name</p>
            </div>
          </div>
          <div class="column">
            <div class="input-box">
              <label>Department</label>
              <div class="auto-input">
              <p name="studentdepartment">Student Department</p>
            </div>
            </div>
            <div class="input-box">
              <label>Program</label>
              <div class="auto-input">
              <p name="studentprogram">Student Program</p>
            </div>
            </div>  
          </div>
          <div class="input-box address">
            <label>Violation</label>
              <div class="select-box">
                <?php include "./php/readviolations.php"; // Include the readviolations.php file ?>
              </div>
              <input type="text" placeholder="Enter Remarks" name="remarks" />
            </div>
            <div class="column">
                <div class="input-box">
                <input type="file" name="image" accept="image/*">
            </div>
            </div>
          </div>
          <button type="submit" name="submit">Register Violation</button>
        </form>
      </section>

</body>
  <script>
    $(document).ready(function () {
      alert('ready')
    $('#srCode').on('keyup', function () {
        var srCode = $(this).val();
        alert('trigger')

        // Perform an AJAX request to fetch data from the database
        $.ajax({
            url: 'studentdata.php', // Create a PHP script to fetch data
            method: 'POST',
            data: { srCode: srCode },
            success: function (response) {
                var data = JSON.parse(response);
                if (data) {
                    // Populate the HTML elements with the retrieved data
                    $('[name="studentname"]').text(data.Name);
                    $('[name="studentdepartment"]').text(data.Department);
                    $('[name="studentprogram"]').text(data.CourseName);
                } else {
                    // Clear the HTML elements if no data is found
                    $('[name="studentname"]').text('');
                    $('[name="studentdepartment"]').text('');
                    $('[name="studentprogram"]').text('');
                }
            }
        });
    });
});
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="./js/createviolationreport.js"></script>
</html>