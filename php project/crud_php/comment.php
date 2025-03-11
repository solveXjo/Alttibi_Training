<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

require_once  'config.php';
require_once  'Database.php';
require_once  'PostRepository.php';
$config = require 'config.php';
$db = new Database($config);
$postRepo = new PostRepository($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['comment'])) {
    $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
    $commentText = trim($_POST['comment']);

    if ($postId && !empty($commentText)) {
        $postRepo->addComment($postId, $userId, $commentText);
        header("Location: comment.php?post_id=" . $postId);
        exit();
    }
}

$postId = filter_input(INPUT_GET, 'post_id', FILTER_VALIDATE_INT);
$comments = $postId ? $postRepo->getAllComments($postId) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Comments</title>
</head>
<body class='background'>
    <?php require 'Partials/nav.php'; ?>

    <div class="container">
        <h2>Comments</h2>
        <?php if (!empty($comments)) : ?>
            <ul class="list-group">
                <?php foreach ($comments as $comment) : ?>
                    <li class="list-group-item">
                        <p><?= htmlspecialchars($comment['comment']) ?></p>
                        <small>
                            Posted by <?= htmlspecialchars($comment['name']) ?> 
                            at <?= htmlspecialchars($comment['created_at']) ?>
                            
                            <?php if ($userId === $comment['user_id']) : ?>
                                <div class="comment-actions">
                                    <button class="btn btn-sm btn-edit" data-commentid="<?= $comment['id'] ?>"> 
         
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-commentid="<?= $comment['id'] ?>">
                                        <?php
                                            ?> 
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            <?php endif; ?>
                        </small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No comments found.</p>
        <?php endif; ?>
        <a href="Posts.php" class="btn btn-default mt-3">
            <i class="fa fa-arrow-left"></i> Back to Posts
        </a>
    </div>
</body>
</html>