<?php
// Assuming you have a PDO database connection established
include('dbcon.php'); 
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    try {
        $query = "DELETE FROM post WHERE post_id=:post_id";
        $statement = $conn->prepare($query);
        $data = [
            ':post_id' => $post_id
        ];
        $query_execute = $statement->execute($data);
        
        if($query_execute)
        {
            $_SESSION['message'] = "Deleted";
            header('Location: index.php');
            session_destroy();
            exit(0);
        }

        else{ 
            $_SESSION['message'] = "Not updated";
            header('Location: index.php');
            exit(0);
        }

    } catch(PDOexception $e) {
        echo $e->getMessage();
    }
}
?>
