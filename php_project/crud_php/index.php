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
    require "Posts.php";
}

else if($uri === "/home"){
    require "Home.php";
}
else if($uri === "/profile"){
    require "profile.php";
}
else if($uri === "/Login"){
    require "views/auth/Login.view.php";
}
else{
    require 'views/auth/index.view.php';
    exit();
}

// header("Location: views/auth/index.view.php");
// exit();
