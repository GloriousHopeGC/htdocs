<!-- This is the Hompage of The Website, This page can enable user to view home, about-us, contact-us. It can also enable the 
user to log-in and sign-up -->
<?php
  // Session if the user forgot to log out his/her account
    session_start();
    if(isset($_SESSION['user'])){
        header('location:home.php');
    }
?>
<html lang="en">
<head>
    <!-- The background blurr -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="pictures/agcowc logo_1.png"> <!-- Icon Above -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"> <!-- Bootstrap Libarires -->
    <script defer src="assets/js/bootstrap.bundle.min.js" ></script> <!-- Bootstrap Libarires -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> <!--Vue Extention Framework -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="css/agcowc.css">
    <title>Almighty God Center of Worship Church</title>
    <!-- Picture Rounded In Our Team -->
    <style>
    .person-image {
            max-width: 100px;
            max-height: 50%;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style= "background-image: linear-gradient(to right, #74D680,#378B29)" >
<!-- Navbar for Navigation -->
<section id="home"></section> 
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-lg-top">
  <div class="container">
    <a id="navbar-brand" class="navbar-brand" href="index.html"><span class="text-warning"><img src="./pictures/agcow logo.png" width="60" height="40">&nbsp; A.G.C.O.W </span>CHURCH </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="cursor:pointer" onclick="scrollToSection('home')">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="cursor:pointer" onclick="scrollToSection('about')">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="cursor:pointer" onclick="scrollToSection('announcement')">Announcements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="cursor:pointer" onclick="scrollToSection('team')">Our Team</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" style="cursor:pointer" onclick="scrollToSection('contact')">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" name="login" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Message After Log-in -->
    <?php 
                if(isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div>
			<script>
				(function() {
					// removing the message 3 seconds after the page load
					setTimeout(function(){
						document.querySelector('.msg').remove();
					},3000)
				})();
			</script>
			<?php 
				endif;
				// clearing the message
				unset($_SESSION['message']);
			?>
<!-- Login Modal-->
 <div id="#">
 <div class="modal fade"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">LOG-IN</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="align-content: end;"></button>
            </div>
            <div class="modal-body">
            <!-- Forms In Modal -->
                <form action="login_query.php" method="POST" autocomplete="off">
                        <div class="text-center mx-auto my-3">
                            <img src="pictures/agcow logo.jpg" class="rounded" alt="..." width="30%" height="30%">
                        </div>
                            <input input type="text" name="username" class="form-control my-4 py-2" placeholder="Username">
                            <input type="password" name="password"  id="" class="form-control my-4 py-2" placeholder="Password">
                                <div class="text-center mt-3 my-2">
                                    <button class="btn btn-primary mx-4" name="login">Login</button>
                                </div>
                                    <div class="text-center">
                                        <a href=" " data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#sign-up" class="nav-link">Not Have An account? Sign-up Now</a>
                                    </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
</form>
<!-- Sign up modal -->
<div id="#">
 <div class="modal fade"  id="sign-up" tabindex="-1" aria-labelledby="sign-upLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Sign-up</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="align-content: end;"></button>
            </div>
            <div class="modal-body">
            <!-- Forms In Modal -->
                <form action="register_query.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6 md-6 sm-6">
                                <input type="text" name="fname" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-6 md-6 col-sm-6">
                                <input type="text" name="lname" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                </div>
                <br>    
                <div class="row">
                <div class="col-6">
       <label for="name" class="form-label">Birthday</label>
        <input type="date" name="bdate" id="bdate" ng-model="patient.DateOfBirth" format="dd/mm/yyyy" class="form-control" required="true" value="<?php echo (isset($_GET['bdate']))?$_GET['bdate']:''; ?>">
        <span class="input-group-btn">
             <button type="button" class="btn btn-default" ng-disabled="patient.PatientId" ng-click="open()">
             <i class="fa fa-calendar"></i>
            </button>
             </span>
          </div>

          
          <div class="col-6">
          <label for="name" class="form-label text-dark">Gender</label>
          <div class="col-form-check-inline">
     
          <div class="form-check form-check-inline">
        <input type="radio" class="form-check-input" name="gender" id="male" value="Male" checked />
        <label class="form-check-label" for="maleGender">Male</label>
      </div>
        
      <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="female"
              value="Female" />
            <label class="form-check-label" for="femaleGender">Female</label>
            </div>
       </div>
    </div>
    </div>
    <br>
                    <div class="form-group">
                        <input type="number" name="conum" class="form-control" placeholder="Contact Number">
                    </div>
                        <br>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="username" name="username" class="form-control" placeholder="Username" required>
                    </div>
                        <br>
                        
                    <div class="form-group">
                        <input type="password" name="password" class="form-control"  placeholder="Password" required>
                        <br>
                    <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control"  placeholder="Confirm Password" required>
                    </div>
                     </div>
                        <div class="form-group">
                        <label for="Profile Picture">Profile Picture</label>
                        <input type="file" name="profile_photo" class="form-control" placeholder="Choose a photo" required>
                    </div>
                        
                        <br>
                        <button class="btn btn-success form-control" name="register">Register</button>
				                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Log-in</a></button>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
    <div class="img-container">
        <img src="./pictures/agcowc logo_1.png" class="img" alt="food">
    </div>
<style>
.img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 95vh;
        }

        .img {
            max-width: 80%;
            max-height: 100%;
            width: auto;
            height: auto;
            opacity: 0.5;
        }
</style>
                  
                
    </div>
    </div>
    <!-- ABOUT -->
    <section style="background-color:#dadada;">
    <header class="text-dark text-center py-2" style="background-color:#a7a7a7;">
    <section id="about">
        <h1 class="Text-center" >About</h1>
    </header>
    <div class="container mt-4">
        <section >
            <h2 class="text-center">Our Story</h2>
            <p>The Almighty God Center Of Worship Church, or AGCOW Church, was established on August 30, 1985, by Marcelito D. Cuyos, who is the head pastor of AGCOW Church and continues to lead it until today.
            The AGCOW Church is the church for everyone. It is not only for Christians but is open to all individuals who wish to worship and draw closer to the Lord. 
            This is for everyone so that people may know the truth based solely on the holy scriptures and the Bible. This continues until today in teaching based on the truth written in the holy scriptures. The teachings are solely based on the Bible.
            We follow and give warnings based on the words written in the holy scriptures. Our guidance adheres to the words of the Lord as written in the Bible.
            </p>
            <br>
            <p>Ang Almighty God Center Of Worship Church, o AGCOW Church, ay itinatag noong Agosto 30, 1985, ni Marcelito D. Cuyos, na siyang punong pastor ng AGCOW Church at patuloy na nagtataguyod nito hanggang sa ngayon.
            Ang AGCOW Church ay simbahan para sa lahat. Hindi ito eksklusibo para sa mga Kristiyano kundi bukas sa lahat ng indibidwal na nais magsamba at lumapit sa Panginoon.
            Ito ay para sa lahat upang malaman ng mga tao ang katotohanan na batay lamang sa banal na kasulatan at sa Bibliya. Ito ay nagpapatuloy hanggang sa ngayon sa pagtuturo na nakabatay sa katotohanang nakasulat sa banal na kasulatan. Ang mga aral ay lubos na batay sa Bibliya.
            Kami ay sumusunod at nagbibigay ng babala batay sa mga salitang nakasulat sa banal na kasulatan. Ang aming patnubay ay sumusunod sa mga salita ng Panginoon na nasa Bibliya.
            </p>
            <br>
            <p>Ang Almighty God Center Of Worship Church or AGCOW Church kay nabuhat pag August 30 1985, Nabuhat ni ug natukod ni Marcelito D Cuyos mao ang head pastor sa AGCOWCHURCH ug nagpadayun hangtud karon. 
            Ang AGCOWC CHURCH Mao ang simbahan para sa tanan. Dili lang para sa mga kristohanon kundi abli kini sa tanan taw nga gusto musimba ug maduol sa Ginoo. 
            kini para sa tanan aron ang mga taw masayud sa kamatuoran nga gabase rajud sa balaang kasulatan ug sa bibliya kani nagpadayun hangtud karon sa pagtudlo base sa kamatuoran nga nasulat sa balaang kasulatan. Ug bIbliya lamang ang gibasehan sa pagtudlo. 
            kami nagsunod ug nagpahimangno base sa mga pulong nga nahisulat sa balaang kasulatan. ug kini nagsunod sumala sa pulong na Ginoo na nasulat sa bibliya
            </p>
            <br>
            <p>La Iglesia Centro de Adoración del Dios Todopoderoso, o Iglesia AGCOW, fue establecida el 30 de agosto de 1985 por Marcelito D. Cuyos, quien es el pastor principal de la Iglesia AGCOW y continúa liderándola hasta hoy. La Iglesia AGCOW es la iglesia para todos. No es solo para los cristianos, sino que está abierta a todas las personas que deseen adorar y acercarse al Señor. Esto es para todos, para que las personas puedan conocer la verdad basada únicamente en las Sagradas Escrituras y la Biblia. Esto continúa hasta hoy en la enseñanza basada en la verdad escrita en las Sagradas Escrituras. Las enseñanzas se basan únicamente en la Biblia. Seguimos y damos advertencias basadas en las palabras escritas en las Sagradas Escrituras. Nuestra orientación se adhiere a las palabras del Señor tal como están escritas en la Biblia.
            </p>
            <br>
        </section>
    </div>
<!-- Mission And Vission -->
    <section style="background-color:#e5d3b3;">
  <header class="text-white text-center py-2" style="background-color:#e5d3b3;">
    <section id="about">
      <h1 class="text-dark">Our Mission and Vision</h1>
    </header>
    <div class="container mt-4">
      <div class="row">
        <!-- Mission Column -->
        <div class="col-md-6 mt-2">
          <div class="card text-center">
            <img src="./pictures/agcow logo.jpg" class="card-img-top rounded-circle img-fluid mx-auto d-block" style="width: 25%; height: 25%;" alt="Mission Image">
            <div class="card-body">
              <h2 class="card-title">Mission</h2>
              <p class="card-text">1 Timothy 2:4<br>Who will have all men to be saved, and to come unto the knowledge of the truth.</p>
            </div>
          </div>
        </div>

        <!-- Vision Column -->
        <div class="col-md-6 mt-2">
          <div class="card text-center">
            <img src="./pictures/agcow logo.jpg" class="card-img-top rounded-circle img-fluid mx-auto d-block" style="width: 25%; height: 25%;" alt="Vision Image">
            <div class="card-body">
              <h2 class="card-title">Vision</h2>
              <p class="card-text">1 Corinthians 2:9<br> But as it is written, Eye hath not seen, nor ear heard, neither have entered into the heart of man, the things which God hath prepared for them that love him.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  </section>
</section>
<!-- Public Announcements -->
<section id="announcement" style="background-color:#a7a7a7;;">
<header class="text-dark text-center py-2" >
    <h1 class="text-center">Announcements</h1>
</header>
<?php 
require 'conn.php'; 

$sql = $conn->prepare("SELECT * FROM post LEFT JOIN admin2 ON post.id = admin2.id");
$sql->execute();
?>

<?php 
if ($sql->rowCount() > 0) {
    while ($row = $sql->fetch()) {
        // Your existing code for the first while loop
        $postDate = date("F j, Y", strtotime($row['post_date']));
        
        // Add an if statement to check post_options
        if ($row['post_options'] == 1 || $row['post_options'] == 3 ) {
?>
<br>
        <div class="container" >
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-3"></div>
                <div class="col-sm-10 col-md-10 col-lg-6">
                    <div class="card">
                        <h5 class="card-header text-white" style="background-color: #016A70;">
                            <img src="./pictures/agcow logo.png" class="img1" alt="agcowc">
                            <style>
                                .img1 {
                                    height: 7vh;
                                    background-repeat: no-repeat;
                                    background-size: cover;
                                    width: 70px;
                                }
                            </style>
                            <?php echo $postDate; ?>
                        </h5>
                        <div class="card-body bg-muted">
                            <h5 class="card-title"><?php echo $row['user_title'] ;?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['user_post']); ?></p>
                            <br>
                            <p class="card-text">BY: <?php echo ($row['admin_fname'] !== null && $row['admin_lname'] !== null) ? $row['admin_fname'] . " " . $row['admin_lname'] : "Admin User"; ?></p>

                        </div>
                    </div>
                </div>
                <div class="col-sm-1 col-md-1 col-lg-3"></div>
            </div>
            <br>
        </div>
<?php
        }
    }
} else {
    // If there are no rows in the first query
    echo "<h1 class='text-center'>No Available Announcement.</h1>";
}
?>

 <p class="text-center my-2" data-bs-toggle="modal" data-bs-target="#exampleModal" style="cursor:pointer" id="team">Want more Announcements? Log-in Now</p>
 <br>
</section>
<style>
    .org-chart {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }
  </style>

<section>
<div class="container">
  <h2 class="text-center mt-4 mb-4">Our Team</h2>

  <div class="org-chart">
    <!-- Pastor -->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/Bishop Lito.jpg" alt="Top Person" class="person-image">
        <h5 class="card-title">Bishop Marcelito Cuyos</h5>
        <p class="card-text">Head Pastor<BR> Officiating Minister<BR>Bishop</p>
      </div>
    </div>

    <!-- pastors -->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/Patsor Jireh.jpg" alt="Subordinate 1" class="person-image">
        <h5 class="card-title">Pastor Jireh Cuyos</h5>
        <p class="card-text">Pastor <BR> Music Director <BR> Youth Pastor</p>
      </div>
    </div>
    <!-- pastors -->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/Pastor Jimmy.jpg" alt="Subordinate 2" class="person-image">
        <h5 class="card-title">Pastor Jimmy Lamoste</h5>
        <p class="card-text">Pastor<br>Assitant Pastor</p>
      </div>
    </div>

    <!-- pastors -->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/Pastor William.jpg" alt="Subordinate 2" class="person-image">
        <h5 class="card-title">Pastor William Resma</h5>
        <p class="card-text">Pastor<br>Assitant Pastor</p>
      </div>
    </div>
</div>
    <div class="org-chart">
    <!-- musicians-->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/Jirah Grace.jpg" alt="Subordinate 1" class="person-image">
        <h5 class="card-title">Jirah Grace Cuyos</h5>
        <p class="card-text">Assistant<br> Music Director<BR>Pianist</p>
      </div>
    </div>

    <!-- pastors -->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/Hope.jpg" alt="Subordinate 1" class="person-image">
        <h5 class="card-title">Glorious Hope Cuyos</h5>
        <p class="card-text">Assitant<br> Music Director<BR>Drummer</p>
      </div>
    </div>
    <!-- pastors -->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/Majesty.jpg" alt="Subordinate 2" class="person-image">
        <h5 class="card-title">Majesty Resma</h5>
        <p class="card-text">Guitarist</p>
      </div>
    </div>

    <!-- pastors -->
    <div class="card" style="width: 200px;  margin: 10px; ">
      <div class="card-body text-center">
      <img src="org/earl.jpg" alt="Subordinate 2" class="person-image">
        <h5 class="card-title">Earl Phillip Mamac</h5>
        <p class="card-text">Worship Leader</p>
      </div>
    </div>
</section>
<br><br><br>
    <section id="contact"class="bg-light py-4">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <p class="text-center">If you have any questions or would like to get in touch, feel free to contact us:</p>
            <address class="text-center">
                Email: <a href="mailto:info@example.com">agcow1987@example.com</a><br>
                Phone: +63 943 6459302<br>
                Address: Purok Shooting Star Babag II Lapu-Lapu City, Cebu.
            </address>
        </div>
    </section>
</section>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 1988 ALMIGHTY GOD CENTER OF WORSHIP CHURCH</p>
    </footer>
    
    <!-- Add Bootstrap JS and jQuery -->
    <script src="/AGCOWC PROJECTJS/vueframework/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!--end of the entire container  -->
</body>
</html>