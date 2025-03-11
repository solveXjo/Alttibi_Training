<?php
require 'config.php';
require 'Database.php';

session_start(); 

$db = new Database(require 'config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("Error: You must be logged in to post.");
    }

    $caption = ($_POST['caption']);
    $user_id = $_SESSION['user_id']; 

    $query = "INSERT INTO posts (user_id, caption, likes, created_at) VALUES (:user_id, :caption, 0, NOW())";
    $stmt = $db->connection->prepare($query);
    $stmt->execute([
        'user_id' => $user_id,
        'caption' => $caption
    ]);

    header("Location: Posts.php");
    exit();
}
?>
