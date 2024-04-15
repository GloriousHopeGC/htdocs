<?php
    session_start();
    if(isset($_SESSION['user'])){
        header('location:success.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel ="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="icon" href="/AGCOWC PROJECTJS/pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script defer src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary sticky-lg-top">

<div class="container">
    <a class="navbar-brand" href="index.html"><Span class="text-warning"><img src="pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </Span>CHURCH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

    </div>
</div>
</nav>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">

    <div id="vueapplogin">
            <div class="container mt-5 pt-5 mx-auto">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 m-auto">
                            <div class="card border-0 shadow">
                                <div class="card-body">
                                        <div class="panel panel-primary">
                                            <div class="text-center mx-auto my-3">
                                                <img src="pictures/agcow logo.jpg" class="rounded" alt="..." width="30%" height="30%">
                                            </div>
                <div class="panel-body">
                        <input type="text" class="form-control my-4 py-2" v-model="logDetails.username" v-on:keyup="keymonitor" placeholder="Username">
                        <input type="password" class="form-control my-4 py-2" v-model="logDetails.password" v-on:keyup="keymonitor" placeholder="Password">
                </div>
                <div class="text-center mt-3 my-2">
                    <button class="btn btn-primary btn-block" @click="checkLogin();"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                </div>
            </div>
 
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/vue@2.7.14"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogin.js"></script>
</body>
</html>