<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location: ../index.php');
    exit();
}

try {
    // Using prepared statements to prevent SQL injection
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
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bcryptjs@2.4.3/dist/bcrypt.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
<title>List Of Admins</title>
<style>
    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
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
[v-cloak] {
    display: none;
}
</style>
</head>
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <img src="/AGCOWC PROJECTJSIM/pictures/agcow logo.png" alt="Logo" width="150px" height="100px" style="margin-left: 50px">
  <a href="../success.php">Dashboard</a>
  <a href="../listofadmins/index.php">List Of Admins</a>
  <a href="../listofusers/index.php">List Of Users</a>
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
<body class="bg-light">
    <div class="container" id="app" v-cloak>
        <div class="row">
            <div class="col-md-10"><h3>ALMIGHTY GOD CENTER OF WORSHIP CHURCH</h3>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex d-flex justify-content-between">
                            <div class="lead">List Of Feedbacks</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-muted lead text-center" v-if="!records.length">No record found</div>
                        <div class="table table-success table-striped" v-if="records.length">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(record, i) in records" :key="record.id">
                                        <td>{{i + 1}}</td>
                                        <td>{{record.user_fname}} {{record.user_lname}}</td>
                                        <td>{{record.user_email}}</td>
                                        <td>
                                            <a href="#" @click.prevent="deleteRecord(record.id)" class="btn btn-danger">Delete</a>
                                            <a href="#" @click.prevent="editRecord(record.id)" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>          
                
                <div>
                    <b-modal ref="my-modal1" hide-footer title="Feedback">
                    <div>
                        <form action="" @submit.prevent="onUpdate">
                            <div class="form-group">
                                <label for="">Feedbacks</label>
                                <textarea v-model="edit_lname" class="form-control my-2" style="height: 200%;" disabled></textarea>
                            </div>
                        </form>
                    </div>
                    <b-button class="mt-3" variant="outline-danger" block @click="hideModal('my-modal1')">Close Me</b-button>
                   </b-modal>
                </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<!-- BootstrapVue js -->
<script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="app.js"></script>
</body>
</html>