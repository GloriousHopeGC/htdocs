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
    <link rel="stylesheet" href="./css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <title>Home</title>
     <style>
        /* Custom CSS to make navbar unscrollable */
        .navbar {
            position: fixed;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29) ">
 <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <div class="bg-secondary col-auto col-md-4 col-lg-3 min-vh-100 d-flex flex-column justify-content-between" >
                <div class="bg-secondary" id="navbarSupportedContent">
                    <!-- Sidebar Content -->
                    <a class="d-flex text-decoration-none mt-1 align-items-center text-white mt-3" id="navbarSupportedContent">
                        <span class="fs-4 d-none d-sm-inline">
                        <img src="admin/upload/<?php echo $fetch["profile_photo"]?>" class="img- rounded-circle" width="70px" height="70px" alt="food">
               <?php echo $fetch['user_fname']. "  " . $fetch['user_lname'];?>
                        </span>
                    </a>
                    <ul class="nav nav-pills flex-column mt-2  position-fixed">
                        <!-- Sidebar Menu Items -->
                        <ul class="nav nav-pills flex-column mt-2">
                            <li class="nav-item py-2 py-sm-0">
                                <a class="nav-link text-white" aria-current="page" onclick="scrollToSection('home')" style="cursor:pointer">
                                    <i class="fas fa-home"></i><span class="fs-4 ms-3  d-none d-sm-inline">Home</span>
                                </a>
                            </li>
                            <li class="nav-item py-2 py-sm-0">
                                <a href="profile.php" class="nav-link text-white" aria-current="page">
                                    <i class="fa-solid fa-user"></i><span class="fs-4 ms-3  d-none d-sm-inline">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item py-2 py-sm-0">
                                <a href="feedback.php" class="nav-link text-white" aria-current="page">
                                    <i class="fa-solid fa-comment"></i><span class="fs-4 ms-3 d-none d-sm-inline">Feedback</span>
                                </a>
                            </li>
                            <li class="nav-item py-2 py-sm-0">
                                <a href="bible.php" class="nav-link text-white" aria-current="page">
                                    <i class="fa-solid fa-book"></i><span class="fs-4 ms-3  d-none d-sm-inline">Bible</span>
                                </a>
                            </li>
                            <li class="nav-item py-2 py-sm-0" id="applog">
                                <a class="nav-link text-white" aria-current="page"  @click="confirmLogout" style="cursor:pointer">
                                    <i class="fa-solid fa-door-open"></i><span class="fs-4 ms-3  d-none d-sm-inline">Log-Out</span>
                                </a>
                            </li>
                        </ul>
                        <!-- More sidebar menu items -->
                    </ul>
                </div>
            </div>
           
            <!-- Card Content -->
            <div class="col">
                <h2 style="text-align: center">ANNOUNCEMENTS</h1>
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
            if ($row['post_options'] >=1) {
	    ?>
                <div class="container">
                    <div class="row justify-content-CENTER">
                        <div class="col-sm-12 col-md-10 col-lg-8">
                            <div class="card">
                                <h5 class="card-header text-white" style="background-color: #016A70;">
                                    <img src="./pictures/agcow logo.png" class="img1" alt="agcowc">
                                    <style>
                    .img1 
                    {
                         height: 7vh;
                         background-repeat: no-repeat;
                         background-size: cover;
                         width: 70px;
                    }
                    </style>
                                    <?php echo $postDate; ?>
                                </h5>
                                <div class="card-body bg-muted">
                                    <h5 class="card-title"><?php echo $row['user_title'] ;?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($row['user_post']); ?></p>
                                    <br>
                                    <p class="card-text">BY: <?php echo $row['admin_fname']." ". $row['admin_lname'];?></p>
                                </div>
                            </div>
                            <br>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
<script src="/AGCOWC PROJECTJS/vueframework/home.js"></script>
</body>
</html>