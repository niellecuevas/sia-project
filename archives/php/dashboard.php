<?php require "./php/authenticateadmin.php"?>

    <!DOCTYPE html>
        <html>
        <head>
            <link rel="stylesheet" href="css/navigationbar.css">
            <link rel="stylesheet" href="css/dashboard.css">
            <link rel="stylesheet" href="css/responsivedashboard.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <title>Dashboard Student Conduct Management System</title>
            <script src="barchart.js"></script>
        </head>
        <body>
            <!-- Navigation Bar -->
            <div class="overview">
                <h1>Overview</h1>
            </div>

            <div class="area"></div><nav class="main-menu">
            <ul>
                <li>
                    <a href="dashboard.html">
                        <i class="fa fa-bars fa-2x"></i>
                        <span class="nav-text">
                        Dashboard
                        </span>
                    </a>
                
                </li>
                <li class="has-subnav">
                    <a href="generatereport.html">
                        <i class="fa fa-file fa-2x"></i>
                        <span class="nav-text">
                            Generate Report
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="managereport.html">
                    <i class="fa fa-clipboard fa-2x"></i>
                        <span class="nav-text">
                            Manage Report
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="reportoverview.html">
                    <i class="fa fa-eye fa-2x"></i>
                        <span class="nav-text">
                            Report Overview
                        </span>
                    </a>
                
                </li>
                <li>
                    <a href="studentoverview.html">
                        <i class="fa fa-school fa-2x"></i>
                        <span class="nav-text">
                            Student Overview
                        </span>
                    </a>
                </li>
                <li>
                    <a href="accountmanager.html">
                        <i class="fa fa-user fa-2x"></i>
                        <span class="nav-text">
                        Account Manager
                        </span>
                    </a>
                </li>
            </ul>

            <ul class="logout">
                <li>
                <a href="logout.html">
                        <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>  
            </ul>
        </nav>

        <!-- Dashboard -->
        <div class="main">

            <div class="box-container">

                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading">60.5k</h2>
                        <h2 class="topic">Total Number of Students</h2>
                    </div>
                    <i class="fa fa-school fa-2x" style="color:white"></i>

                </div>

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading">150</h2>
                        <h2 class="topic">Minor Violations</h2>
                    </div>
                    <i class="fa fa-exclamation fa-2x" style="color:white"></i>
                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading">320</h2>
                        <h2 class="topic">Major Violations</h2>
                    </div>
                    <i class="fa fa-exclamation fa-2x" style="color:white"></i>

                </div>

                <div class="box box4">
                    <div class="text">
                        <h2 class="topic-heading">70</h2>
                        <h2 class="topic">Total Number of Violations</h2>
                    </div>
                    <i class="fa fa-user fa-2x" style="color:white"></i>
                </div>
            </div>

            <!-- Bar -->
            <div class="titlebar">
                <h1>Violations per Department</h1>
            </div>
        <div class="simple-bar-chart">
        
        <div class="item" style="--clr: #5EB344; --val: 80">
            <div class="label">CAS</div>
            <div class="value">80%</div>
        </div>
        
        <div class="item" style="--clr: #FCB72A; --val: 50">
            <div class="label">CABE</div>
            <div class="value">50%</div>
        </div>
        
        <div class="item" style="--clr: #964B00; --val: 100">
            <div class="label">CICS</div>
            <div class="value">100%</div>
        </div>
        
        <div class="item" style="--clr: #E0393E; --val: 15">
            <div class="label">CIT</div>
            <div class="value">15%</div>
        </div>
        
        <div class="item" style="--clr: #db7807; --val: 10">
            <div class="label">CE</div>
            <div class="value">1%</div>
        </div>
        
        <div class="item" style="--clr: #069CDB; --val: 90">
            <div class="label">CTE</div>
            <div class="value">90%</div>
        </div>
        </div>

        
                <!-- Table Student Records -->
        <div class="report-container">
            <div class="report-header">
                <h1 class="StudentRecord">Student Records</h1>
                <button class="view">View All</button>
            </div>

            <div class="report-body">
                <div class="report-topic-heading">
                    <h3 class="t-op">Student Name</h3>
                    <h3 class="t-op">Violation</h3>
                    <button class="callslip">Call Slip</button>
                </div>

                <div class="items">
                    <div class="item1">
                        <h3 class="t-op-nextlvl">Kyle Ilao</h3>
                        <h3 class="violationrec">Haircut</h3>
                        <button class="callslip">Call Slip</button>
                    </div>

                    <div class="item1">
                        <h3 class="t-op-nextlvl">Raniella Cuevas</h3>
                        <h3 class="t-op-nextlvl">No Uniform</h3>
                        <button class="callslip">Call Slip</button>
                    </div>

                    <div class="item1">
                        <h3 class="t-op-nextlvl">Cyrus Tapalla</h3>
                        <h3 class="t-op-nextlvl">Cutting Classes</h3>
                        <button class="callslip">Call Slip</button>
                    </div>

                    <div class="item1">
                        <h3 class="t-op-nextlvl">Ashera Aguilar</h3>
                        <h3 class="t-op-nextlvl">Hair Color</h3>
                        <button class="callslip">Call Slip</button>
                    </div>

                    <div class="item1">
                        <h3 class="t-op-nextlvl">Sofia Pepito</h3>
                        <h3 class="t-op-nextlvl">Unproper Clothing</h3>
                        <button class="callslip">Call Slip</button>
                    </div>
                </div>
            </div>
        </div>
        </body>
    </html>