<?php
	session_start();
	require_once 'conn.php';
 
	if(isset($_POST['create_feedback'])){
		$user_id= isset($_POST['id']) ? trim($_POST['id']) : '';
		$feedback_post = isset($_POST['feedback']) ? trim($_POST['feedback']) : '';

		// Check if feedback is not empty
		if(empty($feedback_post)){
			echo "
				<script>alert('Feedback must not be empty!')</script>
				<script>window.location = 'feedback.php'</script>
			";
			exit; // Stop execution if the feedback field is empty
		}

		try{
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO `feedback` VALUES('', '$user_id','$feedback_post')";
			$conn->exec($sql);
		} catch(PDOException $e){
			echo $e->getMessage();
		}

		$_SESSION['message'] = array("text" => "Feedback successfully created.", "alert" => "info");
		$conn = null;
		header('location: home.php');
	} else {
		echo "
			<script>alert('Please fill up the required field!')</script>
			<script>window.location = 'feedback.php'</script>
		";
	}
?>
