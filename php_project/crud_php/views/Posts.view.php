<?php
session_start();
require 'controllers/Posts.php'; 

?>

<title>Posts</title>

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
        }).always(function() {
          $button.prop('disabled', false);
        });
      });
    });
  </script>
</head>


<body>
  <?php require 'Partials/nav.php'; ?>
  <?php include 'Partials/pageTitle.php'; ?>




  <main class="main">
    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article ">

                <div class="post-img">
                  <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                </div>

                <h2 class="title">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia</h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="fa fa-user"></i> <a href="blog-details.html">John Doe</a></li>
                    <li class="d-flex align-items-center"><i class="fa fa-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">Jan 1, 2022</time></a></li>
                    <li class="d-flex align-items-center"><i class="fa fa-comments"></i> <a href="blog-details.html">12 Comments</a></li>
                  </ul>
                </div>

                <div class="content">
                  <p>
                    Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                    Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.
                  </p>

                  <p>
                    Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate.
                  </p>

                  <blockquote>
                    <p>
                      Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.
                    </p>
                  </blockquote>

                  <p>
                    Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat.
                    Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque.
                    Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.
                  </p>

                  <h3>Et quae iure vel ut odit alias.</h3>
                  <p>
                    Officiis animi maxime nulla quo et harum eum quis a. Sit hic in qui quos fugit ut rerum atque. Optio provident dolores atque voluptatem rem excepturi molestiae qui. Voluptatem laborum omnis ullam quibusdam perspiciatis nulla nostrum. Voluptatum est libero eum nesciunt aliquid qui.
                    Quia et suscipit non sequi. Maxime sed odit. Beatae nesciunt nesciunt accusamus quia aut ratione aspernatur dolor. Sint harum eveniet dicta exercitationem minima. Exercitationem omnis asperiores natus aperiam dolor consequatur id ex sed. Quibusdam rerum dolores sint consequatur quidem ea.
                    Beatae minima sunt libero soluta sapiente in rem assumenda. Et qui odit voluptatem. Cum quibusdam voluptatem voluptatem accusamus mollitia aut atque aut.
                  </p>
                  <img src="assets/img/blog/blog-inside-post.jpg" class="img-fluid" alt="">

                  <h3>Ut repellat blanditiis est dolore sunt dolorum quae.</h3>
                  <p>
                    Rerum ea est assumenda pariatur quasi et quam. Facilis nam porro amet nostrum. In assumenda quia quae a id praesentium. Quos deleniti libero sed occaecati aut porro autem. Consectetur sed excepturi sint non placeat quia repellat incidunt labore. Autem facilis hic dolorum dolores vel.
                    Consectetur quasi id et optio praesentium aut asperiores eaque aut. Explicabo omnis quibusdam esse. Ex libero illum iusto totam et ut aut blanditiis. Veritatis numquam ut illum ut a quam vitae.
                  </p>
                  <p>
                    Alias quia non aliquid. Eos et ea velit. Voluptatem maxime enim omnis ipsa voluptas incidunt. Nulla sit eaque mollitia nisi asperiores est veniam.
                  </p>

                </div><!-- End post content -->

                <div class="meta-bottom">
                  <i class="fa fa-folder"></i>
                  <ul class="cats">
                    <li><a href="#">Business</a></li>
                  </ul>

                  <i class="fa fa-tags"></i>
                  <ul class="tags">
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul>
                </div><!-- End meta bottom -->

              </article>

            </div>
          </section><!-- /Blog Details Section -->

          <section id="blog-details" class="blog-details section">
            <div class="container">
              <?php if (count($posts) > 0) : ?>
                <?php foreach ($posts as $post) : ?>
                  <article class="article p-5 mb-3">
                    <?php if (!empty($post['image_path'])) : ?>
                      <div class="post-img">
                        <img src="<?= $post['image_path'] ?>" alt="Post image" class="img-fluid">
                      </div>
                    <?php endif; ?>

                    <h2 class="title"><?= htmlspecialchars($post['caption']) ?></h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center">
                          <i class="fa fa-user"></i>
                          <a href="#"><?= htmlspecialchars($post['name']) ?></a>
                        </li>
                        <li class="d-flex align-items-center">
                          <i class="fa fa-clock"></i>
                          <a href="#"><time datetime="<?= date('Y-m-d', strtotime($post['created_at'])) ?>">
                              <?= date('F j, Y', strtotime($post['created_at'])) ?>
                            </time></a>
                        </li>
                        <li class="d-flex align-items-center">
                          <i class="fa fa-thumbs-up"></i>
                          <a href="#"><span class="like-count"><?= $post['likes'] ?></span> Likes</a>
                        </li>
                      </ul>
                    </div>

                    <!-- Post actions with your working like functionality -->
                    <div class="post-actions" style="margin-top: 20px;">
                      <button type="button" class="btn btn-outline-primary action-btn like-btn" data-post-id="<?= $post['id'] ?>">
                        <i class="fa fa-thumbs-up <?= $post['liked'] ? 'liked' : '' ?>"></i> Like
                      </button>
                      <a href="comment.php?post_id=<?= $post['id'] ?>" class="btn btn-outline-secondary">
                        <i class="fa fa-comment"></i> Comment
                      </a>

                      <?php if ($post['user_id'] == ($_SESSION['user_id'] ?? null)) : ?>
                        <form method="post" action="/posts" style="display:inline;">
                          <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                          <button type="submit" name="delete_post" class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure you want to delete this post?');">
                            <i class="fa fa-trash"></i> Delete
                          </button>
                        </form>
                      <?php endif; ?>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section mt-4">
                      <?php if (!empty($post['comments'])) : ?>
                        <h4>Comments</h4>
                        <?php foreach ($post['comments'] as $comment) : ?>
                          <div class="card mb-2">
                            <div class="card-body">
                              <h6 class="card-subtitle mb-2 text-muted">
                                <?= htmlspecialchars($comment['name']) ?>
                                <small class="text-muted"><?= date('M j, Y', strtotime($comment['created_at'])) ?></small>
                              </h6>
                              <p class="card-text"><?= htmlspecialchars($comment['text']) ?></p>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php endif; ?>

                      <form method="post" action="/comment" class="mt-3">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <div class="input-group">
                          <textarea name="comment" class="form-control" placeholder="Write a comment..." rows="1" required></textarea>
                          <button type="submit" name="submit" class="btn btn-primary">Post</button>
                        </div>
                      </form>
                    </div>
                  </article>
                <?php endforeach; ?>
              <?php else : ?>
                <div class="no-posts">
                  <i class="fa fa-newspaper-o" style="font-size: 60px; margin-bottom: 15px;"></i>
                  <h3>No posts yet</h3>
                  <p>When you or your friends share something, it will appear here.</p>
                </div>
              <?php endif; ?>
            </div>
          </section>



          <!-- Blog Comments Section -->
          <section id="blog-comments" class="blog-comments section">

            <div class="container">

              <h4 class="comments-count">8 Comments</h4>

              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/comments-1.jpg" alt=""></div>
                  <div>
                    <h5><a href="">Georgia Reader</a> <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan,2022</time>
                    <p>
                      Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad aut sapiente quis molestiae est qui cum soluta.
                      Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis et.
                    </p>
                  </div>
                </div>
              </div><!-- End comment #1 -->

              <div id="comment-2" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/comments-2.jpg" alt=""></div>
                  <div>
                    <h5><a href="">Aron Alvarado</a> <a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan,2022</time>
                    <p>
                      Ipsam tempora sequi voluptatem quis sapiente non. Autem itaque eveniet saepe. Officiis illo ut beatae.
                    </p>
                  </div>
                </div>

                <div id="comment-reply-1" class="comment comment-reply">
                  <div class="d-flex">
                    <div class="comment-img"><img src="assets/img/blog/comments-3.jpg" alt=""></div>
                    <div>
                      <h5><a href="">Lynda Small</a> <a href="#" class="reply"><i class="fa fa-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01">01 Jan,2022</time>
                      <p>
                        Enim ipsa eum fugiat fuga repellat. Commodi quo quo dicta. Est ullam aspernatur ut vitae quia mollitia id non. Qui ad quas nostrum rerum sed necessitatibus aut est. Eum officiis sed repellat maxime vero nisi natus. Amet nesciunt nesciunt qui illum omnis est et dolor recusandae.

                        Recusandae sit ad aut impedit et. Ipsa labore dolor impedit et natus in porro aut. Magnam qui cum. Illo similique occaecati nihil modi eligendi. Pariatur distinctio labore omnis incidunt et illum. Expedita et dignissimos distinctio laborum minima fugiat.

                        Libero corporis qui. Nam illo odio beatae enim ducimus. Harum reiciendis error dolorum non autem quisquam vero rerum neque.
                      </p>
                    </div>
                  </div>

                  <div id="comment-reply-2" class="comment comment-reply">
                    <div class="d-flex">
                      <div class="comment-img"><img src="assets/img/blog/comments-4.jpg" alt=""></div>
                      <div>
                        <h5><a href="">Sianna Ramsay</a> <a href="#" class="reply"><i class="fa fa-reply-fill"></i> Reply</a></h5>
                        <time datetime="2020-01-01">01 Jan,2022</time>
                        <p>
                          Et dignissimos impedit nulla et quo distinctio ex nemo. Omnis quia dolores cupiditate et. Ut unde qui eligendi sapiente omnis ullam. Placeat porro est commodi est officiis voluptas repellat quisquam possimus. Perferendis id consectetur necessitatibus.
                        </p>
                      </div>
                    </div>

                  </div><!-- End comment reply #2-->

                </div><!-- End comment reply #1-->

              </div><!-- End comment #2-->

              <div id="comment-3" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/comments-5.jpg" alt=""></div>
                  <div>
                    <h5><a href="">Nolan Davidson</a> <a href="#" class="reply"><i class="fa fa-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan,2022</time>
                    <p>
                      Distinctio nesciunt rerum reprehenderit sed. Iste omnis eius repellendus quia nihil ut accusantium tempore. Nesciunt expedita id dolor exercitationem aspernatur aut quam ut. Voluptatem est accusamus iste at.
                      Non aut et et esse qui sit modi neque. Exercitationem et eos aspernatur. Ea est consequuntur officia beatae ea aut eos soluta. Non qui dolorum voluptatibus et optio veniam. Quam officia sit nostrum dolorem.
                    </p>
                  </div>
                </div>

              </div><!-- End comment #3 -->

              <div id="comment-4" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/comments-6.jpg" alt=""></div>
                  <div>
                    <h5><a href="">Kay Duggan</a> <a href="#" class="reply"><i class="fa fa-reply-fill"></i> Reply</a></h5>
                    <time datetime="2020-01-01">01 Jan,2022</time>
                    <p>
                      Dolorem atque aut. Omnis doloremque blanditiis quia eum porro quis ut velit tempore. Cumque sed quia ut maxime. Est ad aut cum. Ut exercitationem non in fugiat.
                    </p>
                  </div>
                </div>

              </div><!-- End comment #4 -->

            </div>

          </section><!-- /Blog Comments Section -->

          <!-- Comment Form Section -->
          <section id="comment-form" class="comment-form section">
            <div class="container">



            </div>
          </section><!-- /Comment Form Section -->

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Blog Author Widget -->
            <div class="blog-author-widget widget-item">

              <div class="d-flex flex-column align-items-center">
                <div class="d-flex align-items-center w-100">
                  <img src="assets/img/blog/blog-author.jpg" class="rounded-circle flex-shrink-0" alt="" style="    max-width: 120px;
    margin-right: 20px;">
                  <div>
                    <h4>Jane Smith</h4>
                    <div class="social-links">
                      <a href="https://x.com/#" class="m-1"><i class="fab fa-twitter"></i></a>
                      <a href="https://facebook.com/#" class="m-1"><i class="fab fa-facebook-f"></i></a>
                      <a href="https://instagram.com/#" class="m-1"><i class="fab fa-instagram"></i></a>
                      <a href="https://linkedin.com/#" class="m-1"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                  </div>
                </div>

                <p>
                  Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                </p>

              </div>

            </div><!--/Blog Author Widget -->

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="fa fa-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item mt-5">
              <h3 class="widget-title">Recent Posts</h3>
              <?php foreach ($getMostRecentPosts as $recent) : ?>
              <div class="post-item d-flex align-items-center mb-3">
                <?php if (!empty($recent['image_path'])) : ?>
                <img src="<?= htmlspecialchars($recent['image_path']) ?>" alt="Recent post image" class="flex-shrink-0 rounded">
                <?php endif; ?>
                <div>
                <h4 class="mb-1">
                  <a href="blog-details.html"><?= htmlspecialchars($recent["caption"]) ?></a>
                </h4>
                <time datetime="<?= htmlspecialchars($recent["created_at"]) ?>">
                  <?= date('F j, Y', strtotime($recent["created_at"])) ?>
                </time>
                </div>
              </div><!-- End recent post item -->
              <?php endforeach; ?>
            </div><!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item mt-5">

              <h3 class="widget-title">Tags</h3>
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!--/Tags Widget -->

          </div>

        </div>

      </div>
    </div>

  </main>

  <?php require 'Partials/footer.php'; ?>

</body>

</html>