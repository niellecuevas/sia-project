
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