<?php include "./components/sidebar.php" ?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="css/generatereport.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <title>Generate Callslip</title>
    </head>
<body>
<section class="container">
        <div class="overview">
            <h1>Generate Call Slip</h1>
        </div>
        <form action="#" class="form">
          <div class="input-box">
            <label>Date</label>
            <input type="date" placeholder="Enter date" required />
          </div>
          <div class="input-box">
            <label>Student</label>
            <input type="text" placeholder="Enter Student's Full Name" required />
          </div>
          <div class="column">
            <div class="input-box">
              <label>Program</label>
              <input type="text" placeholder="Enter program" required />
            </div>
            <div class="input-box">
              <label>Section</label>
              <input type="text" placeholder="Enter section
              " required />
            </div>
          </div>

          <div class="column">
            <div class="input-box">
              <label>Call Date</label>
              <input type="date" placeholder="Enter date" required />
            </div>
            <div class="input-box">
              <label>Call Time</label>
              <input type="time" placeholder="Enter time" required />
            </div>
          </div>
          <div class="input-box address">
            <label>Action</label>
              <div class="select-box">
                <select>
                  <option hidden>Action</option>
                  <option>Option1</option>
                  <option>Option2</option>
                  <option>Option3</option>
                  <option>Option4</option>
                </select>
              </div>
              <label>Remarks</label>
              <input type="text" placeholder="Enter remarks" required />
            </div>
            </div>
          </div>
          <button>Notify</button>
        </form>
      </section>
</body>
</html>