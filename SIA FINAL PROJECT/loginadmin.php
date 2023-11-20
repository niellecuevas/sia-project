<!DOCTYPE html>
<html>
<head>
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/loginform.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./img/BSULogo.png" sizes="32x32" type="image/png">
    <!-- Page Title -->
    <title>Login Student Management System</title>
</head>
<body>
    <!-- Main Container -->
    <div class="container" id="container">

        <!-- Main Login Form -->
        <div class="form-container log-in-container">
            
            <form action="./php/actadminlogin.php" method="POST" id="loginForm">
                
                <img src="img/BSULogo.png" id="BSULogo" alt="logo" class="logo">
                <div class="School">
                    <h3 class="red-text"> Welcome Red Spartans!</h3>
                    <p> Please login to your G-suite account</p>
                </div>

                <!-- Error Message -->
                <?php if(isset($_GET['error'])) {?>
                    <span><?php echo $_GET['error']; ?></span>
                <?php } ?>


                <!-- Form TextBoxes -->
                <input type="text" placeholder="Username" name="id" id="idInput" required/>
                <input type="password" placeholder="Password" name="password" required/>


                <!-- Submit Button -->
                <button type="submit" class="button">Log In</button>
            </form>
        </div>

        <!-- Side Panel -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img src="img/adminlogin.png" id="imagebsu" alt="logo">
                </div>
            </div>
        </div>
    </div>
	<script src="./js/login.js"></script>
</body>
</html>
