<?php
session_start();

require 'models/UserRepository.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once "config.php";

require_once "Database.php";
$db = new Database(require 'config.php');
$userRepo = new UserRepository($db);
$userId = $_SESSION['user_id'];

// Initialize variables
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_account'])) {
        // Handle account deletion
        if ($userRepo->deleteUser($userId)) {
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            $error = "Failed to delete account.";
        }
    } 


    elseif (isset($_POST['change_password'])) {
        $newPassword = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
    if ($newPassword !== $confirmPassword) {
            $error = "New passwords do not match.";
        } else {
            if ($userRepo->changePassword($userId, $newPassword)) {
                $success = "Password updated successfully!";
            } else {
                $error = "Current password is incorrect.";
            }
        }
    }


    else {
        $name = trim($_POST['name'] ?? '');
        $age = trim($_POST['age'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $bio = trim($_POST['bio'] ?? '');
        $location = trim($_POST['location'] ?? '');

        if (!$name || !$age || !$email) {
            $error = "Name, age, and email are required fields.";
        } else {
            try {
                // Update basic user info
                $userRepo->updateUser($userId, $name, $age, $email, null, $bio, $location);

                // Handle image upload if provided
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $file = $_FILES['image'];
                    $fileName = basename($file['name']);
                    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $maxFileSize = 5 * 1024 * 1024; // 5MB

                    if (!in_array($fileExt, $allowedExtensions)) {
                        $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
                    } elseif ($file['size'] > $maxFileSize) {
                        $error = "File size must be less than 5MB.";
                    } else {
                        $newFileName = uniqid('', true) . '.' . $fileExt;
                        $uploadDir = 'uploads/';

                        // Create uploads directory if it doesn't exist
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        if (move_uploaded_file($file['tmp_name'], "{$uploadDir}{$newFileName}")) {
                            // Delete old image if it exists and isn't the default
                            $oldImage = $userRepo->getUserImage($userId);
                            if ($oldImage && $oldImage !== 'default.png' && file_exists("{$uploadDir}{$oldImage}")) {
                                unlink("{$uploadDir}{$oldImage}");
                            }

                            $userRepo->updateImage($userId, $newFileName);
                        } else {
                            $error = "Failed to upload image.";
                        }
                    }
                }

                $success = "Profile updated successfully!";
            } catch (Exception $e) {
                $error = "An error occurred: " . $e->getMessage();
            }
        }
    }

    // Refresh user data
    $user = $userRepo->getUserById($userId);

    // Store messages in session for redirect
    $_SESSION['profile_update_success'] = $success;
    $_SESSION['profile_update_error'] = $error;
    header("Location: profile.php");
    exit();
}

// Check for messages from redirect
if (isset($_SESSION['profile_update_success'])) {
    $success = $_SESSION['profile_update_success'];
    unset($_SESSION['profile_update_success']);
}
if (isset($_SESSION['profile_update_error'])) {
    $error = $_SESSION['profile_update_error'];
    unset($_SESSION['profile_update_error']);
}

$user = $userRepo->getUserById($userId);
require 'profile.view.php';