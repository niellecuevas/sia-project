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
        <form action="#" class="form">
          <div class="input-box">
            <label>Department</label>
            <input type="text" placeholder="Enter department" required />
          </div>
          <div class="column">
            <div class="input-box">
              <label>Date</label>
              <input type="date" placeholder="Enter date" required />
            </div>
            <div class="input-box">
              <label>Time</label>
              <input type="time" placeholder="Enter time" required />
            </div>
          </div>

          <div class="input-box">
            <label>Name</label>
            <input type="text" placeholder="Enter Name" required />
          </div>
          <div class="column">
            <div class="input-box">
              <label>SR Code</label>
              <input type="text" placeholder="Enter SR-Code" required />
            </div>
            <div class="input-box">
              <label>Program</label>
              <input type="text" placeholder="Enter program" required />
            </div>
            <div class="input-box">
              <label>Section</label>
              <input type="text" placeholder="Enter section" required />
            </div>  
          </div>
          <div class="input-box address">
            <label>Violation</label>
              <div class="select-box">
                <select>
                  <option hidden>Violation</option>
                  <option>Hair cut</option>
                  <option>Hair color</option>
                  <option>Improper Unifrom</option>
                  <option>Bullying</option>
                </select>
              </div>
              <input type="text" placeholder="Enter description" required />
            </div>
            <div class="column">
                <div class="input-box">
                <form action="/upload_image" method="post" enctype="multipart/form-data">
                <input type="file" name="image" accept="image/*">
            </div>
            </div>
          </div>
          <button>Register Violation</button>
        </form>
      </section>

</body>
</html>