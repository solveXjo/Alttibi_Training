<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Partials/head.php'; ?>
    <title>Feed | SocialApp</title>
    <style>
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .container {
            max-width: 680px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .post-card {
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
            padding: 16px;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .post-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 12px;
            object-fit: cover;
        }

        .post-user {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .post-time {
            color: var(--text-secondary);
            font-size: 13px;
        }

        .post-content {
            margin-bottom: 12px;
            line-height: 1.4;
            font-size: 15px;
        }

        .post-image {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 8px;
            margin: 8px 0;
            background-color: #f0f0f0;
        }

        .post-actions {
            display: flex;
            border-top: 1px solid var(--border-color);
            padding-top: 8px;
            margin-top: 8px;
        }

        .action-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            border-radius: 4px;
            color: var(--text-secondary);
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .action-btn i {
            margin-right: 6px;
            font-size: 18px;
        }

        .liked {
            color: #f33 !important;
        }

        .comment-form {
            display: flex;
            margin-top: 12px;
        }

        .comment-form textarea {
            flex: 1;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 10px 16px;
            resize: none;
            height: 40px;
            margin-right: 8px;
            background-color: var(--bg-color);
            outline: none;
        }

        .comment-form button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .comments-section {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--border-color);
        }

        .comment {
            display: flex;
            margin-bottom: 8px;
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .comment-content {
            background-color: var(--bg-color);
            padding: 8px 12px;
            border-radius: 18px;
            max-width: 85%;
        }

        .comment-user {
            font-weight: 600;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .comment-text {
            font-size: 14px;
        }

        .no-posts {
            text-align: center;
            padding: 40px;
            color: var(--text-secondary);
        }
    </style>
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