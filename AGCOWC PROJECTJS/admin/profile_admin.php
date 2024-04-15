<?php
	require 'dbcon.php';
	session_start();
 
	if(!ISSET($_SESSION['user'])){
		header('location:index.php');
	}
    
    $id = $_SESSION['user'];

    // Using the stored procedure
    $sql = $conn->prepare("CALL sp_GetAdminInfo(:user_id)");
    $sql->bindParam(':user_id', $id, PDO::PARAM_INT);
    $sql->execute();
    $fetch = $sql->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $fetch['admin_fname']." ". $fetch['admin_lname']?></title>
	<link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <link rel="icon" href="/AGCOWC PROJECTJS/pictures/agcowc logo_1.png">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-lg-top">

<div class="container">
	<a class="navbar-brand" href="index.html"><Span class="text-warning"><img src="pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </Span>CHURCH</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
		data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="success.php">Home</a>
			</li>
			<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="profile_admin.php">View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./search/feedbacks.php">Feedbacks</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="manage.php">Manage Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="bible.php">Bible</a>
            </li>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page"  style="cursor:pointer" onclick="confirmLogout();">Log-out</a>
			</li>
	

		</ul>

	</div>
</div>
</nav>	

<div class="py-3">
            <!-- Black Card -->
            <div class="container py-5 h-100 ">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-8 col-xl-6">
                <div class="card bg-warning p-1 p-md-4">
            <!-- Black Card -->
            <!-- White Card -->
                <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-md-12 col-lg-12 col-xl-12 ">
                  <div class="card shadow-2-strong card-registration bg-white" style="border-radius: 15px;">
                  <div class="container mx-4 mt-2">
                  <img src="pictures/agcow logo.jpg" class="rounded" alt="..." width="20%" height="20%">
                    <h4>Name:</h4>
                    <p><?php echo $fetch['admin_fname']. " ". $fetch['admin_lname'];?></p>
                    <p><?php ?></p>
                    <h4>Email</h4>
                    <p><?php echo $fetch['admin_email']?></p>
                    <h4>Phone</h4>
                    <p><?php echo $fetch['admin_contactnum']?></p>

                    <div class="social_media">
            <ul>
                <div class="container">
                    <div class="row">
                     <div class="col">
                        <li><button class="btn btn-primary"><a href = "edit.php" style="text-decoration:none; color:black;" aria-current="page"class="nav-link active"><i class="bi bi-pencil-square"></i></a></button></a></li>
                    </div>
                    <div class="col">
                        <li><button class="btn btn-warning"><a href = "change.php" style="text-decoration:none; color:black;" aria-current="page"class="nav-link active"><i class="bi bi-key"></i></a></button></a></li>
                    </div>
                     </div>
                </div>
          </ul>
      </div>
                 </div>
                
                    

    </div>
</div>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Logout',
            text: 'Are you sure you want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log me out!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "logout.php"; // Redirect to logout page if confirmed
            }
        });
    }
</script>
</body>
</html>