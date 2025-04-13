<?php
session_start();
require_once 'config.php';
require_once 'Database.php';
require_once 'models/PostRepository.php';

if (!isset($_SESSION['user_id'])) {
    header("/index");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $db = new Database(require 'config.php');
    $postRepo = new PostRepository($db);
    
    $postId = $_POST['post_id'];
    $userId = $_SESSION['user_id'];
    $action = $_POST['action'] ?? 'like';

        if ($action === 'like') {
            $postRepo->addLike($userId, $postId);
        } else {
            $postRepo->removeLike($userId, $postId);
        }
        
        $likes = $postRepo->getLikeCount($postId);
        echo $likes; 
    
} else {
    echo "0"; 
}