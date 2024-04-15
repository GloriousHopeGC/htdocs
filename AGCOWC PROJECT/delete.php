<?php 
    require 'conn.php';
    session_start();
 
    if(!ISSET($_SESSION['user'])){
        header('location:index.php');
    }
    
    $id = $_SESSION['user'];

    // Using the stored procedure
    $sql = $conn->prepare("CALL sp_GetUserInfo(:user_id)");
    $sql->bindParam(':user_id', $id, PDO::PARAM_INT);
    $sql->execute();

    // Fetching the result
    $fetch = $sql->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Delete User</title>
</head>
<body style="background-image: linear-gradient(to right, #74D680,#378B29) ">
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center my-5">Confirmation On Deletion!!</h1>
            <h2 class="text-center mb-5">Are you sure you want to delete user <?php echo $fetch['user_fname']." " . $fetch['user_lname']; ?>?</h2>
            
            <form action="delete_query.php" method="POST">
                <div class="text-center">
                    <button type="submit" class="btn btn-danger mr-2" name="Delete" value="<?= $fetch['user_id']; ?>">Delete</button>
                    <a href="profile.php" class="btn btn-primary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
