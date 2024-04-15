<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=db_agcowc', 'root', '');

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If you want to specify charset, you can do it like this:
    // $pdo->exec('set names utf8');
} catch (PDOException $e) {
    die('Error: ' . $e->getMessage());
}
?>
