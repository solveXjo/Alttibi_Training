<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Partials/head.php'; ?>

    <title>Posts</title>
</head>

<body>
    <?php require 'Partials/nav.php'; ?>
    <div class="card">
        <h2>All Posts</h2>

        <?php if (count($posts) > 0) : ?>
            <ul class="list-group">
                <?php foreach ($posts as $post) : ?>
                    <li class="list-group-item">
                        <div class="username card-header">
                            <h3>by: <?= htmlspecialchars($post['name']) ?></h3>
                        </div>

                        <div class="post-content card-body">
                            <div class="row">

                            <h5 style="color: purple;"><?= htmlspecialchars($post['caption']) ?></h5>

                         <!-- Like Button  -->
                                <form method="post" action="" class="like-form mb-2">
                                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                    <button type="submit" name="like" class="btn like-btn">
                                        <i class="fa fa-heart <?= $post['liked'] ? 'liked' : '' ?>"> <span class="like-count"><?= $post['likes'] ?></span></i>

                                    </button>
                                </form>
                            </div>
                            <small>Created at: <?= htmlspecialchars($post['created_at']) ?></small>
                        </div>

                        <div class="post-actions card-footer">
                            <div class="column">



                                <!-- Comment Form -->
                                <form method="post" action="../../comment.php" class="comment-form mb-3">
                                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                    <textarea name="comment" placeholder="Write a comment..."></textarea>
                                    <button type="submit" name="submit" class="btn comment-btn">
                                        <i class="fa fa-pencil-square-o">Comment</i>
                                    </button>
                                </form>


                                <?php if ($post['user_id'] == $_SESSION['user_id']) : ?>
                                    <form method="post" action="posts.php" style="display:inline;">
                                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                        <button type="submit" name="delete_post" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">
                                            <i class="fa fa-trash">Delete</i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>

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