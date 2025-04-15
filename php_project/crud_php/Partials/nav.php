<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'Partials/head.php' ?>

</head>
<body>



<header id="header" class="header position-relative">
  <div class="container-fluid container-xl position-relative">

    <div class="top-row d-flex align-items-center justify-content-between">
      <a href="/home" class="logo d-flex align-items-end">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Altibbi</h1><span>.</span>
      </a>

      <div class="d-flex align-items-center">
        <div class="social-links">
          <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
          <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
          <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        </div>


      </div>
    </div>

  </div>

  <div class="nav-wrap">
    <div class="container d-flex justify-content-center position-relative">
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/home" class="active">Home</a></li>
          <li><a href="/about">About</a></li>
          <li><a href="category.html">Category</a></li>
          <li><a href="blog-details.html">Blog Details</a></li>
          <li><a href="author-profile.html">Author Profile</a></li>
          <li class="dropdown"><a href="#"><span>Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="about.html">About</a></li>
              <li><a href="category.html">Category</a></li>
              <li><a href="blog-details.html">Blog Details</a></li>
              <li><a href="/posts">Posts</a></li>
              <li><a href="search-results.html">Search Results</a></li>

              <li><a href="/profile">Profile</a></li>

              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </div>

  </header>

</body>
</html>