<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Partials/head.php'; ?>
    <title>Feed | SocialApp</title>
</head>

<body>
    <?php require 'Partials/nav.php'; ?>

    <div class="container">
        <!-- Create Post Card (would link to your post creation page) -->


        <?php if (count($posts) > 0) : ?>
            <?php foreach ($posts as $post) : ?>


                <div class="post-card">
    <!-- Post Header -->
    <div class="post-header">
        <img src="uploads/<?= !empty($post['user_image']) ? htmlspecialchars($post['user_image']) : 'default.png' ?>" 
             alt="Profile" 
             class="post-avatar">
        
        <div>
            <div class="post-user"><?= htmlspecialchars($post['name']) ?></div>
            <div class="post-time"><?= date('F j, Y \a\t g:i a', strtotime($post['created_at'])) ?></div>
        </div>
        
        <?php if ($post['user_id'] == $_SESSION['user_id']) : ?>
            <div style="margin-left: auto;">
                <form method="post" action="/posts" style="display:inline;">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <button type="submit" name="delete_post" class="btn btn-sm" 
                        style="color: var(--text-secondary);" 
                        onclick="return confirm('Are you sure you want to delete this post?');">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Post Content -->
    <div class="post-content">
        <p><?= htmlspecialchars($post['caption']) ?></p>
        <?php if (!empty($post['image'])) : ?>
            <img src="uploads/<?= htmlspecialchars($post['image']) ?>" class="post-image">
        <?php endif; ?>
    </div>

                    <div style="color: var(--text-secondary); font-size: 14px; padding: 8px 0; border-bottom: 1px solid var(--border-color);">
                        <span><i class="fa fa-thumbs-up"></i> <?= $post['likes'] ?> Likes</span>
                        <span style="margin-left: 15px;"><?= count($post['comments'] ?? []) ?> comments</span>
                    </div>

                    <div class="post-actions">
                        <form method="post" action="" class="like-form" style="flex: 1;">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <button type="submit" name="like" class="action-btn">
                                <i class="fa fa-thumbs-up <?= $post['liked'] ? 'liked' : '' ?>"></i> Like
                            </button>
                        </form>
                        <div class="action-btn">
                            <a href="comment.php?post_id=<?= $post['id'] ?>" style="color:blue; text-decoration: none;">
                                <i class="fa fa-comment"></i> Comment
                            </a>
                        </div>

                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section">
                        <?php if (!empty($post['comments'])) : ?>
                            <?php foreach ($post['comments'] as $comment) : ?>
                                <div class="comment">
                                    <img src="uploads/default.png" alt="Profile" class="comment-avatar">
                                    <div class="comment-content">
                                        <div class="comment-user"><?= htmlspecialchars($comment['name']) ?></div>
                                        <div class="comment-text"><?= htmlspecialchars($comment['text']) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Comment Form -->
                        <form method="post" action="../../comment.php" class="comment-form">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <img src="uploads/default.png" alt="Profile" class="comment-avatar">
                            <textarea name="comment" placeholder="Write a comment..."></textarea>
                            <button type="submit" name="submit" class="btn comment-btn">Post</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="no-posts">
                <i class="fa fa-newspaper-o" style="font-size: 60px; margin-bottom: 15px;"></i>
                <h3>No posts yet</h3>
                <p>When you or your friends share something, it will appear here.</p>
            </div>
        <?php endif; ?>
    </div>


</body>

</html>