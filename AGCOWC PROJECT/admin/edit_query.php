<?php
session_start();
include_once('dbcon.php');
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $admin_fname = $_POST['fname']; 
    $admin_lname = $_POST['lname'];
    $admin_contactnum = $_POST['conum'];
    try{
        $query = "UPDATE admin2 SET admin_fname=:fname, admin_lname=:lname, admin_contactnum=:conum WHERE id=:id";
        $statement = $conn->prepare($query);

        $data = [':fname' => $admin_fname,':lname' => $admin_lname,':conum' => $admin_contactnum,':id' => $id,];
        $query_execute = $statement->execute($data);
        if($query_execute)
        {
            $_SESSION['message'] = "Updated";
            header('Location: success.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not updated";
            header('Location: edit.php');
            exit(0);
        }
    }catch (PDOexception $e){
        echo $e->getMessage();
    }
}
?>