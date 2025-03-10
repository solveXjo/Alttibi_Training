<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>All posts</h2>
    <ul>
        <?php foreach ($posts as $post) : ?>
            <li>
                <h3><?= $post->$caption; ?></h3>
                <!-- <p><?= $post->body; ?></p> -->
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>