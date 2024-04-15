<?php
session_start();
include_once('dbcon.php');

if(isset($_POST['update_pass']))
{
    $id = $_POST['id'];
    $user_old = $_POST['user_oldpass'];
    $op = $_POST['old_pass'];
    $np = $_POST['new_pass'];
    $c_np = $_POST['confirm_pass'];

    if(empty($op))
    {
        echo "
        <script>alert('Old password is required')</script>
        <script>window.location = 'change.php'</script>
        ";
        exit();
    }
    else if(empty($np))
    {
        echo "
        <script>alert('New Pass is required')</script>
        <script>window.location = 'change.php'</script>
        ";
        exit();
    }
    else if($np !== $c_np)
    {
        echo "
        <script>alert('Confirmation pass did not match')</script>
        <script>window.location ='change.php'</script>
        ";
    }
    else if (md5($op) !== $user_old)
    {
        echo "
        <script>alert('Old password did not match')</script>
        <script>window.location ='change.php'</script>
        ";
        exit();
    }
    else 
    {
        // Use MD5 for the new password
        $hashed_password = md5($np);

        try {
            $query = "UPDATE admin2 SET admin_password=:new_pass WHERE id=:id";
            $statement = $conn->prepare($query);
    
            $data = [
                ':new_pass' => $hashed_password,  // Use MD5 for the new password
                ':id' => $id,
            ];

            $query_execute = $statement->execute($data);

            if($query_execute == -1)
            {
                $_SESSION['message'] = "Updated";
                header('Location: success.php');
                exit(0);
            }
            else
            {
                $_SESSION['message'] = "Not updated";
                header('Location: change.php');
                exit(0);
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
