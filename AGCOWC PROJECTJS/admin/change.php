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
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <title>Change Password</title>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
<div class="form-sign-up">
<?php
				$id = $_SESSION['user'];
				$sql = $conn->prepare("SELECT * FROM `admin2` WHERE `id`='$id'");
				$sql->execute();
				$fetch = $sql->fetch();
			?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h4>Change Password</h4>
        </div>
        <div class="card-body">
          <!-- Form for changing password -->
          <form action="change_password_query.php "method="POST">
          <div class="form-group">
                <div class="row">
                <input type="hidden" name="id" value= "<?php echo $fetch['id']?>" class="form-control" required>
                <input type="hidden" name="user_oldpass"  value= "<?php echo $fetch['admin_password']?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
              <label for="oldPassword">Old Password</label>
              <input type="password" class="form-control" name="old_pass" required>
            </div>
            <div class="form-group">
              <label for="newPassword">New Password</label>
              <input type="password" class="form-control" name="new_pass" required>
            </div>
            <div class="form-group">
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" class="form-control" name="confirm_pass" required>
            </div>
            <br>
            <div class="d-flex justify-content-between">
                <button class="btn btn-success btn-block" name="update_pass">Change Password</button>
                <a href="profile_admin.php" class="btn btn-secondary">Back</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>