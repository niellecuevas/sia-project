
<?php include "./components/sidebar.php" ?>
<!DOCTYPE html>
<html>
<head>
	
<link rel="stylesheet" href="css/accountmanager.css">
	<title>Account Manager Student Conduct Management System</title>

</head>
<body>
    <div class="accmanager-container">
      <h3>Account Manager</h3>
      <form class="search-container">
        <input type="text" id="search-bar" placeholder="Search Sr-Code">
        <a href="#"><img class="search-icon" src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png"></a>
      </form>

          <div class="dropdown">
             <select id="sortDropdown">
                 <option value="" disabled selected>Sort By Department</option>
                 <option value="option1">CICS</option>
                 <option value="option2">CIT</option>
                 <option value="option1">CABE</option>
                 <option value="option2">CAS</option>
                 <option value="option2">CE</option>
                 <option value="option1">CTE</option>
             </select>
             <select id="sortDropdown">
                 <option value="" disabled selected>Sort by Name</option>
                 <option value="option1">Ascending (A-Z)</option>
                 <option value="option2">Descending (Z-A)</option>
             </select>
             
             
          </div>

            <!--violation list table-->
            <div class="accmanager-body">
                <div id="violationList">
                    <table>
                        <tr class="accmanager-topic-heading">
                            <th>   </th>
                            <th>Sr-Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>21-123456</td>
                            <td>Sofia Mae Pepito</td>
                            <td>21-123456@g.batstate-u.edu.ph</td>
                            <td class="centered-cell">
                                <button class="btncss" id="openEditForm">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>

    </div>
   
</body>
</html>