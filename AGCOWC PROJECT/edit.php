<?php
session_start();
include('conn.php');
if (!ISSET($_SESSION['user'])) {
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
    <script defer src="assets/js/bootstrap.bundle.min.js"></script>
    <title>Edit your profile</title>
</head>
<body style="background-image: linear-gradient(to right, #74D680, #378B29) ">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <?php
                  $id = $_SESSION['user'];

                  // Using the stored procedure
                  $sql = $conn->prepare("CALL sp_GetUserInfo(:user_id)");
                  $sql->bindParam(':user_id', $id, PDO::PARAM_INT);
                  $sql->execute();
              
                  // Fetching the result
                  $fetch = $sql->fetch();
              
                    ?>
                    <form action="edit_query.php" method="POST">
                        <h2 class="text-center">Edit Profile</h2>
                        <div class="form-group">
                            <label for="fname">Firstname</label>
                            <input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $fetch['user_fname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="lname">Lastname</label>
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $fetch['user_lname'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="gender" id="male" value="Male" <?php echo $fetch['user_gender'] == "Male" ? "checked" : ""; ?>>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php echo $fetch['user_gender'] == "Female" ? "checked" : ""; ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bdate">Birthday</label>
                            <input type="date" class="form-control" name="bdate" id="bdate" value="<?php echo $fetch['user_birthday']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="conum">Contact Number</label>
                            <input type="number" name="conum" class="form-control" placeholder="Contact Number" value="<?php echo $fetch['user_contactnum'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $fetch['user_email'] ?>" required>
                        </div>
                        <input type="hidden" name="user_id" value="<?php echo $fetch['user_id'] ?>" class="form-control">
                        <br>
                        <button class="btn btn-success btn-block" name="update">Done</button>
                        <button type="submit" class="btn btn-danger" name="cancel"><a href="profile.php" style="text-decoration:none; color:white;">Back</a></button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
