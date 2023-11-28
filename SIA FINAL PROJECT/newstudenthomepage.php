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
          <a href="./php/actlogout.php" style="filter: invert(1); margin:auto;" ><i class="fa-solid fa-arrow-right-from-bracket"><span class="tooltiptext">Logout</span></i></a>
          </div>
        </div>
      </header>

     <!---------------body content here----------------->
      <div class="whole-container">
                <h1>STUDENT INFORMATION</h1>
            <!------------- STUDENT INFORMATON STARTS ------------------> 
                <div class="banner">
                    <div class = "studentInfo-text1">
                        <span class="text-label" style="font-weight: bold;">Name: </span>
                        <span  class="text-info" id="name"><?php  echo $_SESSION['FullName']; ?> </span><br>

                        <div class = "studentInfo-text">
                        <span class="text-label"style="font-weight: bold;">Student ID: </span>
                        <span  class="text-info" id="srcode"><?php  echo $_SESSION['SRCode']; ?></span><br>
                        </div>

                    <div class = "studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">Course: </span>
                    <span class="text-info" id="course"> <?php  echo $_SESSION['CourseName']; ?></span><br>
                    </div>

                    <div class = "studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">Department: </span>
                    <span class="text-info" id="department"> <?php  echo $_SESSION['Department']; ?></span><br>
                    </div>
                </div>

<?php include "./php/studviolationtypecounter.php"?>                
    </div>
             <div class="offense-container">
                    <div class="offense"id="majorOffense" >Major Offense <p class="num" id="majorViolationCount"><?php  echo $majorViolations; ?></p></div>
            </div>
            <div class="offense-container">
                    <div class="offense"  id="minorOffense">Minor Offense <p class="num" id="minorViolationCount"><?php  echo $minorViolations; ?></p></div>
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
                <div class="swiper-slide" style="display: grid;
                grid-template-rows: auto; box-sizing: content-box; 
                padding-top: 120px; min-height: 110%;" data-vio-id="<?php echo $violation['ViolationID']; ?>">
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
                            <label for="remarks" class="lbl" id="remarks">Status:</label>
                            <input type="text" class="conductInfo" id="remarks" name="status" value="<?php echo $violation['Status']; ?>" readonly style="color: black;"><br><br>
                            
                            <!-- Evidence Label -->
                            
                            <label for="attachment" class="lbl" id="attachment">Evidence:</label><br>
                            
                            <!-- Display evidence image -->
                            <?php if (!empty($violation['Evidence'])): ?>
                                <img src="<?php echo './img/violationEvidence/' . $violation['Evidence']; ?>" alt="Evidence Image" class="imageEvidence">
                            <?php endif; ?>
                            <button type="button" class="btncss" id="appealbtn-bottom">Appeal</button><br><br>
                        </div>
                    </form>
                </div>
        <?php
            }
        } else {
            // Display a message if no violations are found
            echo '<div style="position: absolute; left: 50%; transform: translateX(-50%); 
            top:40%; text-align: center; align-content: center; z-index: 5;">
            <p style="font-size: 20px;">No violation data available.</p>
            </div>
            <div style="position: absolute; top: 5%; left: 50%; transform: translateX(-50%); z-index: 1; align-content: center;">
            <img src="img/BSULogoBW.png" style="height: 500px; width: 500px; opacity: 0.10;">
            </div>';
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
    <form action="./php/studcreateappeal.php" method="POST" class="form" id="appealForm">
    <!-- Add a hidden input for the violation ID -->
    <input type="hidden" name="violationId" id="violationId" value="">
    
    <div class="input-box">
        <label for="date">Date</label>
        <input type="date" id="generateId" name="date" placeholder="Enter date" required />
    </div>
    <div class="input-box">
        <label for="request">Request</label>
        <textarea name="request" style="width:100%; height:100px; resize:none;" placeholder="Message here" required></textarea>
    </div>
    <button type="button" onclick="submitAppealForm()">Confirm</button>


    <script>
    function submitAppealForm() {
        // Get the currently active slide
        var activeSlide = document.querySelector('.swiper-slide-active');

        // Get the violation ID from the active slide
        var violationId = activeSlide.getAttribute('data-vio-id');

        // Set the violation ID in the hidden input
        document.querySelector('#violationId').value = violationId;

        // Submit the form
        document.querySelector('#appealForm').submit();
    }
</script>

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
          document.querySelectorAll(".btncss").forEach(function(button) {
          button.addEventListener("click", function() {
              document.querySelector(".containerAppealMessage").style.display = "block";
              });
          });
         function closeAppeal() {
            document.querySelector(".containerAppealMessage").style.display = "none";
        }
        </script>

    </body>
</html>