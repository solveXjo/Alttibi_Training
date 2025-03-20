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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_comment'])) {
    $postId = filter_var($_POST['post_id'], FILTER_VALIDATE_INT);
    $parentId = filter_var($_POST['parent_comment_id'], FILTER_VALIDATE_INT) ?: null;
    $comment = trim($_POST['comment']);

    if ($postId !== false && !empty($comment)) {
        $postRepo->addComment($postId, $_SESSION['user_id'], $comment, $parentId);
        header("Location: Posts.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {
    $commentId = filter_var($_POST['comment_id'], FILTER_VALIDATE_INT);
    $newText = trim($_POST['new_comment']);

    if ($commentId !== false && !empty($newText)) {
        $postRepo->updateComment($commentId, $newText);
        header("Location: Posts.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post'])) {
    $postId = filter_var($_POST['post_id'], FILTER_VALIDATE_INT);

    if ($postId !== false) {
        $postRepo->removePost($postId);
        header("Location: Posts.php");
        exit();
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment'])) {
    $commentId = filter_var($_POST['comment_id'], FILTER_VALIDATE_INT);

    if ($commentId !== false) {
        $postRepo->deleteComment($commentId);
        header("Location: Posts.php");
        exit();
    }
}

$posts = $postRepo->getAllPosts();

require 'Posts.view.php';