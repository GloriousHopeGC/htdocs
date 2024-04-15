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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/AGCOWC PROJECTJS/assets/css/bootstrap.min.css">
    <script defer src="/AGCOWC PROJECTJS/assets/js/bootstrap.bundle.min.js" ></script>
    <link rel="icon" href="/AGCOWC PROJECTJS/pictures/agcowc logo_1.png">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
    .dot {
        height: 12px;
        width: 12px;
        border-radius: 50%;
        display: inline-block;
    }

    .dot-green {
        background-color: #28a745; /* Green color */
    }

    .dot-red {
        background-color: #dc3545; /* Red color */
    }
    </style>

    <title>Members</title>
</head>
<body style= "background-image: linear-gradient(to right, #74D680,#378B29)">

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
    <!-- Table forms -->
  <div class="container mt-5">
    <div class="container-fluid"> 
        <h1 class="text-center text-dark">Members</h1>
        <table class="table table-stripped table-hover table-bordered text-center">
    <thead>
        <tr>
            <th class="bg-secondary">Profile Photo</th>
            <th class="bg-secondary">Name</th>
            <th class="bg-secondary">Age</th>
            <th class="bg-secondary">Gender</th>
            <th class="bg-secondary">Contact Number</th>
            <th class="bg-secondary">Email</th>
            <th class="bg-secondary">Username</th>
            <!-- <th class="bg-secondary">Status</th> -->
            <th class="bg-secondary">Actions</th>
        </tr>
    </thead>

    <?php
    require 'dbcon.php';
    $sql = $conn->prepare("SELECT * FROM users");
    $sql->execute();
    ?>
    <tr>
        <?php
        while ($row = $sql->fetch()) {
            $userBirthday = new DateTime($row['user_birthday']);
            $currentDate = new DateTime();
            $age = $currentDate->diff($userBirthday)->y;
            ?>
            <td class="bg-white"><img src="upload/<?php echo $row["profile_photo"] ?>" width="50px" height="50px"></td>
            <td class="bg-white"><?php echo $row['user_fname'] . " " . $row['user_lname']; ?></td>
            <td class="bg-white"><?php echo $age ?></td>
            <td class="bg-white"><?php echo $row['user_gender']; ?></td>
            <td class="bg-white"><?php echo $row['user_contactnum']; ?></td>
            <td class="bg-white"><?php echo $row['user_email']; ?></td>
            <td class="bg-white"><?php echo $row['user_username']; ?></td>
            <!-- <td class="bg-white">
            <?php
                if ($row['activity'] == 1) {
        // User is active
                echo '<span class="dot dot-green"></span> Active now';
                } else {
        // User is not active
                echo '<span class="dot dot-red"></span> Inactive now';
                }
            ?>
            </td> -->
            <td class="bg-white">
                <form method="post" action="status.php">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <input type="hidden" name="current_status" value="<?php echo $row['user_status']; ?>">
                    <button type="submit" name="toggle_status" class="btn btn-sm <?php echo ($row['user_status'] == 1) ? 'btn-danger' : 'btn-success'; ?>">
                        <?php echo ($row['user_status'] == 1) ? 'Disable' : 'Enable'; ?>
                    </button>
                </form>
            </td>
    </tr>
    <?php
}
?>
</table>

</form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/AGCOWC PROJECTJS/vueframework/applogout.js"></script>
</body>
</html>