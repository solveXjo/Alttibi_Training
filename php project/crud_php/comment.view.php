<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
require 'config.php';
require 'Database.php';
require 'PostRepository.php';

$db = new Database(require 'config.php');
$postRepo = new PostRepository($db);

$postId = filter_var($_POST['post_id'], FILTER_VALIDATE_INT);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $postId = filter_var($_POST['post_id'], FILTER_VALIDATE_INT);
}

if ($postId !== null) {
    $comments = $postRepo->getAllComments($postId);
} else {
    $comments = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <?php if (count($comments) > 0) : ?>
            <ul class="list-group">
                <?php foreach ($comments as $comment) : ?>
                    <li class="list-group-item">
                        <p><?= htmlspecialchars($comment['comment']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No comments found.</p>
        <?php endif; ?>
    </div>
</body>
</html>