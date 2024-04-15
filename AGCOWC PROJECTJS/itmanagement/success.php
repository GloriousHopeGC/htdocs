<?php
session_start();
include('dbcon.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location: index.php');
    exit();
}

try {
    // Using prepared statements to prevent SQL injection
    $sqlCallUserCount = "CALL sp_GetUserCount()";
    $stmtCallUserCount = $pdo->prepare($sqlCallUserCount);
    $stmtCallUserCount->execute();
    $userCount = $stmtCallUserCount->fetch(PDO::FETCH_ASSOC)['user_count'];
    $stmtCallUserCount->closeCursor();

    $sqlCallAdminPostCount = "CALL sp_GetAdminCount()";
    $stmtCallAdminPostCount = $pdo->prepare($sqlCallAdminPostCount);
    $stmtCallAdminPostCount->execute();
    $adminPostCount = $stmtCallAdminPostCount->fetch(PDO::FETCH_ASSOC)['post_count'];
    $stmtCallAdminPostCount->closeCursor();

    $sqlCallFeedbackCount = "CALL sp_GetFeedbackCount()";
    $stmtCallFeedbackCount = $pdo->prepare($sqlCallFeedbackCount);
    $stmtCallFeedbackCount->execute();
    $FeedbackCount = $stmtCallFeedbackCount->fetch(PDO::FETCH_ASSOC)['feedback_count'];
    $stmtCallFeedbackCount->closeCursor(); //
    // Fetch the user data
    $sqlUserInfo = "CALL sp_GetItmanager(:user_id)";
    $stmtUserInfo = $pdo->prepare($sqlUserInfo);
    $stmtUserInfo->bindParam(':user_id', $_SESSION['user'], PDO::PARAM_INT);
    $stmtUserInfo->execute();
    $row = $stmtUserInfo->fetch(PDO::FETCH_ASSOC);

    // Check if user data is found
    if (!$row) {
        // Redirect to index.php if user data is not found
        header('location: index.php');
        exit();
    }
} catch (Exception $e) {
    // Handle any exceptions that might occur during the database query or redirection
    die('Error: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>It Manager</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-image: linear-gradient(to right, #74D680,#378B29);
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidebar a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 18px;
      color: #111;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover {
      color: #f1f1f1;
    }

    .sidebar .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    #main {
      transition: margin-left .5s;
      padding: 16px;
    }

    @media screen and (max-height: 450px) {
      .sidebar {padding-top: 15px;}
      .sidebar a {font-size: 16px;}
    }
  </style>
</head>
<body>
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <img src="../pictures/agcow logo.png" alt="Logo" width="150px" height="100px" style="margin-left: 50px">
  <a href="success.php">Dashboard</a>
  <a href="./listofadmins/index.php">List Of Admins</a>
  <a href="./listofusers/index.php">List Of Users</a>
  <a href="./listofpost/index.php">List Of Post</a>
  <a href="./listoffeedbacks/index.php">List Of Feedbacks</a>
  <a href="logout.php">Logout</a>
</div>

<div id="main">
  <button class="openbtn" onclick="openNav()">☰</button>  
</div>

<script>
  function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }

  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  }
</script>

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No Of Users</th>
                        <th>No Of Admin Posted</th>
                        <th>No of User Feedbacks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $userCount; ?></td>
                        <td><?php echo $adminPostCount; ?></td>
                        <td><?php echo $FeedbackCount; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>