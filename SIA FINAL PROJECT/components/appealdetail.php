
      <!--appeal request-->
      <section class="containerAppealRequest">
        <div class="review-appeal">
            <h1>Appeal Request</h1>
        </div>
        <button class="close-button" onclick="closeAppealRequest()">&times;</button>
        <form action="#" class="form">

        <div class="input-box">
          <label hidden><b>ViolationID</b></label>
          <p id="apviolationid" hidden>ViolationID</p>
        </div>

        <div class="input-box">
          <label hidden><b>AppealID</b></label>
          <p id="apappealid" hidden>AppealID</p>
        </div>

        <div class="input-box">
          <label style="font-weight: bold;">SR Code</label>
          <p id="apstudid">SR Code</p>
        </div>

        <div class="input-box">
          <label style="font-weight: bold;">Name</label>
          <div class="auto-input">
            <p name="studentName" id="apstudentname">Student Name</p>
          </div>
        </div>

        <div class="column">
        <div class="input-box">
          <label style="font-weight: bold;">Department</label>
          <div class="auto-input">
            <p name="studentDept" id="apstudentdepartment">Student Department</p>
          </div>
        </div>
        <div class="input-box">
          <label style="font-weight: bold;">Program</label>
          <div class="auto-input">
            <p name="studentProgram" id="apstudentprogram">Student Program</p>
          </div>
        </div>
        </div>

        <div class="input-box">
          <label style="font-weight: bold;">Date</label>
          <p id="apappealdate" class="appealdate">Date</p>
        </div>

        <div class="review-appeal">
          <h1><br>Violation Details</h1>
        </div>

        <div class="column">
          <div class="input-box">
            <label style="font-weight: bold;">Violation</label>
            <div class="auto-input">
              <p name="violationDetail" id="apviolationname">Violation</p>
            </div>
          </div>
          <div class="input-box">
            <label style="font-weight: bold;">Date</label>
            <div class="auto-input">
              <p name="violationDate" id="apviolationdate">MM/DD/YYYY</p>
            </div>
          </div>
          <div class="input-box">
            <label style="font-weight: bold;">Time</label>
            <div class="auto-input">
              <p name="violationTime" id="apviolationtime">0:00</p>
            </div>
          </div>
        </div>

        <div class="input-box">
          <label style="font-weight: bold;">Handler</label>
          <div class="auto-input">
            <p name="violationHandlerName" id="apstaffname">Handler Name</p>
          </div>
        </div>

        <div class="input-box">
          <label style="font-weight: bold;">Evidence</label>
          <div class="auto-input">
            <p name="violationstatus" id="apviolationstatus">Violation Status</p>
          </div>
        </div>

        </div>
        <div class="input-box">
          <label style="font-weight: bold;">Remarks</label>
          <div class="auto-input">
            <p name="violation" id="apremarks">Remarks</p>
          </div>
        </div>

        <div class="input-box">
          <label style="font-weight: bold;">Request</label>
          <p id="apappeal">Message Here</p>
        </div>

        <div class="input-box">
          <label><br><b>Evidence</b></label>
          <div class="auto-input">
          <img src="" id="apevidence" alt="Evidence Image" class="imageEvidence">
          </div>
        </div>

        <div class="column">
          <button id="acceptbutton">Accept</button>
          <button id="denybutton">Deny</button>
        </div>
        </form>

      </section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $(document).ready(function () {
    // Get the Accept button
    var acceptButton = $("#acceptbutton");
    var denyButton = $("#denybutton")

    // Add click event listener
    acceptButton.on("click", function () {
      // Get the values from the hidden p elements
      var appealID = $("#apappealid").text();
      var violationID = $("#apviolationid").text();
      closeAppealRequest();
      // Run the SQL deletion
      respondAppeal(appealID);
    });

    // Add click event listener
    denyButton.on("click", function () {
      // Get the values from the hidden p elements
      var appealID = $("#apappealid").text();
      var violationID = $("#apviolationid").text();
      closeAppealRequest();
      // Run the SQL deletion
      respondAppeal(appealID);
    });

    function respondAppeal(appealID) {
      $.ajax({
        type: "POST",
        url: "./php/deleteappeal.php",
        data: { appealID: appealID },
        success: function (response) {
          // Show SweetAlert2 notification based on the response
          if (response.success) {

            id = `ap${appealID}`;
            document.getElementById(id).style.display = "none";

            Swal.fire({
              icon: 'success',
              title: 'Appeal Denied',
              text: `Appeal ${appealID} has been denied`,
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Encountered an error while denying appeal. Please try again later!',
            });
          }
        },
        error: function () {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to communicate with the server',
          });
        },
      });
    }

  // Function to close the container
  function closeAppealRequest() {
    document.querySelector('.containerAppealRequest').style.display = 'none';
  }
});
</script>


