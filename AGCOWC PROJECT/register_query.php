<!-- Handles the information inputted in Sign-up to be inputted in database -->
<?php
	session_start();
	require_once 'conn.php';
	
	if(ISSET($_POST['register'])){
		$user_fname = $_POST['fname'];
		$user_lname = $_POST['lname'];
		$user_gender = $_POST['gender'];
		$user_contactnum = $_POST['conum'];
        $user_email = $_POST['email'];
		$user_username = $_POST['username']; // Assuming email is used as the username
		$user_pass = $_POST['password'];
		$user_confirmpass = $_POST['confirm_password'];
		
		if ($user_pass !== $user_confirmpass){
			echo "
			<script>alert('Password Did not match')</script>
			<script>window.location ='index.php'</script>
			";
			exit();
		} else if(empty($user_fname) || empty($user_username) || empty($user_pass) || empty($user_email)){
			echo "
				<script>alert('Please fill up the required fields!')</script>
				<script>window.location = 'index.php'</script>
			";
		} else if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
			echo "
				<script>alert('Invalid email address!')</script>
				<script>window.location = 'index.php'</script>
			";
		} else {
			try{
				// Check if username already exists
				$stmt = $conn->prepare("SELECT * FROM `users` WHERE `user_username` = :username");
				$stmt->bindParam(':username', $user_username);
				$stmt->execute();
				
				if ($stmt->rowCount() > 0) {
					// Username already exists
					echo "
						<script>alert('Username already exists!')</script>
						<script>window.location = 'index.php'</script>
					";
					exit();
				}

				$user_birthday = $_POST['bdate'];
				// used password hash, password default from inserting password into the database
				$user_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$profile_photo = $_FILES['profile_photo']['name'];
				$tmpName= $_FILES["profile_photo"]["tmp_name"];
				$newfilename = uniqid(). "-". $profile_photo;
				move_uploaded_file($tmpName, 'admin/upload/' .$newfilename);
				$user_status = "1";
				
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO `users` VALUES ('', '$user_fname', '$user_lname','$user_birthday','$user_gender','$user_contactnum', '$user_email', '$user_username', '$user_pass', '$newfilename', '$user_status')";
				$conn->exec($sql);
				
			} catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$_SESSION['message'] = array("text" => "User successfully created.", "alert" => "info");
			$conn = null;
			header('location:index.php');
		}
	}
?>
