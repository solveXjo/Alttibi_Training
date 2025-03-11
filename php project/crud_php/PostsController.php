<?php
require 'config.php';
require 'Database.php';
require 'PostRepository.php';

$db = new Database(require 'config.php');
$postRepo = new PostRepository($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    $postId = filter_var($_POST['post_id'], FILTER_VALIDATE_INT);
    if ($postId !== false) {
        $postRepo->incrementLikes($postId);
    }
}

$posts = $postRepo->getAllPosts();