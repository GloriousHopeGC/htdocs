
<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location: ../index.php');
    exit();
}

try {
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
<title>List Of Members</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
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
  <img src="/AGCOWC PROJECTJSIM/pictures/agcow logo.png" alt="Logo" width="150px" height="100px" style="margin-left: 50px">
  <a href="../success.php">Dashboard</a>
  <a href="../listofadmins/index.php">List Of Admins</a>
  <a href="index.php">List Of Users</a>
  <a href="../listofpost/index.php">List Of Post</a>
  <a href="../listoffeedbacks/index.php">List Of Feedbacks</a>
  <a href="../logout.php">Logout</a>
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

<div id="vueappsearch">
    <div class="container">
        <h1 class="page-header text-center">AGCOWC Registered Members</h1>
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-4 col-md-offset-8">
                    <input type="text" class="form-control" placeholder="Search Name or Position" v-on:keyup="searchMonitor" v-model="search.keyword">
                </div>
            </div>
            <div style="height:5px;"></div>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Lastname</th>
                    <th>FirstName</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                </thead>
                <tbody>
                     
                    <tr v-if="noMember">
                        <td colspan="2" align="center">No member match your search</td>
                    </tr>
                     
                    <tr v-for="member in employee">
                        <td>{{ member.user_lname}}</td>
                        <td>{{ member.user_fname}}</td>
                        <td>{{ member.user_birthday}}</td>
                        <td>{{ member.user_gender}}</td>
                        <td>{{ member.user_contactnum}}</td>
                        <td>{{ member.user_email}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
<script src="vuesearchapp.js"></script>
</body>
</html>