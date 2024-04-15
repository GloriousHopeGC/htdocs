<?php
session_start();
include('conn.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
    header('location:index.php');
    exit();
}

try {
    $stmt = $conn->prepare("CALL sp_GetUserId(:user_id)");
    $stmt->bindParam(':user_id', $_SESSION['user']);
    $stmt->execute();

    // Assuming you want to fetch the user data
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        // Use $fetch to access user data
    } else {
        header('location:index.php');
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Feedback</title>
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

<div class="container">
    <div class="row py-5">
        <div class="col-3"></div>
        <div class="col py-4">
            <div class="card px-4 py-4 mx-2">
                <form action="./api/feedback_query.php" method="POST">
                    <div class="form-group">
                        <label>GIVE FEEDBACK</label>
                        <input type="hidden" class="form-control my-2" name="id" placeholder="Name" value="<?php echo $fetch['user_id'] ;?>">
                            <div id="feedback">
                                <textarea class="form-control my-2" name="feedback" placeholder="Give Feedback:" style="transition: height 0.3s;"  v-bind:style="{ height: textareaHeight + 'px' }" v-on:click="expandTextarea" required></textarea>
                            </div>
                    </div>
                    <button type="submit" name="create_feedback" class="btn btn-primary" value="POST">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
<script src="/AGCOWC PROJECTJS/vueframework/appfeedback.js"></script>
</body>
</html>