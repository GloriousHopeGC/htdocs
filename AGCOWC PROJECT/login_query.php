<!-- Handles The Login To access user in homepage(requires sign up) -->
<?php
session_start();
require_once 'conn.php';

if (isset($_POST['login'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $user_username = $_POST['username'];
        $user_pass = $_POST['password'];
        //Select user_pass user_id from table users from user_username to fetch user_name from login 
        $sql = "SELECT user_id, user_pass, user_status FROM `users` WHERE `user_username`=:user_username";
        $query = $conn->prepare($sql);
        $query->bindParam(':user_username', $user_username, PDO::PARAM_STR);
        $query->execute();
        $fetch = $query->fetch();
        //Using Password verify to verify password_hash from registered users in the table users, user_pass which is in the database
        if ($query->rowCount() > 0) {
            if ($fetch["user_status"] == 0) {
                echo "
                    <script>alert('Account is disabled Please Contact The Admin')</script>
                    <script>window.location = 'index.php'</script>
                ";
            } elseif (password_verify($user_pass, $fetch["user_pass"])) {
                $_SESSION['user'] = $fetch['user_id'];
                header("location: home.php");
            } else {
                echo "
                    <script>alert('Invalid username or password')</script>
                    <script>window.location = 'index.php'</script>
                ";
            }
        } else {
            echo "
                <script>alert('Invalid username or password')</script>
                <script>window.location = 'index.php'</script>
            ";
        }
    } else {
        echo "
            <script>alert('Please complete the required field!')</script>
            <script>window.location = 'index.php'</script>
        ";
    }
}
?>
