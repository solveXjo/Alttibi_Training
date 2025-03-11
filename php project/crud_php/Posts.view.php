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
    <title>Posts</title>
</head>
<body class='background'>
    <?php require 'Partials/nav.php'; ?>
    <div>
        <h2 >All Posts</h2>
        <?php if (count($posts) > 0) : ?>
            <ul class="list-group">
                <?php foreach ($posts as $post) : ?>
                    <li class="list-group-item">
                        <div>
                            <h5><?= htmlspecialchars($post['caption']); ?></h5>
                            <small>Created at: <?= htmlspecialchars($post['created_at']); ?></small>
                        </div>
                        <form method="post" action="">
                            <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                            <button type="submit" name="like" class="btn">
                                <i class="fa fa-heart"></i> <?= htmlspecialchars($post['likes']); ?>
                            </button>
                        </form>
                        <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['comment'])) {
                                $post_id = $_POST['post_id'];
                                $comment = $_POST['comment'];
                                $user_id = 1;
                                $query = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
                                $stmt = $db->connection->prepare($query);
                                $stmt->execute([$post_id, $user_id, $comment]);

                                header("Location: Home.php");
                                exit();
                            } ?>


                    <form method="post" action="comment.php">
                        <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                        <textarea name="comment" placeholder="Write a comment..."></textarea>
                        <button type="submit" name="submit" class="btn">
                            <i class="fa fa-pen-to-square"></i> Comment
                        </button>
                    </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</body>
</html>