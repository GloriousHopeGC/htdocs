<?php
session_start();
include_once('dbcon.php');
if(isset($_POST['edit']))
    {
        $post_id = $_POST['edit'];
        header("Location: post_edit.php?id=$post_id");
    }
    if (isset($_POST['update'])) {
        $post_id = $_POST['post_id'];
        $user_title = $_POST['title'];
        $user_post = $_POST['post'];
        $post_date = date('Y-m-d H:i:s');
    
        try {
            $query = "UPDATE post SET user_title=:title, user_post=:post, post_date=:date WHERE post_id=:post_id";
            $statement = $conn->prepare($query);
    
            $data = [':title' => $user_title, ':post' => $user_post, ':date' => $post_date, ':post_id' => $post_id];
            $query_execute = $statement->execute($data);
    
            if ($query_execute) {
                $_SESSION['message'] = "Updated";
                header('Location: success.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Not updated";
                header('Location: edit.php');
                exit(0);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    