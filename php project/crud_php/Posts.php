<?php
    require 'config.php';
    require 'Database.php';

    $db = new Database(require 'config.php');

    $query = "SELECT id, caption, likes, created_at FROM posts ORDER BY created_at DESC";
    $stmt = $db->connection->prepare($query);
    $stmt->execute();  
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($posts);
?>

<?php
if(isset($_POST['like'])) {
    $postId = $_POST['post_id'];
    $sql = "UPDATE posts SET likes = likes + 1 WHERE id = :id";
    $stmt = $db->connection->prepare($sql);
    $stmt->bindParam(':id', $postId, PDO::PARAM_INT);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>

    <title>Document</title>
</head>
<body>
    <h2>All posts</h2>
    <ul>
        <?php if (count($posts) > 0) : ?>
            <?php foreach ($posts as $post) : ?>
                <li>
                <h3><?= htmlspecialchars($post['caption']); ?></h3>
                <p>Likes: <?= htmlspecialchars($post['likes']); ?></p>
                <form method="post" action="">
                    <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                    <input type="submit" value="like" name="like">
                </form>

                <p>Created at: <?= htmlspecialchars($post['created_at']); ?></p>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No posts found.</li>
        <?php endif; ?>
    </ul>
</body>
</html>
