<?php
$config = require 'config.php';
require 'Database.php';

// $db = new Database($config);
$uri = $_SERVER["REQUEST_URI"];

if($uri === "/" || $uri === "/index" || $uri == ""){
    require 'views/auth/index.view.php';
    exit();
}

else if($uri === "/posts"){
    require "controllers/Posts.php";
}

else if($uri === "/home"){
    require "controllers/Home.php";
}
else if($uri === "/profile"){
    require "profile.php";
}
else if($uri === "/Login"){
    require "views/auth/Login.view.php";
}
else if($uri === "/about"){
    require "controllers/about.php";
}
else if($uri === "/comment"){
    require "comment.php";
}
else if($uri === "/comment/edit"){
    if (isset($_POST['post_id'])) {
        $_GET['post_id'] = $_POST['post_id']; // Pass post_id to GET for use in comment.php
        require "comment.php?post_id=" . $_POST['post_id'];
    } else {
        echo "Error: post_id is not set.";
        exit();
    }
}
else if($uri == "/profile_edit"){
    require "profile_edit.php";
}

else if($uri === "/contact"){
    require "contact.php";
}
else{
    require 'views/auth/index.view.php';
    exit();
}



// header("Location: views/auth/index.view.php");
// exit();
