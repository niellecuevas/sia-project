<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/sidebar.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<title>BatStateU</title>
	<link rel="icon" href="img/BSULogo.png" sizes="32x32" type="image/png">
</head>
<body>
    <!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand" style="margin-top:20px;">
		<img src="img/BSULogo.png" id="logo-img"style="width: 30px;">
		<span class="text">BatStateU</span>
		</a>
		<ul class="side-menu top">
			<li class="page2">
				<a href="createviolationreport.php">
					<i class='bx bxs-report'></i>
					<span class="text">Create Violation Report</span>
				</a>
			</li>
			<li class="page4">
				<a href="managereport.php">
					<i class='bx bxs-notepad'></i>
					<span class="text">Manage Report</span>
				</a>
			</li>
			<li>
				<a href="./php/actadminlogout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->
    
	<!-- CONTENT -->
	<section id="content">

        <script src="js/newDashboard.js"></script>
    </body>
</html>