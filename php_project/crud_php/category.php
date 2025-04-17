<?php
session_start();
require_once 'controllers/Posts.php'; // Include the file where $posts is defined
$posts = $postRepo->getAllPosts();
?>

<head>
    <?php include 'Partials/head.php' ?>
    <title>Category</title>
    <style>
        .blog-pagination {
            padding-top: 0;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        .blog-pagination ul {
            display: flex;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .blog-pagination li {
            margin: 0 5px;
            transition: 0.3s;
        }

        .blog-pagination li a {
            color: color-mix(in srgb, var(--default-color), transparent 40%);
            padding: 7px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blog-pagination li a.active,
        .blog-pagination li a:hover {
            background: var(--default-color);
            color: var(--contrast-color);
        }

        .blog-pagination li a.active a,
        .blog-pagination li a:hover a {
            color: var(--contrast-color);
        }

        .blog-posts .post-date {
            background-color: var(--default-color);
            color: var(--contrast-color);
            position: absolute;
            right: 0;
            bottom: 0;
            text-transform: uppercase;
            font-size: 13px;
            padding: 6px 12px;
            font-weight: 500;
        }
    </style>

</head>

<body class="category-page">


    <?php include 'Partials/nav.php' ?>




    <main class="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Posts Section -->
                    <section id="blog-posts" class="blog-posts section">

                        <div class="container">
                            <div class="row gy-4">
                                <?php foreach ($posts as $post) : ?>
                                    <div class="col-lg-6">
                                        <article class="position-relative h-100">

                                            <div class="post-img position-relative overflow-hidden">
                                                <img src="<?php
                                                            if (isset($post['image_path'])) {
                                                                echo $post['image_path'];
                                                            } else {
                                                                echo 'images/download.png';
                                                            }
                                                            ?>" class="img-fluid" alt="" style="max-width: 460px;">
                                                <span class="post-date"><?= date("F j", strtotime($post["created_at"])) ?></span>
                                            </div>

                                            <div class="post-content d-flex flex-column">

                                                <h3 class="post-title"><?= htmlspecialchars($post["caption"]) ?></h3>

                                                <div class="meta d-flex align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa fa-user"></i> <span class="ps-2"><?= htmlspecialchars($post["name"]) ?></span>
                                                    </div>
                                                    <span class="px-3 text-black-50">/</span>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa fa-folder"></i> <span class="ps-2"><?= $post["category"] ?></span>
                                                    </div>
                                                </div>

                                                <p>
                                                    Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                                </p>

                                                <hr>


                                            </div>

                                        </article>
                                    </div><!-- End post list item -->
                                <?php endforeach; ?>



                            </div>
                        </div>

                    </section><!-- /Blog Posts Section -->


                </div>

                <div class="col-lg-4 sidebar">

                    <div class="widgets-container">

                        <!-- Blog Author Widget 2 -->
                        <div class="blog-author-widget-2 widget-item">

                            <div class="d-flex flex-column align-items-center">
                                <img src="assets/img/blog/blog-author.jpg" class="rounded-circle flex-shrink-0" alt="">
                                <h4>Jane Smith</h4>
                                <div class="social-links">
                                    <a href="https://x.com/#" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                                    <a href="https://facebook.com/#" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://instagram.com/#" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                                    <a href="https://linkedin.com/#" target="_blank" rel="noopener noreferrer"><i class="fab fa-linkedin-in"></i></a>
                                </div>

                                <p>
                                    Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                                </p>

                            </div>
                        </div><!--/Blog Author Widget 2 -->

                        <div class="categories-widget widget-item">

                            <h3 class="widget-title">Categories</h3>
                            <ul class="mt-3">
                                <li><a href="#">General <span>(25)</span></a></li>
                                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                                <li><a href="#">Travel <span>(5)</span></a></li>
                                <li><a href="#">Design <span>(22)</span></a></li>
                                <li><a href="#">Creative <span>(8)</span></a></li>
                                <li><a href="#">Educaion <span>(14)</span></a></li>
                            </ul>

                        </div><!--/Categories Widget -->


                    </div>

                </div>
                <!-- Blog Pagination Section -->
                <section id="blog-pagination" class="blog-pagination section">

                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <ul>
                                <?php
                                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $totalPages = 10; // Replace with the actual total number of pages

                                // Previous button
                                if ($currentPage > 1) {
                                    echo '<li><a href="?page=' . ($currentPage - 1) . '"><i class="fas fa-chevron-left"></i></a></li>';
                                } else {
                                    echo '<li class="disabled"><a><i class="fas fa-chevron-left"></i></a></li>';
                                }

                                // Page numbers
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    if ($i == $currentPage) {
                                        echo '<li><a href="#" class="active">' . $i . '</a></li>';
                                    } else {
                                        echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
                                    }
                                }

                                // Next button
                                if ($currentPage < $totalPages) {
                                    echo '<li><a href="?page=' . ($currentPage + 1) . '"><i class="fas fa-chevron-right"></i></a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                </section><!-- /Blog Pagination Section -->
            </div>

        </div>

    </main>

    <?= include 'Partials/footer.php' ?>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="fa fa-arrow-up"></i></a>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>