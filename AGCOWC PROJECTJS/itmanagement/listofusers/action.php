<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_agcowc";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $out = array('error' => false);

    $action = "show";

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    if ($action == 'show') {
        $sql = "SELECT * FROM users ORDER BY user_lname ASC";
        $query = $conn->query($sql);
        $employee = $query->fetchAll(PDO::FETCH_ASSOC);

        $out['employee'] = $employee;
    }

    if ($action == 'search') {
        $keyword = $_POST['keyword'];
        $sql = "SELECT * FROM users WHERE user_fname LIKE :keyword OR user_lname LIKE :keyword  OR user_birthday LIKE :keyword OR user_contactnum LIKE :keyword OR user_email LIKE :keyword";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->execute();
    
        $employee = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $out['employee'] = $employee;
    }    
} catch (PDOException $e) {
    $out = array('error' => true, 'message' => 'Connection failed: ' . $e->getMessage());
}

$conn = null;

header("Content-type: application/json");
echo json_encode($out);
die();
?>
