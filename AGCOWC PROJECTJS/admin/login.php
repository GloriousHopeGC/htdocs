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
    try {
        // Using the stored procedure
        $stmt = $conn->prepare("CALL sp_LoginAdmin(:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['user_id'])) {
            $_SESSION['user'] = $result['user_id'];
            $out['message'] = "Login Successful";
        } else {
            $out['error'] = true;
            $out['message'] = "Login Failed. User not Found";
        }
    } catch (PDOException $e) {
        $out['error'] = true;
        $out['message'] = "Error: " . $e->getMessage();
    }
}

$conn = null; // Close the connection

header("Content-type: application/json");
echo json_encode($out);
die();
?>
