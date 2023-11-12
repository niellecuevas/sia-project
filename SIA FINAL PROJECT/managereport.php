<?php include "./components/sidebar.php" ?>
<?php require "./php/authenticateadmin.php"?>
<!DOCTYPE html>
<html>
    <head>

    <link rel="stylesheet" href="css/managereport.css">
    <link rel="stylesheet" href="css/updatepopup.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Report Manager</title>
    </head>
<body>
    <section class="mngreport-container">
                <h1 class="">Report Manager</h1>
                <button class="tab-button" id="vio-list" onclick="switchTable('violationList', 'vio-list')">Violation List</button>
                <!-- <button class="tab-button" id="call-slip-req" onclick="switchTable('callslipReqList', 'call-slip-req')">Call Slip Required List</button> -->
                <button class="tab-button" id="appeal-req" onclick="switchTable('appealRequestList', 'appeal-req')">Appeal Request List</button>
                <?php include './php/adminsort.php'?>
                <!--violation list table-->
            <div class="mngreport-body">
                <?php include "./php/violationlist.php"?>
                <?php include "./php/appeallist.php"?>

                <!--call slip required table-->
                <!-- <div id="callslipReqList">
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
                            <button class="btncss" id="openCallSlipForm">
                                    Call Slip
                                </button>
                            </td>
                        </tr>
                    </table>
                </div> -->
                <!--appeal request table-->
              </div>
      </section>
    <!--edit violation report-->
    <section class="containerEditVio">
        <div class="edit-vio">
            <h1>Edit Violation Report</h1>
        </div>
        <button class="close-button" onclick="closeEditVio()">&times;</button>
        <form action="#" class="form">
          <div class="column">
              <div class="input-box">
                <label>SR Code</label>
                <input type="text" placeholder="Enter SR Code" required />
              </div>
              <div class="input-box">
                <button>Scan</button>
          </div>
          </div>
          <div class="input-box">
            <label>Name</label>
            <div class="auto-input">
              <p name="studentName">Student Name</p>
            </div>
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

          <div class="column">
          <div class="input-box">
            <label>Department</label>
            <div class="auto-input">
              <p name="studentDept">Student Department</p>
            </div>
          </div>
          <div class="input-box">
            <label>Program</label>
            <div class="auto-input">
              <p name="studentProgram">Student Program</p>
            </div>
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
          <button>Confirm Changes</button>
        </form>
      </section>

      <!--generate callslip-->
      <section class="containerCallSlipForm">
        <div class="generate-callslip">
            <h1>Generate Call Slip</h1>
        </div>
        <button class="close-button" onclick="closeCallSlipForm()">&times;</button>
        <form action="#" class="form">
        <div class="column">
          <div class="input-box">
            <label>SR Code</label>
            <input type="text" placeholder="Enter SR Code" required />
          </div>
          <div class="input-box">
            <button>Scan</button>
          </div>

          </div>
          <div class="input-box">
            <label>Name</label>
            <div class="auto-input">
              <p name="studentName">Student Name</p>
            </div>
          </div>
          <div class="input-box">
            <label>Date</label>
            <input type="date" id="generateId" placeholder="Enter date" required />
          </div>
          <div class="column">
          <div class="input-box">
            <label>Department</label>
            <div class="auto-input">
              <p name="studentDept">Student Department</p>
            </div>
          </div>
          <div class="input-box">
            <label>Program</label>
            <div class="auto-input">
              <p name="studentProgram">Student Program</p>
            </div>
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

      <!--appeal request-->
      <section class="containerAppealRequest">
        <div class="review-appeal">
            <h1>Appeal Request</h1>
        </div>
        <button class="close-button" onclick="closeAppealRequest()">&times;</button>
        <form action="#" class="form">
        <div class="input-box">
            <label>SR Code</label>
            <input type="text" placeholder="Enter SR Code" required />
          </div>
          <div class="input-box">
            <label>Name</label>
            <div class="auto-input">
              <p name="studentName">Student Name</p>
            </div>
          </div>
          <div class="input-box">
            <label>Date</label>
            <input type="date" id="generateId" placeholder="Enter date" required />
          </div>
          <div class="column">
          <div class="input-box">
            <label>Department</label>
            <div class="auto-input">
              <p name="studentDept">Student Department</p>
            </div>
          </div>
          <div class="input-box">
            <label>Program</label>
            <div class="auto-input">
              <p name="studentProgram">Student Program</p>
            </div>
          </div>
          </div>
          <div class="input-box">
              <label>Request</label>
              <textarea style="width:100%; height:100px; resize:none;" placeholder="Message here" required ></textarea>
            </div>
          <div class="column">
            <button>Accept</button>
            <button>Deny</button>
          </div>
        </form>
      </section>
    <script src="js/managereport.js"></script>
    <script>
        document.getElementById("openEditForm").addEventListener("click", function() {
            document.querySelector(".containerEditVio").style.display = "block";
        });
         function closeEditVio() {
            document.querySelector(".containerEditVio").style.display = "none";
        }

        document.getElementById("openCallSlipForm").addEventListener("click", function() {
            document.querySelector(".containerCallSlipForm").style.display = "block";
        });
         function closeCallSlipForm() {
            document.querySelector(".containerCallSlipForm").style.display = "none";
        }
        

         function closeAppealRequest() {
            document.querySelector(".containerAppealRequest").style.display = "none";
        }
    </script>
</body>
</html>