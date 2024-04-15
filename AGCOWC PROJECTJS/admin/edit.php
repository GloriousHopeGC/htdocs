<?php
session_start();
include('dbcon.php');
if(!ISSET($_SESSION['user'])){
    header('location:index.php');
    die();  
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <title>Edit your profile</title>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
<div class="form-sign-up">
<?php
				$id = $_SESSION['user'];
				$sql = $conn->prepare("SELECT * FROM `admin2` WHERE `id`='$id'");
				$sql->execute();
				$fetch = $sql->fetch();
			?>

        <form action="edit_query.php" method="POST">
            <h2>Edit Profile</h2>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="fname"  value="<?php echo $fetch['admin_fname']?>" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="lname" value="<?php echo $fetch['admin_lname']?>"class="form-control" placeholder="Last Name"required>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group">
                <input type="text" name="conum" value="<?php echo $fetch['admin_contactnum']?>" class="form-control" placeholder="Contact Number" required>
            </div>
            <br>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $fetch['id']?>" class="form-control" placeholder="user_id" >
            </div>
            <br>
			    <button class="btn btn-success form-control" name="update">Done</button>
                <a href="profile_admin.php">Back</a>
                       
                    </form>
</body>
</html>