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
      <!-- <button class="tab-button" id="call-slip-req" onclick="switchTable('callslipReqList', 'call-slip-req')">Call Slip Required List</button> -->
      <button class="tab-button" id="appeal-req" onclick="switchTable('appealRequestList', 'appeal-req')">Appeal Request List</button>
      <?php include './components/adminsort.php'?>
      <!--violation list table-->
      <div class="mngreport-body">
        <?php include "./components/violationlist.php"?>
        <?php include "./components/appeallist.php"?>

        <!--call slivp required table-->
        <!-- <div id="callslipReqList">
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
                <button class="btncss" id="openCallSlipForm">Call Slip</button>
              </td>
            </tr>
          </table>
          </div> -->
                <!--appeal request table-->
      </div>
    </section>
    <?php include "./components/updateviolation.php"?>
    <?php include "./components/generatecallslip.php"?>
    <?php include "./components/appealdetail.php"?>
    <script src="js/managereport.js"></script>
    <script src="js/reportdates.js"></script>
    <script src="js/switchtable.js"></script>
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
        

         function closeAppealRequest() {
            document.querySelector(".containerAppealRequest").style.display = "none";
        }
    </script>
</body>
</html>