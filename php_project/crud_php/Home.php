<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
require 'config.php';
require_once 'Database.php';

$db = new Database(require 'config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("Error: You must be logged in to post.");
    }

    $caption = ($_POST['caption']);
    $user_id = $_SESSION['user_id']; 
     $name= ($_POST['name']);

    if($caption === ''){
        header("Location: Home.php");
        exit();
    }
    $query = "SELECT name FROM users WHERE id = :user_id";
    $stmt = $db->connection->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch();


    $name = $user['name'];

    $query = "INSERT INTO posts (user_id, name, caption, likes, created_at) VALUES (:user_id, :name, :caption, 0, NOW())";
    $stmt = $db->connection->prepare($query);

    $stmt->execute([
        'user_id' => $user_id,
        'name' => $name,
        'caption' => $caption,
       
    ]);

    header("Location: ../../Posts.php");
    exit();


}

require 'Home.view.php';