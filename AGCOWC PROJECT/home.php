<!-- The homepage after login it can view private announcements edit read, delete profile  -->
<?php
session_start();
include('conn.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
    exit();
}

try {
    $stmt = $conn->prepare("CALL sp_GetUserId(:user_id)");
    $stmt->bindParam(':user_id', $_SESSION['user']);
    $stmt->execute();

    // Assuming you want to fetch the user data
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        // Use $fetch to access user data
    } else {
        header('location:index.php');
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Home</title>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29) ">
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-lg-top">

<div class="container">
	<a id="navbar-brandhome" class="navbar-brand" href="index.html"><Span class="text-warning"><img src="./pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </Span>CHURCH</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
		data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" onclick="scrollToSection('home')" style="cursor:pointer">Home</a>
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
<div class="container">
    <div class="row">
        <div class="col col-xs-0 col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col my-5">
            <img src="admin/upload/<?php echo $fetch["profile_photo"]?>" class="img- rounded-circle" width="150px" height="150px" alt="food">
                <style>
                    .img 
                    {
                         height: 15vh;
                         background-repeat: no-repeat;
                         background-size: cover;
                         width: 150px;
                    }
                </style>
                <br>
                <?php echo $fetch['user_fname']. "  " . $fetch['user_lname'];?>
        </div>
        <div class="col col-xs-2 col-sm-10 col-md-11 col-lg-11"></div>
	</div
    
        <?php 
		    require 'conn.php'; 
		    $sql = $conn->prepare ("CALL sp_GetAdminPost()");
		    $sql->execute();        
	    ?>
        <?php 
           if ($sql->rowCount() > 0) {
            while ($row = $sql->fetch()) {
                // Your existing code for the first while loop
            $postDate = date("F j, Y", strtotime($row['post_date']));
            if ($row['post_options'] >=2) {
	    ?>
		<div class="container">
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-3"></div>
                    <div class="col-sm-10 col-md-10 col-lg-6">
                    <div class="card">
                    <h5 class="card-header text-white" style="background-color: 016A70;"><img src="./pictures/agcow logo.png" class="img1" alt="agcowc">
                    <style>
                    .img1 
                    {
                         height: 7vh;
                         background-repeat: no-repeat;
                         background-size: cover;
                         width: 70px;
                    }
                    </style>
                    <?php echo $postDate; ?></h5>
                         <div class="card-body bg-muted">
                            <h5 class="card-title"><?php echo $row['user_title'] ;?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['user_post']); ?></p>
                            <br>
                            <p class="card-text">BY: <?php echo $row['admin_fname']." ". $row['admin_lname'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 col-md-1 col-lg-3"></div>
            </div>
            </div>
            <br>
            <?php
            }
    }
}
else {
    // If there are no rows in the first query
    echo "<h5 class='text-center'>No Available Announcement.</h5>";
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
<script src="/AGCOWC PROJECTJS/vueframework/home.js"></script>
</body>
</html>