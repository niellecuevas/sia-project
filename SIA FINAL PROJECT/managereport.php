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
      <button class="tab-button" id="appeal-req" onclick="switchTable('appealRequestList', 'appeal-req')">Appeal Request List</button>
      
      <!-- Sorting Dropbox -->
      <?php include './components/adminsort.php'?>
      
      <!--Tables-->
      <div class="mngreport-body">
        <?php include "./components/violationlist.php"?>
        <?php include "./components/appeallist.php"?>
      </div>
    </section>
    <?php include "./components/updateviolation.php"?>
    <?php include "./components/appealdetail.php"?>
    <script src="js/managereport.js"></script>
    <script src="js/reportdates.js"></script>
    <script src="js/switchtable.js"></script>
    <script src="js/openandcloseadminforms.js"></script>
</body>
</html>