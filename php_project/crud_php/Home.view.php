<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /index");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "Partials/head.php"; ?>
</head>

<body>
    <?php require_once 'Partials/nav.php'; ?>

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="create-post-card">
                    <form action="" method="post">

                        <textarea class="post-input mb-3" name="caption" id="caption" placeholder="Share your thoughts..." required></textarea>
                        <div class="d-flex justify-content-center align-items-center">

                            <button type="submit" class="post-button">Post</button>
                        </div>
                    </form>
                </div>


                <?php if (!empty($mostLikedPosts)): ?>
                    <div class="mb-4 mt-4">
                        <h5 class="text-center mb-3" style="color: #4E5180; font-weight: 600;">
                            <i class="fa fa-fire" style="color: red;"></i> Most Liked Posts
                        </h5>
                        <?php foreach ($mostLikedPosts as $post): ?>
                            <div class="post-card mb-3" style="border-left: 4px solid #4E5180;">
                                <div class="post-header">
                                    <img src="uploads/<?= !empty($post['user_image']) ? htmlspecialchars($post['user_image']) : 'default.png' ?>"
                                        class="post-user-img" alt="User">
                                    <div>
                                        <h6 class="post-user-name"><?= htmlspecialchars($post['name']) ?></h6>
                                        <small class="post-time">
                                            <?= date('F j, Y \a\t g:i a', strtotime($post['created_at'])) ?>
                                            • <span style="color: #4E5180;"><i class="fa fa-heart"></i> <?= $post['likes'] ?> likes</span>
                                        </small>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <p><?= htmlspecialchars($post['caption']) ?></p>
                                    <?php if (!empty($post['image'])): ?>
                                        <img src="uploads/<?= htmlspecialchars($post['image']) ?>" class="img-fluid rounded mb-2" alt="Post image">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


            </div>

            <div class="col-lg-4 sidebar">
                <div class="sidebar-card">
                    <h5>Trending Today</h5>
                    <div class="mt-3">
                        <a href="#" class="trending-tag">#WebDevelopment</a>
                        <a href="#" class="trending-tag">#TechNews</a>
                        <a href="#" class="trending-tag">#Programming</a>
                        <a href="#" class="trending-tag">#Design</a>
                        <a href="#" class="trending-tag">#SocialMedia</a>
                        <a href="#" class="trending-tag">#Trending</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

</html>