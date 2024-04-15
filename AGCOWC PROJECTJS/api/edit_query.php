<?php
session_start();
include_once('conn.php');

if(isset($_POST['update']))
{
    $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : '';
    $user_fname = isset($_POST['fname']) ? trim($_POST['fname']) : ''; 
    $user_lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';
    $user_birthday = isset($_POST['bdate']) ? trim($_POST['bdate']) : '';
    $user_gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
    $user_contactnum = isset($_POST['conum']) ? trim($_POST['conum']) : '';
    $user_email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Check if any of the fields are empty
    if(empty($user_fname) || empty($user_lname) || empty($user_birthday) || empty($user_gender) || empty($user_contactnum) || empty($user_email)){
        echo "  <script>alert('Please Input All The Fields')</script>
				<script>window.location = '/AGCOWC PROJECTJS/edit.php'</script>";
        exit(0);
    }

    try{
        $query = "UPDATE users SET user_fname=:fname, user_lname=:lname, user_birthday=:bdate, user_gender=:gender, user_contactnum=:conum, user_email=:email WHERE user_id=:user_id";
        $statement = $conn->prepare($query);

        $data = [
            ':fname' => $user_fname,
            ':lname' => $user_lname,
            ':bdate' => $user_birthday,
            ':gender' => $user_gender,  
            ':conum' => $user_contactnum, 
            ':email' => $user_email,     
            ':user_id' => $user_id,
        ];
        $query_execute = $statement->execute($data);
        if($query_execute)
        {
            echo "  <script>alert('Successfully Modified')</script>
             <script>window.location = '/AGCOWC PROJECTJS/home.php'</script>";
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not updated";
            header('Location: /AGCOWC PROJECTJS/edit.php');
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
