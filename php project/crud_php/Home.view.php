<?php
    require 'config.php';
    require 'Database.php';

    $db = new Database(require 'config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $caption = ($_POST['caption']);
        $query = "INSERT INTO posts (caption, likes, created_at) VALUES (:caption, 0, NOW())";
        $stmt = $db->connection->prepare($query);
        $stmt->execute([
            'caption' => $caption
        ]);
        header("Location: Posts.php");
        exit();

        }
?>