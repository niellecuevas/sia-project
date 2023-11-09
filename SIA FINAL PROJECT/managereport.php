<?php include "./components/sidebar.php" ?>
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
                <button class="tab-button" id="call-slip-req" onclick="switchTable('callslipReqList', 'call-slip-req')">Call Slip Required List</button>
                <button class="tab-button" id="appeal-req" onclick="switchTable('appealRequestList', 'appeal-req')">Appeal Request List</button>
                    <div class="dropdown">
                    <select id="sortDropdown">
                        <option value="" disabled selected>Sort</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                    </div>
            <!--violation list table-->
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
                                <button class="btncss" id="openEditForm">
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
                <!--call slip required table-->
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
                            <button class="btncss" id="openCallSlipForm">
                                    Call Slip
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--appeal request table-->
                <div id="appealRequestList">
                    <table>
                        <tr class="mngreport-topic-heading">
                            <th>   </th>
                            <th>SR Code</th>
                            <th>Name</th>
                            <th>Offense</th>
                            <th>   </th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>21-31662</td>
                            <td>Sofia Mae</td>
                            <td>Improper Haircut</td>
                            <td class="centered-cell">
                            <button class="btncss" id="openAppealReq">
                                    Review
                                </button>
                            </td>
                          </tr>
                      </table>
                  </div>
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
            <input type="text" placeholder="Enter Name" required />
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
              <input type="text" placeholder="Enter Department" required />
            </div>
            <div class="input-box">
              <label>Program</label>
              <input type="text" placeholder="Enter program" required />
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
            <label>Student</label>
            <input type="text" placeholder="Enter Student's Full Name" required />
          </div>
          <div class="input-box">
            <label>Date</label>
            <input type="date" id="generateId" placeholder="Enter date" required />
          </div>
          <div class="column">
            <div class="input-box">
              <label>Department</label>
              <input type="text" placeholder="Enter Department" required />
            </div>
            <div class="input-box">
              <label>Program</label>
              <input type="text" placeholder="Enter program" required />
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
            <label>Student</label>
            <input type="text" placeholder="Enter Student's Full Name" required />
          </div>
          <div class="column">
          <div class="input-box">
            <label>Date</label>
            <input type="date" id="generateId" placeholder="Enter date" required />
          </div>
            <div class="input-box">
              <label>Program</label>
              <input type="text" placeholder="Enter program" required />
            </div>
          </div>
          <div class="input-box">
              <label>Remarks</label>
              <input type="text" placeholder="Enter remarks" required />
            </div>
          <div class="column">
            <button>Accept</button>
            <button>Deny</button>
          </div>
        </form>
      </section>
    
    <script src="./js/managereporttime.js"></script>
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
    </script>
</body>
</html>