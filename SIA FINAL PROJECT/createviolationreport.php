<?php include "./components/sidebar.php" ?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="css/generatereport.css">

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
        <form action="./php/actcreateviolation.php" method="POST" class="form">
        <div class="input-box">
              <label>SR Code</label>
              <input type="text" placeholder="Enter SR-Code" name="srcode" required />
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
            <input type="text" placeholder="Student Name" name="studentname" required />
          </div>
          <div class="column">
            <div class="input-box">
              <label>Department</label>
              <input type="text" placeholder="Department" name="studentdepartment" required />
            </div>
            <div class="input-box">
              <label>Program</label>
              <input type="text" placeholder="Program" name="studentprogram" required />
            </div>
            <div class="input-box">
              <label>Section</label>
              <input type="text" placeholder="Section" name="studentsection" required />
            </div>  
          </div>
          <div class="input-box address">
            <label>Violation</label>
              <div class="select-box">
                <select name="violationtype">
                  <option value="Violation" hidden>Violation</option>
                  <option value="1">Hair cut</option>
                  <option value="2">Hair color</option>
                  <option value="3">Improper Unifrom</option>
                  <option value="4">Bullying</option>
                </select>
              </div>
              <input type="text" placeholder="Enter Remarks" name="remarks" />
            </div>
            <div class="column">
                <div class="input-box">
                <form action="/upload_image" method="post" enctype="multipart/form-data">
                <input type="file" name="image" accept="image/*">
            </div>
            </div>
          </div>
          <button type="submit" name="submit">Register Violation</button>
        </form>
      </section>

</body>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="./js/createviolationreport.js"></script>
</html>