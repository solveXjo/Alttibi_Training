<head>
    <?php include 'partials/head.php'; ?>
    <title><?= htmlspecialchars($user['name'] ?? 'User') ?> | Profile</title>
    <style>
        .profile-header {
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .cover-photo {
            height: 200px;
            position: relative;
        }

        .profile-info {
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--card-color);
            object-fit: cover;
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--card-color);
        }

        .profile-name {
            margin-top: 70px;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-bio {
            color: var(--text-secondary);
            margin-bottom: 15px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 15px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-weight: 600;
            font-size: 18px;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .profile-content {
                grid-template-columns: 1fr 2fr;
            }
        }

        .profile-card {
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .profile-card h3 {
            margin-top: 0;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 15px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 15px;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-danger {
            background-color: #e41e3f;
            color: white;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #e7f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .image-upload-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php require 'partials/nav.php'; ?>
    <?php include "Partials/pageTitle.php"; ?>




    <main class="main">



        <section id="author-profile" class="author-profile section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="author-profile-1">

                    <div class="row">
                        <!-- Author Info -->
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="author-card" data-aos="fade-up">
                                <div class="author-image">
                                    <form method="post" enctype="multipart/form-data" class="image-upload-form">
                                        <label for="image" class="btn" style="margin-top: 70px;">
                                            <img src="uploads/<?= !empty($user['image_path']) ? htmlspecialchars($user['image_path']) : 'default.png' ?>" />
                                        </label>

                                        <input type="file" id="image" name="image" accept="image/*" style="display: none;"
                                            onchange="this.form.submit()">
                                    </form>
                                        

                                </div>





                                <div class="author-info">
                                    <h2><?= htmlspecialchars($user['name'] ?? 'User') ?></h2>

                                    <p class="designation"><?= htmlspecialchars($user['title'] ?? 'User') ?></p>



                                    <div class="author-stats d-flex justify-content-between text-center my-4">
                                        <div class="stat-item">
                                            <h4 data-purecounter-start="0" data-purecounter-end="147" data-purecounter-duration="1" class="purecounter">147</h4>
                                            <p>Articles</p>
                                        </div>
                                        <div class="stat-item">
                                            <h4 data-purecounter-start="0" data-purecounter-end="13" data-purecounter-duration="1" class="purecounter">13</h4>
                                            <p>Awards</p>
                                        </div>
                                        <div class="stat-item">
                                            <h4 data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1" class="purecounter">25K</h4>
                                            <p>Followers</p>
                                        </div>
                                    </div>

                                    <div class="social-links">
                                        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                                        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                    <div class="profile-location mt-4">
                                        <i class="fa fa-map-marker" style="color: #2d465e;"></i> <?= htmlspecialchars($user['location']) ?>
                                    </div>
                                    <a href="/profile_edit" class="btn btn-primary mt-4">edit</a>

                                </div>

                            </div>
                        </div>

                        <!-- Author Content -->
                        <div class="col-lg-8">
                            <div class="author-content" data-aos="fade-up" data-aos-delay="200">
                                <div class="content-header">
                                    <h3>About Me</h3>
                                </div>
                                <div class="content-body">
                                    <p> <?= htmlspecialchars($user['bio'] ?? '') ?></p>

                                    <div class="expertise-areas">
                                        <h4>Areas of Expertise</h4>
                                        <div class="tags">
                                            <span>Artificial Intelligence</span>
                                            <span>Cybersecurity</span>
                                            <span>Smart Home Technology</span>
                                            <span>Digital Privacy</span>
                                            <span>Consumer Electronics</span>
                                            <span>Future Tech Trends</span>
                                        </div>
                                    </div>

                                    <div class="featured-articles mt-5">
                                        <h4>Featured Articles</h4>
                                        <div class="row g-4">
                                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                                <article class="article-card">
                                                    <div class="article-img">
                                                        <img src="assets/img/blog/blog-post-10.webp" alt="Article" class="img-fluid">
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="post-category">Technology</div>
                                                        <h5><a href="#">The Future of AI in Everyday Computing</a></h5>
                                                        <div class="post-meta">
                                                            <span><i class="fa fa-clock"></i> Jan 15, 2024</span>
                                                            <span><i class="fa fa-comment"></i> 24 Comments</span>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>

                                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                                <article class="article-card">
                                                    <div class="article-img">
                                                        <img src="assets/img/blog/blog-post-6.webp" alt="Article" class="img-fluid">
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="post-category">Privacy</div>
                                                        <h5><a href="#">Understanding Digital Privacy in 2024</a></h5>
                                                        <div class="post-meta">
                                                            <span><i class="fa fa-clock"></i> Feb 3, 2024</span>
                                                            <span><i class="fa fa-comments"></i> 18 Comments</span>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Author Profile Section -->

    </main>

    <?php require 'Partials/footer.php'; ?>

</body>

</html>