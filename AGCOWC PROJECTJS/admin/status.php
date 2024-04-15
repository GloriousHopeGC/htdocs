<?php
require 'dbcon.php';

if (isset($_POST['toggle_status'])) {
    $user_id = $_POST['user_id'];
    $current_status = $_POST['current_status'];

    // Toggle the user status
    $new_status = ($current_status == 1) ? 0 : 1;

    $update_sql = "UPDATE users SET user_status = :new_status WHERE user_id = :user_id";
    $update_query = $conn->prepare($update_sql);
    $update_query->bindParam(':new_status', $new_status, PDO::PARAM_INT);
    $update_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $update_query->execute();

    // Redirect back to the admin panel
    header("Location: manage.php");
    exit();
}
?>
