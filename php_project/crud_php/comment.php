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
    $postId = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT);
    $commentText = trim($_POST['comment']);

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Comments</title>
</head>
<body class='background'>
    <?php require 'Partials/nav.php'; ?>

    <div class="">
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
                                <div class="edit_form">


                                    <form method="POST" action="comment.php?post_id=<?= $postId ?>" > 
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <textarea name="new_comment"><?= htmlspecialchars($comment['comment']) ?></textarea>
                                        <button type="submit" name="edit_comment" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i> Save Edit
                                        </button>
                                    </form>

                                    <form method="POST" action="comment.php?post_id=<?= $postId ?>" style="display:inline;">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <button type="submit" name="delete_comment" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this comment?');">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
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