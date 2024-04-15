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
    <link rel="icon" href="pictures/agcowc logo_1.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script>
    <title>Edit</title>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29)">
<?php
				$id = $_SESSION['user'];
				$sql = $conn->prepare("SELECT * FROM `post` WHERE `post_id`='$id'");
				$sql->execute();
				$fetch = $sql->fetch();
			?>

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
                <a class="nav-link active" aria-current="page" href="manage.php">Manage Members</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="bible.php">Bible</a>
            </li>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page"  style="cursor:pointer" onclick="confirmLogout();">Log-out</a>
			</li>
	

		</ul>

	</div>
</div>
</nav>	
<?php 
			
		    require 'dbcon.php'; 
			$id = $_GET['id'];
		    $sql = $conn->prepare ("SELECT * FROM `post` WHERE `post_id`='$id'");
		    $sql->execute();
            $fetch = $sql->fetch();        
	    ?>
		<div class="container">
		<div class="row">
			<div class="col-3"></div>
				<div class="col px-2 py-4 mx-2">
            		<div class="card px-4 py-4 mx-2 MY-4">
                		<form action="post_edit_query.php" method="POST">
                    		<div class="form-group">
                        		<label>POST ANNOUNCEMENT</label>
                        		<input type="hidden" name="post_id" value="<?php echo $fetch['post_id']?>" class="form-control" placeholder="user_id" >
                        		<input type="text" class="form-control my-2" name="title" placeholder="Write Title" value="<?php echo $fetch['user_title']?>">
                        		<textarea class="form-control my-2 " style="height:200px;"name="post"  placeholder="Write Announcement:"><?php echo $fetch['user_post']?></textarea>
                    		</div>
                    			<button class="btn btn-success" name="update">Done</button>
                		</form>
						</div>
            	</div>
			<div class="col-3"></div>
        </div>
    </div>
</div>
</div>
</body>
</html>