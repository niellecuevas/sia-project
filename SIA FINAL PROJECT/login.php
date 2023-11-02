<!DOCTYPE html>
<html>
<head>
	<!-- Main CSS -->
	<link rel="stylesheet" href="css/loginform.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Page Title -->
	<title>Login Student Management System</title>
</head>
<body>
	<!-- Main Container -->
	<div class="container" id="container">

		<!-- Main Login Form -->
		<div class="form-container log-in-container">
			<form action="./php/actlogin.php" method="POST">
				<img src="img/BSULogo.png" id="BSULogo" alt="logo" class="logo">
                <div class="School">
                <h3 class="red-text"> Welcome Red Spartans!</h3>
                <p> Please login your G-suite account</p>
                </div>
				<input type="text" placeholder="Staff Id or SR Code" name="id"/>
				<input type="password" placeholder="Password" name="password"/>
				<button type="submit" class="button">Log In</button>
			</form>
		</div>

		<!-- Side Panel  -->
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-right">
                    <img src="img/OSDlogin.png" id= "imagebsu" alt="logo">
				</div>
			</div>
		</div>
	</div>
</body>
</html>