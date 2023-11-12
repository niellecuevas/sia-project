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
        <link rel="stylesheet" href="./css/managereport.css">
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
                        <span class="text-label" style="font-weight: bold;">Name:</span>
                        <span  class="text-info" id="name"><?php  echo $_SESSION['FullName']; ?> </span><br><br><br>

                        <div class = "studentInfo-text">
                        <span class="text-label"style="font-weight: bold;">Sr-Code:</span>
                        <span  class="text-info" id="srcode"><?php  echo $_SESSION['SRCode']; ?></span><br><br><br>
                        </div>
                    </div>

                    <div class = "studentInfo-text2">
                    <div class = "studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">Course:</span>
                    <span class="text-info" id="course"> <?php  echo $_SESSION['CourseName']; ?></span><br><br><br>
                    </div>

                    <div class = "studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">Department:</span>
                    <span class="text-info" id="department"> <?php  echo $_SESSION['Department']; ?></span><br><br><br>
                    </div>
                </div>

<?php include "./php/studviolationtypecounter.php"?>                
    </div>
            <div class="offense-container" id="minorOffense">
                    <div class="offense">Minor Offense <p class="num" id="minorViolationCount"><?php  echo $minorViolations; ?></p></div>
            </div>

            <div class="offense-container" id="majorOffense">
                    <div class="offense">Major Offense <p class="num" id="majorViolationCount"><?php  echo $majorViolations; ?></p></div>
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

<?php include "./php/studentviolationcarousel.php"; ?>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <?php
        if (isset($studentViolations) && !empty($studentViolations)) {
            foreach ($studentViolations as $violation) {
        ?>
                <div class="swiper-slide">
                    <form>
                        <div class="violationInfo">
                        
                            <label for="violation" class="lbl">Violation:</label>
                            <input type="text" class="conductInfo" id="violation" name="violation" value="<?php echo $violation['ViolationName']; ?>" readonly style="color: black;">
                            <button type="button" class="btncss" id="appealbtn">Appeal</button><br><br>
                            <label for="violationType" class="lbl">Type:</label>
                            <input type="text" class="conductInfo" id="violationType" name="violationType" value="<?php echo $violation['ViolationLevel']; ?>" readonly style="color: black;"><br><br>
                            <label for="date" class="lbl">Date:</label>
                            <input type="text" class="conductInfo" id="date" name="date" value="<?php echo $violation['ViolationDate']; ?>" readonly style="color: black;"><br><br>
                            <label for="time" class="lbl" id="time">Time:</label>
                            <input type="text" class="conductInfo" id="time" name="time" value="<?php echo $violation['ViolationTime']; ?>" readonly style="color: black;"><br><br>
                            <label for="remarks" class="lbl" id="remarks">Remarks:</label>
                            <input type="text" class="conductInfo" id="remarks" name="remarks" value="<?php echo $violation['Remarks']; ?>" readonly style="color: black;"><br><br>
                            
                            <!-- Evidence Label -->
                            <label for="attachment" class="lbl" id="attachment">Evidence:</label>
                            
                            <!-- Display evidence image -->
                            <?php if (!empty($violation['Evidence'])): ?>
                                <img src="<?php echo './img/violationEvidence/' . $violation['Evidence']; ?>" alt="Evidence Image" class="conductInfo" style="width: 80px; height: 100px;">
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
        <?php
            }
        } else {
            // Display a message if no violations are found
            echo '<p>No violation data available.</p>';
        }
        ?>
    </div>
    <div class="swiper-button-next" style="color:#a50113;"></div>
    <div class="swiper-button-prev" style="color:#a50113;"></div>
    <div class="swiper-pagination"></div>
</div>

  <!--Popup Container-->

  <section class="containerAppealMessage">
        <div class="appeal-msg">
            <h1>Appeal Request</h1>
        </div>
        <button class="close-button" onclick="closeAppeal()">&times;</button>
        <form action="#" class="form">
        <div class="input-box">
            <label>Date</label>
            <input type="date" id="generateId" placeholder="Enter date" required />
          </div>
          <div class="input-box">
              <label>Request</label>
              <textarea style="width:100%; height:100px; resize:none;" placeholder="Message here" required ></textarea>
            </div>
            <button>Confirm</button>
        </form>
      </section>

</div>
  <!---------------FOOTER STARTS--------------------->
<footer>
  <div class="footer-bottom">
      <p>copyright &copy;2023 Batangas State University. designed by <span>Group 3</span></p>
  </div>
</footer>

        <!--End-->
     
        <script src="./js/studHomepage.js"></script>
        
        <!--Popup Script-->
        <script>
          document.getElementById("appealbtn").addEventListener("click", function() {
            document.querySelector(".containerAppealMessage").style.display = "block";
        });
         function closeAppeal() {
            document.querySelector(".containerAppealMessage").style.display = "none";
        }
        </script>

    </body>
</html>