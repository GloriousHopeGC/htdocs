<?php
    session_start();

    // Assuming you have stored user details in the session
    // Adjust this based on how you handle user sessions
        session_destroy();
        header('location: index.php');
?>
