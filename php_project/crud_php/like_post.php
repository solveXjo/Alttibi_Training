<?php
session_start();
require_once 'config.php';
require_once 'Database.php';
require_once 'models/PostRepository.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

if (!isset($_POST['post_id']) || !is_numeric($_POST['post_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid post ID']);
    exit();
}

$db = new Database(require 'config.php');
$postRepo = new PostRepository($db);

$response = $postRepo->toggleLike($_SESSION['user_id'], (int)$_POST['post_id']);
echo json_encode($response);