<!DOCTYPE html>
<html>
    <head lang="en" dir="ltr">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>BSU_TNEU-Student Conduct Information</title>
        <link rel="icon" href="./img/BSULogo.png" sizes="32x32" type="image/png">
        <!--studhome.css -->
        <link rel="stylesheet" href="./css/studhome.css">
        <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <!-- font-awesome -->
        <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </head>
    <body>
      <!---------------TOP NAVIGATION STARTS----------------->
      <header id="myHeader">
        <div class="navbar">
          <div class="logo"><a href=""><img src="./img/BSULogo.png">Batangas State University The NEU</a></div>
          <div class="nav-btns">
          <a href="./php/actlogout.php" class="action-btn">Logout</a>
          </div>
          <div class="toggle-btn">
            <i class="fa-solid fa-bars"></i>
          </div>
        </div>
      </header>

     <!---------------body content here----------------->
      <div class="whole-container">
                <h1>STUDENT INFORMATION</h1>
            <!------------- STUDENT INFORMATON STARTS ------------------> 
                <div class="banner">
                    <div class = "studentInfo-text1">
                        <span class="text-label">Name:</span>
                        <p  class="text-info" id="name"><?php // echo $_SESSION['FullName']; ?> </p><br>

                        <div class = "studentInfo-text">
                        <span class="text-label">Sr-Code:</span>
                        <p  class="text-info" id="srcode"><?php // echo $_SESSION['SRCode']; ?></p><br>
                        </div>
                    </div>

                    <div class = "studentInfo-text2">
                    <div class = "studentInfo-text">
                    <span class="text-label" >Course:</span>
                    <p class="text-info" id="course"> <?php // echo $_SESSION['CourseName']; ?></p><br>
                    </div>

                    <div class = "studentInfo-text">
                    <span class="text-label">Department:</span>
                    <p class="text-info" id="department"> <?php // echo $_SESSION['Department']; ?></p><br>
                    </div>
                </div>
  
    </div>
            <div class="offense-container">
                    <div class="offense">Minor Offense <p class="num" id="minorViolationCount"><?php // echo $minorViolations; ?></p></div>
            </div>

            <div class="offense-container" id="majorOffense">
                    <div class="offense">Major Offense <p class="num" id="majorViolationCount"><?php // echo $majorViolations; ?></p></div>
            </div>
            <br>

   <!------------- ANNOUNCEMENT BANNER CAROUSEL ------------------>   
      <div class="slideshow-container">

            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner1.png" style="width:100%">
            </div>
            
            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner2.png" style="width:100%">
            </div>
            
            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner3.png" style="width:100%">
            </div>

            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner4.png" style="width:100%">
            </div>

            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner5.png" style="width:100%">
            </div>

            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner6.png" style="width:100%">
            </div>

            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner7.png" style="width:100%">
            </div>

            <div class="mySlides fade">
            <img src="./img/studHomeImg/announcementBanner8.png" style="width:100%">
            </div>

            <div style="text-align: center" >
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span>   
            </div>
        
        </div>
        <br>

         <!--Violation Information Start-->

        <div class="swiper mySwiper">
    <div class="swiper-wrapper" >
    <div class="swiper-slide">
    <form>
      <div class="violationInfo">
          <label for="violation" class="lbl">Violation:</label>
          <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Cross Dressing" readonly><br><br>
          <label for="violationType" class="lbl">Type:</label>
          <input type="text" class="conductInfo" id="violationType" name="violationType" placeholder="Minor Offense" readonly><br><br>
          <label for="date" class="lbl">Date:</label>
          <input type="text" class="conductInfo" id="date" name="date" placeholder="10-20-2023" readonly><br><br>
          <label for="time" class="lbl" id="time">Time:</label>
          <input type="text" class="conductInfo" id="time" name="time" placeholder="02:30 PM" readonly><br><br>
          <label for="remarks" class="lbl" id="remarks">Remarks:</label>
          <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Okay sige"readonly><br><br>
          <label for="attachment" class="lbl" id="attachment">Evidence:</label>
        <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
        </div>
    </form>
    </div>

    <div class="swiper-slide">
      <form>
        <div class="violationInfo">
          <label for="violation" class="lbl">Violation:</label>
          <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Cutting Class" readonly><br><br>
          <label for="violationType" class="lbl">Type:</label>
          <input type="text" class="conductInfo" id="violationType" name="violationType" placeholder="Minor Offense" readonly><br><br>
          <label for="date" class="lbl">Date:</label>
          <input type="text" class="conductInfo" id="date" name="date" placeholder="11-29-2023"readonly><br><br>
          <label for="time" class="lbl" id="time">Time:</label>
          <input type="text" class="conductInfo" id="time" name="time" placeholder="11:00 PM"readonly><br><br>
          <label for="remarks" class="lbl" id="remarks">Remarks:</label>
          <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Okay sige"readonly><br><br>
          <label for="attachment" class="lbl" id="attachment">Evidence:</label>
        <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
          </div>
      </form>
      </div>

      <div class="swiper-slide">
        <form>
          <div class="violationInfo">
            <label for="violation" class="lbl">Violation:</label>
            <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Hair Cut" readonly><br><br>
            <label for="violationType" class="lbl">Type:</label>
          <input type="text" class="conductInfo" id="violationType" name="violationType" placeholder="Minor Offense" readonly><br><br>
            <label for="date" class="lbl">Date:</label>
            <input type="text" class="conductInfo" id="date" name="date" placeholder="05-09-2023" readonly><br><br>
            <label for="time" class="lbl" id="time">Time:</label>
            <input type="text" class="conductInfo" id="time" name="time" placeholder="8:00 PM" readonly><br><br>
            <label for="remarks" class="lbl" id="remarks">Remarks:</label>
            <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Kaya mo yan" readonly><br><br>
            <label for="attachment" class="lbl" id="attachment">Evidence:</label>
          <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
            </div>
          </form>
        </div>

        <div class="swiper-slide">
          <form>
            <div class="violationInfo">
              <label for="violation" class="lbl">Violation:</label>
              <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Piercings/Tattoos" readonly><br><br>
              <label for="violationType" class="lbl">Type:</label>
              <input type="text" class="conductInfo" id="violationType" name="violationType" placeholder="Minor Offense" readonly><br><br>
              <label for="date" class="lbl">Date:</label>
              <input type="text" class="conductInfo" id="date" name="date" placeholder="12-25-2023" readonly><br><br>
              <label for="time" class="lbl" id="time">Time:</label>
              <input type="text" class="conductInfo" id="time" name="time" placeholder="09:23 AM" readonly><br><br>
              <label for="remarks" class="lbl" id="remarks">Remarks:</label>
              <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Ayaw ko na" readonly><br><br>
              <label for="attachment" class="lbl" id="attachment">Evidence:</label>
            <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
              </div>
            </form>
          </div>
  </div>
  <div class="swiper-button-next" style="color:#a50113;"></div>
  <div class="swiper-button-prev" style="color:#a50113;"></div>
  <div class="swiper-pagination" ></div>
  </div>
</div>
  <!---------------FOOTER STARTS--------------------->
<footer>
  <div class="footer-bottom">
      <p>copyright &copy;2023 Batangas State University. designed by <span>Group 3</span></p>
  </div>
</footer>

        <!--End-->
     
        <script src="./js/studHomepage.js"></script>

    </body>
</html>