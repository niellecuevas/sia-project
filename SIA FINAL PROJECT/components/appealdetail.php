
      <!--appeal request-->
      <section class="containerAppealRequest">
        <div class="review-appeal">
            <h1>Appeal Request</h1>
        </div>
        <button class="close-button" onclick="closeAppealRequest()">&times;</button>
        <form action="#" class="form">

        <div class="input-box">
          <label>SR Code</label>
          <input type="text" placeholder="Enter SR Code" id="apsrcode" required />
        </div>

        <div class="input-box">
          <label>Name</label>
          <div class="auto-input">
            <p name="studentName" id="apstudentname">Student Name</p>
          </div>
        </div>

        <div class="column">
        <div class="input-box">
          <label>Department</label>
          <div class="auto-input">
            <p name="studentDept" id="apstudentdepartment">Student Department</p>
          </div>
        </div>
        <div class="input-box">
          <label>Program</label>
          <div class="auto-input">
            <p name="studentProgram" id="apstudentprogram">Student Program</p>
          </div>
        </div>
        </div>

        <div class="input-box">
          <label>Date</label>
          <input type="date" id="apappealdate" class="appealdate" placeholder="Enter date" required />
        </div>

        <div class="review-appeal">
          <h1><br>Violation Details</h1>
        </div>

        <div class="column">
          <div class="input-box">
            <label>Violation</label>
            <div class="auto-input">
              <p name="violationDetail" id="apviolationname">Violation</p>
            </div>
          </div>
          <div class="input-box">
            <label>Date</label>
            <div class="auto-input">
              <p name="violationDate" id="apviolationdate">MM/DD/YYYY</p>
            </div>
          </div>
          <div class="input-box">
            <label>Time</label>
            <div class="auto-input">
              <p name="violationTime" id="apviolationtime">0:00</p>
            </div>
          </div>
        </div>

        <div class="input-box">
          <label>Handler</label>
          <div class="auto-input">
            <p name="violationHandlerName" id="apstaffname">Handler Name</p>
          </div>
        </div>

        <div class="input-box">
          <label>Remarks</label>
          <div class="auto-input">
            <p name="violation" id="apremarks">Remarks</p>
          </div>
        </div>

        <div class="input-box">
          <label>Request</label>
          <textarea style="width:100%; height:100px; resize:none;" placeholder="Message here" id="apappeal" required ></textarea>
        </div>

        <div class="column">
          <button>Accept</button>
          <button>Deny</button>
        </div>
        </form>

      </section>