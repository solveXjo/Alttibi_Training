<?php

require "controllers/Home.php";
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





    <script>
        function adjustTextareaHeight(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';

            const postBtn = document.querySelector('.post-btn');
            postBtn.disabled = textarea.value.trim() === '' && !document.querySelector('.media-preview-container').classList.contains('d-block');
        }

        function previewMedia(input) {
            const previewContainer = document.querySelector('.media-preview-container');
            const preview = document.getElementById('mediaPreview');
            const postBtn = document.querySelector('.post-btn');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                    postBtn.disabled = document.querySelector('.textarea-auto').value.trim() === '' && false;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeMedia() {
            const previewContainer = document.querySelector('.media-preview-container');
            const fileInput = document.getElementById('mediaUpload');
            const postBtn = document.querySelector('.post-btn');

            previewContainer.classList.add('d-none');
            fileInput.value = '';
            postBtn.disabled = document.querySelector('.textarea-auto').value.trim() === '';
        }
    </script>




        


    <main class="main">

        <!-- Slider Section -->
        <section id="slider" class="slider section dark-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">

                    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "centeredSlides": true,
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "navigation": {
                                "nextEl": ".swiper-button-next",
                                "prevEl": ".swiper-button-prev"
                            }
                        }
                    </script>

                    <!-- Include Swiper JS -->
                    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

                    <!-- Initialize Swiper -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const swiperConfig = JSON.parse(document.querySelector('.swiper-config').textContent);
                            new Swiper('.init-swiper', swiperConfig);
                        });
                    </script>

                    <div class="swiper-wrapper">

                        <div class="swiper-slide" style="background-image: url('assets/img/post-slide-1.jpg');">
                            <div class="content">
                                <h2><a href="single-post.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.</p>
                            </div>
                        </div>

                        <div class="swiper-slide" style="background-image: url('assets/img/post-slide-2.jpg');">
                            <div class="content">
                                <h2><a href="single-post.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.</p>
                            </div>
                        </div>

                        <div class="swiper-slide" style="background-image: url('assets/img/post-slide-3.jpg');">
                            <div class="content">
                                <h2><a href="single-post.html">13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.</p>
                            </div>
                        </div>

                        <div class="swiper-slide" style="background-image: url('assets/img/post-slide-4.jpg');">
                            <div class="content">
                                <h2><a href="single-post.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia! Beatae minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime inventore repudiandae quidem necessitatibus rem atque.</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>

                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Slider Section -->

        <div class="container create-post-card card mb-4">
            <div class="m-3 p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Category Selector -->
                    <div class="mb-3">
                        <select id="category" name="category" class="form-select" required>
                            <option value="" disabled selected>Select a category</option>
                            <option value="gaming" <?= ($_POST['category'] ?? '') === 'gaming' ? 'selected' : '' ?>>Gaming</option>
                            <option value="entertainment" <?= ($_POST['category'] ?? '') === 'entertainment' ? 'selected' : '' ?>>Entertainment</option>
                            <option value="sports" <?= ($_POST['category'] ?? '') === 'sports' ? 'selected' : '' ?>>Sports</option>
                            <option value="health" <?= ($_POST['category'] ?? '') === 'health' ? 'selected' : '' ?>>Health</option>
                            <option value="education" <?= ($_POST['category'] ?? '') === 'education' ? 'selected' : '' ?>>Education</option>
                            <option value="Programming" <?= ($_POST['category'] ?? '') === 'Programming' ? 'selected' : '' ?>>Programming</option>
                            <option value="Lifestyle" <?= ($_POST['category'] ?? '') === 'Lifestyle' ? 'selected' : '' ?>>Lifestyle</option>
                            <option value="Tech" <?= ($_POST['category'] ?? '') === 'Tech' ? 'selected' : '' ?>>Tech</option>
                            <option value="Business" <?= ($_POST['category'] ?? '') === 'Business' ? 'selected' : '' ?>>Business</option>
                            <option value="others" <?= ($_POST['category'] ?? 'others') === 'others' ? 'selected' : '' ?>>Others</option>
                        </select>
                    </div>

                    <!-- Post Content -->
                    <div class="mb-3">
                        <textarea class="form-control post-input" name="caption" id="caption"
                            placeholder="Share your thoughts..." rows="3" required><?= htmlspecialchars($_POST['caption'] ?? '') ?></textarea>
                    </div>

                    <!-- Post Actions -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('imageUpload').click()">
                                <i class="fa fa-image"></i> Photo
                            </button>
                            <input type="file" id="imageUpload" name="image" class="d-none" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary post-button">Post</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Trending Category Section -->
        <section id="trending-category" class="trending-category section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="container" data-aos="fade-up">
                    <div class="row g-5">
                        <div class="col-lg-4">

                            <div class="post-entry lg">
                                <a href="blog-details.html"><img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
                                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                <h2><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                                <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil tempore odit ab minus eveniet praesentium, similique blanditiis molestiae ut saepe perspiciatis officia nemo, eos quae cumque. Accusamus fugiat architecto rerum animi atque eveniet, quo, praesentium dignissimos</p>

                                <div class="d-flex align-items-center author">
                                    <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                                    <div class="name">
                                        <h3 class="m-0 p-0">Cameron Williamson</h3>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-8">
                            <div class="row g-5">
                                <div class="col-lg-4 border-start custom-border">
                                    <div class="post-entry">
                                        <a href="blog-details.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                        <h2><a href="blog-details.html">Let’s Get Back to Work, New York</a></h2>
                                    </div>
                                    <div class="post-entry">
                                        <a href="blog-details.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">Food</span> <span class="mx-1">•</span> <span>Jul 17th '22</span></div>
                                        <h2><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                                    </div>
                                    <div class="post-entry">
                                        <a href="blog-details.html"><img src="assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">Design</span> <span class="mx-1">•</span> <span>Mar 15th '22</span></div>
                                        <h2><a href="blog-details.html">Why Craigslist Tampa Is One of The Most Interesting Places On the Web?</a></h2>
                                    </div>
                                </div>
                                <div class="col-lg-4 border-start custom-border">
                                    <div class="post-entry">
                                        <a href="blog-details.html"><img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                        <h2><a href="blog-details.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
                                    </div>
                                    <div class="post-entry">
                                        <a href="blog-details.html"><img src="assets/img/post-landscape-6.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">Tech</span> <span class="mx-1">•</span> <span>Mar 1st '22</span></div>
                                        <h2><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                                    </div>
                                    <div class="post-entry">
                                        <a href="blog-details.html"><img src="assets/img/post-landscape-8.jpg" alt="" class="img-fluid"></a>
                                        <div class="post-meta"><span class="date">Travel</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                        <h2><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                                    </div>
                                </div>


   


                                <!-- Trending Section -->
                                <?php if (!empty($mostLikedPosts)): ?>
                                <div class="col-lg-4">

                                    <div class="trending">
                                        <h3>Trending</h3>
                                        <ul class="trending-post">
                                            <?php foreach ($mostLikedPosts as $index => $post): ?>
                                            <li>
                                                <a href="#">
                                                    <span class="number"><?= $index + 1 ?></span>
                                                    <h3><?= htmlspecialchars($post['caption']) ?></h3>
                                                    <span class="author"><?= htmlspecialchars($post['name']) ?></span>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                </div> <!-- End Trending Section -->
                                <?php endif; ?>
                            </div>
                        </div>

                    </div> <!-- End .row -->
                </div>

            </div>

        </section><!-- /Trending Category Section -->

        <!-- Culture Category Section -->
        <section id="culture-category" class="culture-category section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    <h2>Culture</h2>
                    <p><a href="categories.html">See All Culture</a></p>
                </div>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-md-9">

                        <div class="d-lg-flex post-entry">
                            <a href="blog-details.html" class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                <img src="assets/img/post-landscape-6.jpg" alt="" class="img-fluid">
                            </a>
                            <div>
                                <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                <h3><a href="blog-details.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
                                <div class="d-flex align-items-center author">
                                    <div class="photo"><img src="assets/img/person-2.jpg" alt="" class="img-fluid"></div>
                                    <div class="name">
                                        <h3 class="m-0 p-0">Wade Warren</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="post-list border-bottom">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>

                                <div class="post-list">
                                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Culture Category Section -->

        <!-- Business Category Section -->
        <section id="business-category" class="business-category section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    <h2>Business</h2>
                    <p><a href="categories.html">See All Business</a></p>
                </div>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row">
                    <div class="col-md-9 order-md-2">

                        <div class="d-lg-flex post-entry">
                            <a href="blog-details.html" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
                                <img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid">
                            </a>
                            <div>
                                <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                <h3><a href="blog-details.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
                                <div class="d-flex align-items-center author">
                                    <div class="photo"><img src="assets/img/person-4.jpg" alt="" class="img-fluid"></div>
                                    <div class="name">
                                        <h3 class="m-0 p-0">Wade Warren</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="post-list border-bottom">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>

                                <div class="post-list">
                                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                    <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Business</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Business Category Section -->

        <!-- Lifestyle Category Section -->
        <section id="lifestyle-category" class="lifestyle-category section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <div class="section-title-container d-flex align-items-center justify-content-between">
                    <h2>Lifestyle</h2>
                    <p><a href="categories.html">See All Lifestyle</a></p>
                </div>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="post-list lg">
                            <a href="blog-details.html"><img src="assets/img/post-landscape-8.jpg" alt="" class="img-fluid"></a>
                            <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2><a href="blog-details.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
                            <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil tempore odit ab minus eveniet praesentium, similique blanditiis molestiae ut saepe perspiciatis officia nemo, eos quae cumque. Accusamus fugiat architecto rerum animi atque eveniet, quo, praesentium dignissimos</p>

                            <div class="d-flex align-items-center author">
                                <div class="photo"><img src="assets/img/person-7.jpg" alt="" class="img-fluid"></div>
                                <div class="name">
                                    <h3 class="m-0 p-0">Esther Howard</h3>
                                </div>
                            </div>
                        </div>

                        <div class="post-list border-bottom">
                            <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                        <div class="post-list">
                            <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                            <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                            <span class="author mb-3 d-block">Jenny Wilson</span>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <div class="row g-5">
                            <div class="col-lg-4 border-start custom-border">
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-6.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2><a href="blog-details.html">Let’s Get Back to Work, New York</a></h2>
                                </div>
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 17th '22</span></div>
                                    <h2><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                                </div>
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-4.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Mar 15th '22</span></div>
                                    <h2><a href="blog-details.html">Why Craigslist Tampa Is One of The Most Interesting Places On the Web?</a></h2>
                                </div>
                            </div>
                            <div class="col-lg-4 border-start custom-border">
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2><a href="blog-details.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
                                </div>
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Mar 1st '22</span></div>
                                    <h2><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                                </div>
                                <div class="post-list">
                                    <a href="blog-details.html"><img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2><a href="blog-details.html">5 Great Startup Tips for Female Founders</a></h2>
                                </div>
                            </div>
                            <div class="col-lg-4">

                                <div class="post-list border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-list border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-list border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">9 Half-up/half-down Hairstyles for Long and Medium Hair</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-list border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">Life Insurance And Pregnancy: A Working Mom’s Guide</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-list border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">The Best Homemade Masks for Face (keep the Pimples Away)</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                                <div class="post-list border-bottom">
                                    <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">•</span> <span>Jul 5th '22</span></div>
                                    <h2 class="mb-2"><a href="blog-details.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                                    <span class="author mb-3 d-block">Jenny Wilson</span>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Lifestyle Category Section -->

    </main>


    <?php include 'Partials/footer.php'; ?>

</body>

</html>