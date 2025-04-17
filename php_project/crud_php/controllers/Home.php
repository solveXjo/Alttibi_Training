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

    $caption = trim($_POST['caption']);
    $category = $_POST["category"] ?? 'others';
    $user_id = $_SESSION['user_id'];

    if (empty($caption)) {
        header("Location: /home");
        exit();
    }

    // Handle image upload if present
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/posts/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $destination = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            $imagePath = $destination;
        }
    }

    $query = "SELECT name FROM users WHERE id = :user_id";
    $stmt = $db->connection->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch();
    $name = $user['name'];

    $query = "INSERT INTO posts (user_id, name, caption, likes, created_at, category, image_path) 
              VALUES (:user_id, :name, :caption, 0, NOW(), :category, :image_path)";
    $stmt = $db->connection->prepare($query);

    $stmt->execute([
        'user_id' => $user_id,
        'name' => $name,
        'caption' => $caption,
        'category' => $category,
        'image_path' => $imagePath
    ]);

    header("Location: /posts");
    exit();
}

$mostLikedPosts = $postRepo->getMostLikedPosts(5);
