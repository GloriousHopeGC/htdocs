<?php
session_start();
include_once('conn.php');

if (isset($_POST['Delete'])) {
    $id = $_POST['Delete'];

    try {
        // Using the stored procedure
        $query = "CALL sp_DeleteUser(:id)";
        $statement = $conn->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $query_execute = $statement->execute();

        if ($query_execute) {
            $_SESSION['message'] = "Deleted";
            header('Location: index.php');
            session_destroy();
            exit(0);
        } else {
            $_SESSION['message'] = "Not deleted";
            header('Location: index.php');
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
