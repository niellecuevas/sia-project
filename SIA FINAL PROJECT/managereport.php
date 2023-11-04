<?php include "./components/sidebar.php" ?>
<!DOCTYPE html>
<html>
    <head>

    <link rel="stylesheet" href="css/managereport.css">
    <link rel="stylesheet" href="css/generatereport.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Report Manager</title>
    </head>
<body>
    <section class="mngreport-container">
                <h1 class="">Report Manager</h1>
                <button class="tab-button" id="vio-list" onclick="switchTable('violationList')">Violation List</button>
                <button class="tab-button" id="call-slip-req" onclick="switchTable('callslipReqList')">Call Slip Required List</button>
                    <div class="dropdown">
                    <select id="sortDropdown">
                        <option value="" disabled selected>Sort</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                    </div>
            </div>
            <div class="mngreport-body">
                <div id="violationList">
                    <table>
                        <tr class="mngreport-topic-heading">
                            <th>   </th>
                            <th>Name</th>
                            <th>Violation</th>
                            <th>Date</th>
                            <th>   </th>
                            <th>   </th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Sofia Mae Pepito</td>
                            <td>Multiple piercings</td>
                            <td>10/10/10</td>
                            <td class="centered-cell">
                                <button class="btncss" id="openForm">
                                    Update
                                </button>
                            </td>
                            <td class="centered-cell">
                            <button class="btncss" onclick="SubmitEvent">
                                    <span class="fas fa-trash"></span>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>

                <div id="callslipReqList">
                    <table>
                        <tr class="mngreport-topic-heading">
                            <th>   </th>
                            <th>Name</th>
                            <th>Program</th>
                            <th>Minor Offense Quantity</th>
                            <th>Major Offense Quantity</th>
                            <th>   </th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Sofia Mae Pepito</td>
                            <td>BSIT BA</td>
                            <td>10</td>
                            <td>10</td>
                            <td class="centered-cell">
                            <button class="btncss" onclick="SubmitEvent">
                                    Call Slip
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
    </section>

    <section class="container">
        <div class="overview">
            <h1>Create Violation Report</h1>
        </div>
        <button class="close-button" onclick="closeForm()">&times;</button>
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
    
    <script src="js/managereport.js"></script>
    <script>
        document.getElementById("openForm").addEventListener("click", function() {
            document.querySelector(".container").style.display = "block";
        });
         function closeForm() {
            document.querySelector(".container").style.display = "none";
        }
    </script>
</body>
</html>