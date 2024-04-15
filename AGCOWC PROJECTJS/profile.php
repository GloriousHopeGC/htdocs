<?php
require 'conn.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:index.php');
    exit();
}

try {
    $id = $_SESSION['user'];

    // Using the stored procedure
    $sql = $conn->prepare("CALL sp_GetUserInfo(:user_id)");
    $sql->bindParam(':user_id', $id, PDO::PARAM_INT);
    $sql->execute();

    // Fetching the result
    $fetch = $sql->fetch();

    if ($fetch) {
        $userBirthday = new DateTime($fetch['user_birthday']);
        $currentDate = new DateTime();
        $age = $currentDate->diff($userBirthday)->y;

        // Use $age or other data as needed
    } else {
        header('location:index.php');
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $fetch['user_fname']." ". $fetch['user_lname']?></title>
	<link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <link rel="icon" href="pictures/agcowc logo_1.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
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
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card bg-warning p-3">
                <div class="card shadow-2-strong card-registration bg-white" style="border-radius: 15px;">
                    <div class="container mx-4 mt-3">
                        <div class="text-center">
                            <img src="admin/upload/<?php echo $fetch['profile_photo']?>" class="img rounded-circle" width="150px" height="150px" alt="Profile Photo">
                        </div>
                        <div class="row justify-content-between mt-3">
                            <div class="col">
                                <h4>Name:</h4>
                                <p><?php echo $fetch['user_fname'] . " " . $fetch['user_lname'];?></p>
                            </div>
                            <div class="col">
                                <h4>Gender</h4>
                                <p><?php echo $fetch['user_gender']?></p>
                            </div>
                        </div>
                        <div class="row justify-content-between mt-3">
                            <div class="col">
                                <h4>Birthday</h4>
                                <p><?php echo $fetch['user_birthday'];?></p>
                            </div>
                            <div class="col">
                                <h4>Age</h4>
                                <p><?php echo $age;?></p>
                            </div>
                        <h4>Email</h4>
                        <p><?php echo $fetch['user_email']?></p>
                        <h4>Phone</h4>
                        <p><?php echo $fetch['user_contactnum']?></p>

                        <div class="social_media text-center" >
                            <ul class="list-unstyled d-flex justify-content-center">
                                <li class="mx-3">
                                    <button class="btn btn-primary">
                                        <a href="edit.php" style="text-decoration:none; color:black;">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </button>
                                </li>
                                <li class="mx-3" id="appdelete">
                                    <button class="btn btn-danger" @click="confirmDelete">
                                        <i class="bi bi-trash" style="color:black;"></i>
                                    </button>
                                </li>
                                <li class="mx-3">
                                    <button class="btn btn-warning">
                                        <a href="change.php" style="text-decoration:none; color:black;">
                                            <i class="bi bi-key"></i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/AGCOWC PROJECTJS/vueframework/appdeleteacc.js"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
</body>