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
    <title>Home - Altibbi</title>
</head>

<body>
    <?php require_once 'Partials/nav.php'; ?>

    <div class="container py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="create-post-card">
                    <form action="" method="post">
                        <div class="form-group-2">
                            <label for="category">Category</label>

                            <select id="category" name="category" class="form-control" required>
                                <option value="" disabled selected>Select a category</option>
                                <option value="gaming">Gaming</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="sports">Sports</option>
                                <option value="health">Health</option>
                                <option value="education">Education</option>
                                <option value="Programming">Programming</option>
                                <option value="others">others</option>
                            </select value="<?= htmlspecialchars($posts['category'] ?? '') ?>">
                        </div>

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
                        <i class="trending-tag">#Web Development</i>
                        <i class="trending-tag">#Problem Solving</i>
                        <i class="trending-tag">#Programming</i>
                        <i class="trending-tag">#Design</i>
                        <i class="trending-tag">#Altibbi</i>
                        <i class="trending-tag">#Trending</i>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Blog Hero Section -->
    <section id="blog-hero" class="blog-hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="blog-grid">

                <!-- Featured Post (Large) -->
                <article class="blog-item featured" data-aos="fade-up">
                    <img src="assets/img/blog/blog-post-3.webp" alt="Blog Image" class="img-fluid">
                    <div class="blog-content">
                        <div class="post-meta">
                            <span class="date">Apr. 14th, 2025</span>
                            <span class="category">Technology</span>
                        </div>
                        <h2 class="post-title">
                            <a href="blog-details.html" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a>
                        </h2>
                    </div>
                </article><!-- End Featured Post -->

                <!-- Regular Posts -->
                <article class="blog-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/blog/blog-post-portrait-1.webp" alt="Blog Image" class="img-fluid">
                    <div class="blog-content">
                        <div class="post-meta">
                            <span class="date">Apr. 14th, 2025</span>
                            <span class="category">Security</span>
                        </div>
                        <h3 class="post-title">
                            <a href="blog-details.html" title="Sed do eiusmod tempor incididunt ut labore">Sed do eiusmod tempor incididunt ut labore</a>
                        </h3>
                    </div>
                </article><!-- End Blog Item -->

                <article class="blog-item" data-aos="fade-up" data-aos-delay="200">
                    <img src="assets/img/blog/blog-post-9.webp" alt="Blog Image" class="img-fluid">
                    <div class="blog-content">
                        <div class="post-meta">
                            <span class="date">Apr. 14th, 2025</span>
                            <span class="category">Career</span>
                        </div>
                        <h3 class="post-title">
                            <a href="blog-details.html" title="Ut enim ad minim veniam, quis nostrud exercitation">Ut enim ad minim veniam, quis nostrud exercitation</a>
                        </h3>
                    </div>
                </article><!-- End Blog Item -->

                <article class="blog-item" data-aos="fade-up" data-aos-delay="300">
                    <img src="assets/img/blog/blog-post-7.webp" alt="Blog Image" class="img-fluid">
                    <div class="blog-content">
                        <div class="post-meta">
                            <span class="date">Apr. 14th, 2025</span>
                            <span class="category">Cloud</span>
                        </div>
                        <h3 class="post-title">
                            <a href="blog-details.html" title="Adipiscing elit, sed do eiusmod tempor incididunt">Adipiscing elit, sed do eiusmod tempor incididunt</a>
                        </h3>
                    </div>
                </article><!-- End Blog Item -->

                <article class="blog-item" data-aos="fade-up" data-aos-delay="400">
                    <img src="assets/img/blog/blog-post-6.webp" alt="Blog Image" class="img-fluid">
                    <div class="blog-content">
                        <div class="post-meta">
                            <span class="date">Apr. 14th, 2025</span>
                            <span class="category">Programming</span>
                        </div>
                        <h3 class="post-title">
                            <a href="blog-details.html" title="Excepteur sint occaecat cupidatat non proident">Excepteur sint occaecat cupidatat non proident</a>
                        </h3>
                    </div>
                </article><!-- End Blog Item -->

            </div>

        </div>

    </section><!-- /Blog Hero Section -->



    <?php include 'Partials/footer.php'; ?>

</body>

</html>