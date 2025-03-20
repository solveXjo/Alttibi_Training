<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

require_once 'config.php';
require_once 'Database.php';
require_once 'PostRepository.php';

$config = require 'config.php';
$db = new Database($config);
$postRepo = new PostRepository($db);



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['comment'])) {
    $postId =  $_POST['post_id'];
    $commentText = $_POST['comment'];

    if ($postId && !empty($commentText)) {
        $postRepo->addComment($postId, $userId, $commentText);
        header("Location: comment.php?post_id=" . $postId);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {
    $commentId = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);
    $newText = trim($_POST['new_comment']);

    if ($commentId && !empty($newText)) {
        $postRepo->updateComment($commentId, $newText);
        header("Location: comment.php?post_id=" . $_GET['post_id']);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment'])) {
    $commentId = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT);

    if ($commentId) {
        $postRepo->deleteComment($commentId);
        header("Location: comment.php?post_id=" . $_GET['post_id']);
        exit();
    }
}

$postId = filter_input(INPUT_GET, 'post_id', FILTER_VALIDATE_INT);
$comments = $postId ? $postRepo->getAllComments($postId) : [];
require 'comment.view.php';