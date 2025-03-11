<?php

function dd($item){
    var_dump($item);
    echo "<pre>";
    var_dump($item);
    echo "</pre>";

    die();
}
$config = require 'config.php';

require "Database.php";
$db = new DataBase($config);

$id = $_GET['id'];

$query = "SELECT * FROM post WHERE id = ?";
$post = $db->query($query, [$id])->fetch();

dd($post);
