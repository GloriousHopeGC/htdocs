<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
    exit();
}

try {
    $stmt = $conn->prepare("SELECT * FROM admin2 WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user']);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
<html>
<head>
<title>Feedbacks</title>
<script defer src="assets/js/bootstrap.bundle.min.js"></script>
<link rel="icon" href="/AGCOWC PROJECTJS/pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-lg-top">

        <div class="container">
            <a class="navbar-brand" href="index.html"><Span class="text-warning"><img src="pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </Span>CHURCH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/AGCOWC PROJECTJS/admin/success.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/AGCOWC PROJECTJS/admin/profile_admin.php">View Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/AGCOWC PROJECTJS/admin/search/feedbacks.php">Feedbacks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/AGCOWC PROJECTJS/admin/manage.php">Manage Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/AGCOWC PROJECTJS/admin/bible.php">Bible</a>
                    </li>
                    <li class="nav-item" id="applog">
                        <a class="nav-link active" aria-current="page" @click="confirmLogout" style="cursor:pointer">Log-out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="vueappsearch">
    <div class="container mt-5">
    <div class="row mb-3">
    <div class="col-lg-6 offset-lg-3">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Name Email Or Feedbacks" v-on:keyup="searchMonitor" v-model="search.keyword">
                <!-- <button class="btn btn-primary" type="submit">Search</button> -->
            </div>
        </form>
    </div>
</div>
                     
<div class="row" v-if="noMember">
    <p colspan="2" align="center">No Feedbacks match your search</p>
</div>
                     
<div class="row">
        <div class="col-sm-1 col-md-1 col-lg-3"></div>
            <div class="col-sm-10 col-md-10 col-lg-6">
                    <div class="card my-2" v-for="member in employee">
                            <div class="card-body bg-muted">
                                <h5 class="card-title"><img v-if="member.profile_photo" :src="'../upload/' + member.profile_photo" alt="User Photo" class="img- rounded-circle" width="50px" height="50px" alt="agcowc">{{" "}}{{ member.user_fname}} {{""}} {{member.user_lname}}</h5>
                                <p class="card-text">{{ member.user_feedback }}</p>
                                <p class="card-text">BY: {{ member.user_email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-3"></div>
                    <br>
                </div>
                <br>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="applogout.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.10/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.min.js"></script>
<script src="vuesearchapp.js"></script>
</body>
</html>