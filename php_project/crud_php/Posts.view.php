<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Partials/head.php'; ?>
    <title>SocialApp</title>
    <script>
    $(document).ready(function() {
        $('.like-btn').click(function() {
            var $button = $(this);
            var postId = $button.data('post-id');
            var $icon = $button.find('i');
            var isLiked = $icon.hasClass('liked'); 
            var $likeCount = $button.closest('.post-actions').prev().find('.like-count');
            var currentLikes = parseInt($likeCount.text());

            $likeCount.text(isLiked ? currentLikes - 1 : currentLikes + 1); 
            $icon.toggleClass('liked');
            $button.prop('disabled', true);

            $.post('handle_like.php', {
                post_id: postId,
                action: isLiked ? 'unlike' : 'like'
            }, function(response) {
                $likeCount.text(response);
            }).fail(function() {
                $likeCount.text(currentLikes);
                $icon.toggleClass('liked');
            }).always(function() {
                $button.prop('disabled', false);
            });
        });
    });
    </script>
</head>


<body>
    <?php require 'Partials/nav.php'; ?>

    <div class="container">


        <?php if (count($posts) > 0) : ?>
            <?php foreach ($posts as $post) : ?>


                <div class="post-card">
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

                    <div class="post-content">
                        <p><?= htmlspecialchars($post['caption']) ?></p>
                        <?php if (!empty($post['image'])) : ?>
                            <img src="uploads/<?= htmlspecialchars($post['image']) ?>" class="post-image">
                        <?php endif; ?>
                    </div>

                    <div style="color: var(--text-secondary); font-size: 14px; padding: 8px 0; border-bottom: 1px solid var(--border-color);">
                        <span><i class="fa fa-thumbs-up"></i> <span class="like-count"><?= $post['likes'] ?></span> Likes</span>
                    </div>

                    <div class="post-actions">
                        <button type="button" class="action-btn like-btn" data-post-id="<?= $post['id'] ?>" style="background-color: #0160f8;">
                            <i class="fa fa-thumbs-up <?= $post['liked'] ? 'liked' : '' ?>"></i> Like
                        </button>
                        <div class="action-btn">
                            <a href="comment.php?post_id=<?= $post['id'] ?>" style="color:blue; text-decoration: none;">
                                <i class="fa fa-comment"></i> Comment
                            </a>
                        </div>
                    </div>

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

