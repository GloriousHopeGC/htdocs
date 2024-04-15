<?php
session_start();
include_once('conn.php');

if(isset($_POST['update_pass']))
{
    $user_id = $_POST['user_id'];
    $user_fname = $_POST['fname']; 
    $user_lname = $_POST['lname'];
    $user_contactnum = $_POST['conum'];
    $user_old=$_POST['user_oldpass'];
    $op =  $_POST['old_pass'];
    $np =  $_POST['new_pass'];
    $c_np =$_POST['confirm_pass'];
    
    if(empty($op) || empty($np) || $np !== $c_np)
    {
        echo "<script>alert('Please fill in all fields and ensure that the new password and confirmation match.')</script>";
        echo "<script>window.location = 'change.php'</script>";
        exit();
    }
    
    // Check if the old password matches
    if (!password_verify($op, $user_old))
    {
        echo "<script>alert('Old password did not match')</script>";
        echo "<script>window.location ='change.php'</script>";
        exit();
    }

    // Hash the new password securely
    $hashed_password = password_hash($np, PASSWORD_DEFAULT);

    try {
        $query = "UPDATE users SET user_fname=:fname, user_lname=:lname, user_contactnum=:conum, user_pass=:new_pass WHERE user_id=:user_id";
        $statement = $conn->prepare($query);

        $data = [':fname' => $user_fname, ':lname' => $user_lname, ':conum' => $user_contactnum, ':new_pass' => $hashed_password, ':user_id' => $user_id];
        $query_execute = $statement->execute($data);

        if ($query_execute == -1) {
            echo "<script>alert('Change Successfully')</script>";
            echo "<script>window.location ='home.php'</script>";
            exit();
        } else {
            $_SESSION['message'] = "Not updated";
            header('Location: change.php');
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
