<?php require "./php/authenticatestudent.php"?>

<!DOCTYPE html>
<html>
    <head lang="en" dir="ltr">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>BSU_TNEU-Student Conduct Information</title>
        <link rel="icon" href="./img/BSULogo.png" sizes="32x32" type="image/png">
        <!--studhome.css -->
        <link rel="stylesheet" href="./css/studhome.css">
        <link rel="stylesheet" href="../css/studhome.css">
        <!--generate report.css -->
        <link rel="stylesheet" href="../css/generatereport.css">
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
          <a href="callSlip" id="callslip" class="action-btn" >Call Slip</a>
          <a href="./php/actlogout.php" class="action-btn">Logout</a>
          </div>
          <div class="toggle-btn">
            <i class="fa-solid fa-bars"></i>
          </div>
        </div>
        
        <div class="dropdown_menu">
          <li><a href="callSlip" id="callslip" class="action-btn" >Call Slip</a></li>
         <li><a href="./php/actlogout.php" class="action-btn">Logout</a></li>
        </div>
      </header>
      <!---------------TOP NAVIGATION END----------------->

      <!------------- STUDENT INFORMATON STARTS ------------------> 
        <div class="banner">
          <div class="overview">
            <h1>Student Information</h1>
          </div>
          <div class="studInfo" >
          <div class="nameNsrcode">
          <form>
          <label for="name">Name:</label>
          <input type="text" class="info" id="name" name="name" value="<?php echo $_SESSION['FullName']; ?>"><br><br>
          <label for="srcode" id="adjustSrcode">Sr-Code:</label>
          <input type="text" class="info" id="srcode" name="srcode" value="<?php echo $_SESSION['SRCode']; ?>"><br><br>
      </form>
      </div>
          <div class="courseNdept">
      <form>
        <label for="course">Course:</label>
        <input type="text" class="info" id="course" name="course" value="<?php echo $_SESSION['CourseName']; ?>"><br><br>
        <label for="department" id="adjustDept">Department:</label>
        <input type="text" class="info" id="department" name="department" value="<?php echo $_SESSION['Department']; ?>"><br><br>
      </form>
          </div>
        </div>
        </div>
       </div>
      <!------------- STUDENT INFORMATION END ------------------> 
                    
      <!------------- ANNOUNCEMENT BANNER SLIDESHOW ------------------>    
      <div class="slideshow-container">

        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="./img/studHomeImg/announcementBanner1.png" style="width:100%">
          
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="./img/studHomeImg/announcementBanner2.png" style="width:100%">
          
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="./img/studHomeImg/announcementBanner3.png" style="width:100%">
          
        </div>
        
        </div>
        <br>
        
        <div style="text-align:center" >
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div>

        <!--End-->
        <!----------- STUDENT CONDUCT INFORMATION START----------------->
  <div class="openingText">
        <h1 id="titleVio" data-aos="fade-up">STUDENT CONDUCT INFORMATION</h1>
        <h3 id="secondTitle" data-aos="fade-up">Student conduct information is use for data and documentation related to the behavior, actions, and disciplinary matters of the students within Batangas State University Lipa Campus. <br>
        It encompasses a wide range of information that helps institutions monitor and manage student behavior, enforce disciplinary policies, and maintain a safe and conducive learning environment.</h3>
  </div>

<section>
<div class="offenses-container" data-aos="fade-right">
    <div class="offense-container">
        <div class="offense">Minor Offense <p class="num"><?= $_SESSION['MinorOffenses'] ?></p></div>
    </div>

    <div class="offense-container" id="majorOffense">
        <div class="offense">Major Offense <p class="num"><?= $_SESSION['MajorOffenses'] ?></p></div>
    </div>
</div>

  <div class="swiper mySwiper"  data-aos="fade-left">
    <div class="swiper-wrapper" >
    <div class="swiper-slide">
    <form>
      <div class="violationInfo">
          <label for="violation" class="lbl">Violation:</label>
          <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Cross Dressing" readonly><br><br>
          <label for="action" id="adjustSrcode" class="lbl">Action:</label>
          <input type="text" class="conductInfo" id="action" name="action" placeholder="3 days Suspension" readonly><br><br>
          <label for="date" class="lbl">Date:</label>
          <input type="text" class="conductInfo" id="date" name="date" placeholder="10-20-2023" readonly><br><br>
          <label for="time" class="lbl" id="time">Time:</label>
          <input type="text" class="conductInfo" id="time" name="time" placeholder="02:30 PM" readonly><br><br>
          <label for="remarks" class="lbl" id="remarks">Remarks:</label>
          <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Remarks here"><br><br>
          <label for="attachment" class="lbl" id="attachment">Attachment:</label>
        <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
        </div>
    </form>
    </div>

    <div class="swiper-slide">
      <form>
        <div class="violationInfo">
          <label for="violation" class="lbl">Violation:</label>
          <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Cutting Class" readonly><br><br>
          <label for="action" id="adjustSrcode" class="lbl">Action:</label>
          <input type="text" class="conductInfo" id="action" name="action" placeholder="1 day suspension"readonly><br><br>
          <label for="date" class="lbl">Date:</label>
          <input type="text" class="conductInfo" id="date" name="date" placeholder="11-29-2023"readonly><br><br>
          <label for="time" class="lbl" id="time">Time:</label>
          <input type="text" class="conductInfo" id="time" name="time" placeholder="11:00 PM"readonly><br><br>
          <label for="remarks" class="lbl" id="remarks">Remarks:</label>
          <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Okay sige"readonly><br><br>
          <label for="attachment" class="lbl" id="attachment">Attachment:</label>
        <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
          </div>
      </form>
      </div>

      <div class="swiper-slide">
        <form>
          <div class="violationInfo">
            <label for="violation" class="lbl">Violation:</label>
            <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Hair Cut" readonly><br><br>
            <label for="action" id="adjustSrcode" class="lbl">Action:</label>
            <input type="text" class="conductInfo" id="action" name="action" placeholder="5 days Suspension" readonly><br><br>
            <label for="date" class="lbl">Date:</label>
            <input type="text" class="conductInfo" id="date" name="date" placeholder="05-09-2023" readonly><br><br>
            <label for="time" class="lbl" id="time">Time:</label>
            <input type="text" class="conductInfo" id="time" name="time" placeholder="8:00 PM" readonly><br><br>
            <label for="remarks" class="lbl" id="remarks">Remarks:</label>
            <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Kaya mo yan" readonly><br><br>
            <label for="attachment" class="lbl" id="attachment">Attachment:</label>
          <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
            </div>
          </form>
        </div>

        <div class="swiper-slide">
          <form>
            <div class="violationInfo">
              <label for="violation" class="lbl">Violation:</label>
              <input type="text" class="conductInfo" id="violation" name="violation" placeholder="Piercings/Tattoos" readonly><br><br>
              <label for="action" id="adjustSrcode" class="lbl">Action:</label>
              <input type="text" class="conductInfo" id="action" name="action" placeholder="1 day suspension" readonly><br><br>
              <label for="date" class="lbl">Date:</label>
              <input type="text" class="conductInfo" id="date" name="date" placeholder="12-25-2023" readonly><br><br>
              <label for="time" class="lbl" id="time">Time:</label>
              <input type="text" class="conductInfo" id="time" name="time" placeholder="09:23 AM" readonly><br><br>
              <label for="remarks" class="lbl" id="remarks">Remarks:</label>
              <input type="text" class="conductInfo" id="remarks" name="remarks" placeholder="Ayaw ko na" readonly><br><br>
              <label for="attachment" class="lbl" id="attachment">Attachment:</label>
            <input type="image" src="./img/studHomeImg/violation.jpg" class="conductInfo" alt="violationImage" width="80" height="100">
              </div>
            </form>
          </div>
  </div>
  <div class="swiper-button-next" style="color:#a50113;"></div>
  <div class="swiper-button-prev" style="color:#a50113;"></div>
  <div class="swiper-pagination" ></div>
  </div>
</section>

<!-----------VIOLATION INFORMATION END----------------->

<!---------------FOOTER STARTS--------------------->
<footer>
  <div class="footer-content">
      <h3><b>Contact Us</b></h3>
      <p>If you have other question, you can contact us to the following websites<br>
        <b>Email :</b> osd.lipa@g.batstate-u.edu.ph<br>
        <b>Facebook : </b> OSD BatStateULipa<br>
        <b>Address : </b> A. Tanco Drive, Marawoy, Lipa, Batangas</p>
      <ul class="socials">
          <li><a href="https://www.facebook.com/BatStateUTheNEU" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
          <li><a href="https://twitter.com/BatStateUTheNEU" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
          <li><a href="https://batstate-u.edu.ph" target="_blank"><i class="fa-brands fa-square-google-plus"></i></a></li>
          <li><a href="https://www.youtube.com/@BatStateUTheNEU" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
          <li><a href="https://www.linkedin.com/school/batstateutheneu/" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
      </ul>
  </div>
  <div class="footer-bottom">
      <p>copyright &copy;2023 Batangas State University. designed by <span>Group 3</span></p>
  </div>
</footer>

<!-----------------FOOTER ENDS--------------------->
<script src="./js/studHomepage.js"></script>


              
    </body>
</html>


