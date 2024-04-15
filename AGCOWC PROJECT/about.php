<?php
session_start();
include('conn.php');
if(!ISSET($_SESSION['user'])){
    header('location:index.php');
    die();  
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
    <!-- Add Bootstrap CSS -->
    <link rel="icon" href="pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
       
    
    .chart-container {
            text-align: center;
        }
    .chart-box 
    {
        border: 1px solid #ddd;
        padding: 20px;
        margin: 10px;
        border-radius: 8px;
        position: relative;
        z-index: 1;
    }
    .person-image {
            max-width: 100px;
            max-height: 50%;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-lg-top">
<div class="container">
	<a class="navbar-brand" href="index.html"><Span class="text-warning"><img src="./pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </Span>CHURCH</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
		data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="home.php">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="about.php">About</a>
			</li>
			<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="profile.php">View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="feedback.php">User Feedback</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="bible.php">Bible</a>
            </li>
			<li class="nav-item" id="applog">
				<a class="nav-link active" aria-current="page" @click="confirmLogout" style="cursor:pointer">Log-out</a>
			</li>
		</ul>

	</div>
</div>
</nav>
<!-- ABOUT -->
<header class="bg-warning text-white text-center py-4">
        <h1 class="display-6">About</h1>
    </header>
    <div class="container mt-4">
        <section>
            <h2 class="text-center">Our Story</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit expedita enim consequuntur quisquam aut sint nobis a vel quasi dolores quam fuga commodi, earum neque nesciunt hic libero! Quos, incidunt.</p>
        </section>
    </div>
    <section style="background-image: linear-gradient(to right, #74D680,#378B29)" >
    <br>
    <h2 class="text-center">ORGANIZATIONAL CHART</h2>
    <div class="container">
        <div class="row chart-container">
            <!-- Top Person -->
            <div class="col-md-4 col-sm-2"></div>
                <div class="col-md-4 chart-box bg-white">
                    <img src="org/Bishop Lito.jpg" alt="Top Person" class="person-image">
                    <h4>Pastor Marcelito Cuyos</h4>
                    <p>Head Pastor/Officiating Minister/Bishop</p>
                </div>
            <div class="col-md-4"></div>
        </div>

            <!-- Subordinates -->
        <div class="row">
            <div class="col-md-1"></div>
        <div class="col-md-3 chart-box bg-white " style="text-align: center;">
            <img src="org/Patsor Jireh.jpg" alt="Subordinate 1" class="person-image">
            <h4>Pastor Jireh</h4>
            <p>Pastor/Music Director/Youth Pastor</p>
        </div>
        <div class="col-md-3 chart-box bg-white" style="text-align: center;">
            <img src="org/Pastor Jimmy.jpg" alt="Subordinate 2" class="person-image">
            <h4>Pastor Jimmy</h4>
            <p>Pastor/Assitant Pastor</p>
        </div>

        <div class="col-md-3 chart-box bg-white" style="text-align: center;">
            <img src="org/Pastor William.jpg" alt="Subordinate 2" class="person-image">
            <h4>Pastor William</h4>
            <p>Pastor/Assitant Pastor</p>
        </div>
    </div>

    </section>
    <section class="bg-light py-4">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <p class="text-center">If you have any questions or would like to get in touch, feel free to contact us:</p>
            <address class="text-center">
                Email: <a href="mailto:info@example.com">agcow1987@example.com</a><br>
                Phone: +63 943 6459302<br>
                Address: Purok Shooting Star Babag II Lapu-Lapu City, Cebu.
            </address>
        </div>
    </section>
    
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 1988 ALMIGHTY GOD CENTER OF WORSHIP CHURCH</p>
    </footer>
    
    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!--end of the entire container  -->
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
</body>
</html>


