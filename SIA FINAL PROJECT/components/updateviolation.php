    <!--edit violation report-->
    <section class="containerEditVio">
        <div class="edit-vio">
            <h1>Edit Violation Report</h1>
        </div>
        <button class="close-button" onclick="closeEditVio()">&times;</button>
        <form action="#" class="form">
              <div class="input-box">
                <input type="text" placeholder="ViolationId" id="violationID" hidden required />
              </div>

          <div class="column">
              <div class="input-box" hidden>
                <label hidden>SR Code</label>
                <p id="studentsrcode" class="srCode">SR Code</p>
              </div>
          </div>
          <div class="input-box">
            <label style="font-weight: bold;">Name</label>
            <div class="auto-input">
              <p name="studentname" id="studentname">Student Name</p>
            </div>
          </div>
          <div class="column">
          <div class="input-box">
            <label style="font-weight: bold;">Department</label>
            <div class="auto-input">
              <p name="studentdepartment" id="studentdept">Student Department</p>
            </div>
          </div>
          <div class="input-box">
            <label style="font-weight: bold;">Program</label>
            <div class="auto-input">
              <p name="studentprogram" id="studentprogram">Student Program</p>
            </div>
          </div>
          </div>
          <div class="column">
            <div class="input-box">
              <label style="font-weight: bold;">Date</label>
              <input type="date" placeholder="Enter date" id="violationreportdate" required pattern="\d{4}-\d{2}-\d{2}" />
            </div>
            <div class="input-box">
              <label style="font-weight: bold;">Time</label>
              <input type="time" placeholder="Enter time" id="violationtime" required />
            </div>
          </div>
          <?php include "./components/violationdropbox.php"?>
          <div class="input-box">
                <label style="font-weight: bold;">Remarks</label>
                <input type="text" placeholder="Remarks" id="remark" required />
              </div>
          
          <div class="input-box address">
            <label style="font-weight: bold;">Status</label>
              <div class="select-box">
                <select id="violationstatus" name="violationstatus">
                  <option hidden>Status</option>
                  <option value="Ongoing">Ongoing</option>
                  <option value="Done">Done</option>
                </select>
              </div>
            </div>

            <div class="column">
                <div class="input-box" hidden>
                <form action="/upload_image" method="post" enctype="multipart/form-data" hidden>
                <input type="file" name="image" accept="image/*" hidden>
            </div>
            </div>
          </div>
          <button id="confirmchanges">Confirm Changes</button>
        </form>
      </section>