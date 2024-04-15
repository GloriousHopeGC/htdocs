<?php
session_start();
include('dbcon.php');
if(!ISSET($_SESSION['user'])){
    header('location:index.php');
    die();  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>The Holy Bible</title>
    <style>
        body {
            color:white;
        }

        h1, h2, h3 {
            color: #333;
        }

        p {
            margin-bottom: 1.2em;
            color:white;
        }

        .verse {
            font-style: italic;
        }
    </style>
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
				<a class="nav-link active" aria-current="page" href="about.php">About</a>
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
			<li class="nav-item" id="applog">
				<a class="nav-link active" aria-current="page" @click="confirmLogout" style="cursor:pointer">Log-out</a>
			</li>
		</ul>

	</div>
</div>
</nav>	
<div class="container-fluid">
    <h1>The Holy Bible</h1>

    <h2>Genesis</h2>
    <p><span class="verse">1:1</span> In the beginning God created the heavens and the earth.</p>
    <p><span class="verse">1:2</span> Now the earth was formless and empty, darkness was over the surface of the deep, and the Spirit of God was hovering over the waters.</p>
    <p><span class="verse">2:7</span> Then the Lord God formed a man from the dust of the ground and breathed into his nostrils the breath of life, and the man became a living being.</p>
    <p><span class="verse">3:16</span> To the woman he said, "I will make your pains in childbearing very severe; with painful labor you will give birth to children. Your desire will be for your husband, and he will rule over you."</p>
    <!-- Add more verses as needed -->
    <!-- Add more chapters as needed -->

    <h2>Exodus</h2>
    <p><span class="verse">3:14</span> God said to Moses, "I AM WHO I AM. This is what you are to say to the Israelites: 'I AM has sent me to you.'</p>
    <p><span class="verse">12:1</span> The Lord said to Moses and Aaron in Egypt,...</p>
    <p><span class="verse">20:1</span> And God spoke all these words: "I am the Lord your God, who brought you out of Egypt, out of the land of slavery."</p>
    <!-- Add more verses as needed -->
    <!-- Add more chapters as needed -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
</body>
</html>
