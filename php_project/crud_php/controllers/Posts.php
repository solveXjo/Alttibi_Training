<?php
require_once 'models/PostRepository.php';



$db = new Database(require 'config.php');
$postRepo = new PostRepository($db);

require 'models/UserRepository.php';

$userRepo = new UserRepository(($db));


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    $postId = $_POST['post_id'];
    if ($postId !== false) {
        $postRepo->incrementLikes($postId);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_comment'])) {
    $postId = $_POST['post_id'];
    $parentId = $_POST['parent_comment_id'];
    $comment = $_POST['comment'];

    if ($postId !== false && !empty($comment)) {
        $postRepo->addComment($postId, $_SESSION['user_id'], $comment, $parentId);
        header("Location: Posts.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {
    $commentId = $_POST['comment_id'];
    $newText = $_POST['new_comment'];

    if ($commentId !== false && !empty($newText)) {
        $postRepo->updateComment($commentId, $newText);
        header("Location: Posts.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post'])) {
    $postId = $_POST['post_id'];

    if ($postId !== false) {
        $postRepo->removePost($postId);
        header("Location: Posts.php");
        exit();
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment'])) {
    $commentId = $_POST['comment_id'];

    if ($commentId !== false) {
        $postRepo->deleteComment($commentId);
        header("Location: Posts.php");
        exit();
    }
}

$posts = $postRepo->getAllPosts();

require 'views/Posts.view.php';