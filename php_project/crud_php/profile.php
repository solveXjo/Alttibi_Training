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
    $name = trim($_POST['name']);
    $age = trim($_POST['age']);
    $email = trim($_POST['email']);
    $password = $_POST['password'] ?? null;

    if (!$name || !$age || !$email) {
        $error = "All fields are required.";
    } else {
        $userRepo->updateUser($userId, $name, $age, $email, $password);

        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            $fileName = basename($file['name']);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExt, $allowedExtensions)) {
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $uploadDir = 'uploads/';
                $fileDestination = $uploadDir . $newFileName;

                if (move_uploaded_file($file['tmp_name'], $fileDestination)) {
                    $userRepo->updateImage($userId, $newFileName);
                    $success = "Profile updated successfully!";
                } 
                else $error = "Failed to upload image.";    
                
            }
        }
        else $success = "Profile updated successfully!";
        

        $user = $userRepo->getUserById($userId);
    }
}

$user = $userRepo->getUserById($userId);
?>

<?php require 'profile.view.php'; ?>