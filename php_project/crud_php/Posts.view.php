
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Posts</title>
</head>
<body class='background'>
    <?php require 'Partials/nav.php'; ?>
    <div class="hi">
     
        <h2>All Posts</h2>
        <?php if (count($posts) > 0) : ?>
            <ul class="list-group">
                <?php foreach ($posts as $post) : ?>
                    <li class="list-group-item">


                        <div class="username">
                        <h3><?=$post['name']?></h3>
                        </div>



                        <div class="post-content">
                            <h5><?= htmlspecialchars($post['caption']); ?></h5>
                            <small>Created at: <?= htmlspecialchars($post['created_at']); ?></small>
                        </div>


                        <div class="post-actions">


                            <form method="post" action="" class="like-form">
                                <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                                <button type="submit" name="like" class="btn like-btn">
                                    <i class="fa fa-heart <?= $post['liked'] ? 'liked' : ''; ?>"></i> 
                                    <span class="like-count"><?= $post['likes']; ?></span>
                                </button>
                            </form>


                            <form method="post" action="comment.php" class="comment-form">
                                <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                                <textarea name="comment" placeholder="Write a comment..."></textarea>
                                <button type="submit" name="submit" class="btn comment-btn">
                                    <i class="fa fa-pencil-square-o"></i> Comment
                                </button>
                            </form>

                            
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</body>
</html>