<?php
session_start();
include('dbcon.php');

$out = array('error' => false);

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == '') {
    $out['error'] = true;
    $out['message'] = "Username is required";
} elseif ($password == '') {
    $out['error'] = true;
    $out['message'] = "Password is required";
} else {
    $hashedPassword = md5($password);
    // Using prepared statements to prevent SQL injection
    $sql = "SELECT * FROM itmanager WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = $row['id'];
        $out['message'] = "Login Successful";
    } else {
        $out['error'] = true;
        $out['message'] = "Login Failed. User not Found";
    }
}

// Closing the PDO connection
$pdo = null;

header("Content-type: application/json");
echo json_encode($out);
die();
?>
