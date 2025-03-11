<?php
session_start(); 
require 'config.php';
require 'Database.php';
require 'UserRepository.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

$db = new Database(require 'config.php');
$userRepo = new UserRepository($db);
$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = ($_POST['name']);
    $age =  $_POST['age'];
    $email = ($_POST['email']);
    $password = $_POST['password'] ?? null;


    if (!$name || !$age || !$email) {
        $error = "All fields are required.";
    } else {
        $userRepo->updateUser($userId, $name, $age, $email, $password);
        $success = "Profile updated successfully!";
    
        $user = $userRepo->getUserById($userId);
    }
}
if (isset($_POST['delete_account'])) {
    $userRepo->deleteUser($userId);
    session_destroy();
    header("Location: index.php");
    exit();
}


$user = $userRepo->getUserById($userId);
?>

<?php require 'profile.view.php'; ?>