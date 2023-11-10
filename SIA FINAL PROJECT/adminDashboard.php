czzzzzz
<?php include "./components/sidebar.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/newDashboard.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<link rel="stylesheet" href="css/app.css">
	<title>Student Conduct Management System Admin Dashboard</title>
	<link rel="icon" href="img/BSULogo.png" sizes="32x32" type="image/png">
</head>
<body>


		<!-- MAIN -->
		<main>
			<ul class="box-info">
				<li>
				<i class="bx"><img src="img/group.png" style=></i>
					<span class="text">
						<h3 class="studentNumber">4289</h3>
						<p>Number of Students</p>
					</span>
				</li>
				<li>
					<i class="bx"><img src="img/minor.png" style=></i>
					<span class="text">
						<h3>2834</h3>
						<p>Minor Violations</p>
					</span>
				</li>
				<li>
				<i class="bx"><img src="img/major.png" style=></i>
					<span class="text">
						<h3>1223</h3>
						<p>Major Violations</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Violation Status</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<canvas id="myChart" style="height: 50vh; width:100%;max-width:600px"></canvas>

						<script>
						var xValues = ["CAS", "CABE", "CICS", "CIT", "CE", "CTE"];
						var yValues = [55, 69, 44, 24, 16 , 32];
						var barColors = ["green", "yellow","brown","red","orange", "blue"];

						new Chart("myChart", {
						type: "bar",
						data: {
							labels: xValues,
							datasets: [{
							backgroundColor: barColors,
							data: yValues
							}]
						},
						options: {
							legend: {display: false},
							title: {
							display: true,
							text: "Violation Status Per Department"
							}
						}
						});
						</script>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Calendar</h3>
						<i class='bx bxs-calendar'></i>
						<i class='bx bx-filter' ></i>
					</div>

					<div class="calendar">
						<div class="calendar-header">
							<span class="month-picker" id="month-picker">February</span>
							<div class="year-picker">
								<span class="year-change" id="prev-year">
									<pre><</pre>
								</span>
								<span id="year">2021</span>
								<span class="year-change" id="next-year">
									<pre>></pre>
								</span>
							</div>
						</div>
						<div class="calendar-body">
							<div class="calendar-week-day">
								<div>Sun</div>
								<div>Mon</div>
								<div>Tue</div>
								<div>Wed</div>
								<div>Thu</div>
								<div>Fri</div>
								<div>Sat</div>
							</div>
							<div class="calendar-days"></div>
						</div>
						<div class="month-list"></div>
					</div>
				
					
					
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="css/newDashboard.js"></script>
	<script src="js/app.js"></script>
</body>
</html>