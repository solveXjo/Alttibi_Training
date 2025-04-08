<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /index");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>







  











    </style>
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
            <i class="fas fa-fire"></i> Most Liked Posts
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
                            • <span style="color: #4E5180;"><i class="fas fa-heart"></i> <?= $post['likes'] ?> likes</span>
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

            <!-- Sidebar Column -->
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

                <div class="sidebar-card">
                    <h5>Suggested Friends</h5>
                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" class="post-user-img" alt="User">
                            <div>
                                <h6 class="post-user-name">Mike Johnson</h6>
                                <small class="post-time">12 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">Add</button>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/33.jpg" class="post-user-img" alt="User">
                            <div>
                                <h6 class="post-user-name ">Sarah Williams</h6>
                                <small class="post-time">8 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">Add</button>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" class="post-user-img" alt="User">
                            <div>
                                <h6 class="post-user-name ">David Brown</h6>
                                <small class="post-time">5 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>