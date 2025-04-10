<?php
session_start();

require_once 'models/PostRepository.php';
require_once 'Database.php';
require 'config.php';

$db = new Database(require 'config.php');
$postRepo = new PostRepository($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("Error: You must be logged in to post.");
    }

    $caption = ($_POST['caption']);
    $user_id = $_SESSION['user_id'];
    $name = ($_POST['name']);

    if (trim($caption) === '') {
        header("Location: /home");
        exit();
    }

    $query = "SELECT name FROM users WHERE id = :user_id";
    $stmt = $db->connection->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch();

    $name = $user['name'];

    $query = "INSERT INTO posts (user_id, name, caption, likes, created_at) VALUES (:user_id, :name, :caption, 0, NOW())";
    $stmt = $db->connection->prepare($query);

    $stmt->execute([
        'user_id' => $user_id,
        'name' => $name,
        'caption' => $caption,
    ]);

    header("Location: /posts");
    exit();
}


$mostLikedPosts = $postRepo->getMostLikedPosts(2);

require 'Home.view.php';
