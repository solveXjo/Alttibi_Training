<?php
require 'config.php';
require_once 'Database.php';
// require "PostRepository.php";
$db = new Database(require 'config.php');

$nameErr = $emailErr = $passwordErr = $ageErr = $imageErr = '';

$count = 0;
$name = $age = $email = $password = '';


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $file = $_FILES['fileToUpload'];
    $fileExt = '';

    if (empty($name)) {
        $nameErr = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $nameErr = "Name must contain only letters and spaces.";
    } else {
        $count++;
    }


    if (empty($age)) {
        $ageErr = "Age is required.";
    } elseif ($age < 18 || $age > 80) {
        $ageErr = "Age must be between 18 and 80.";
    } else {
        $count++;
    }

    if (empty($email)) {
        $emailErr = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format.";
    } elseif ((new PostRepository($db))->getUserByEmail($email)) {
        $emailErr = "Email already exists.";
    } else {
        $count++;
    }

    if (empty($password)) {
        $passwordErr = "Password is required.";
    } elseif (strlen($password) < 8) {
        $passwordErr = "Password must be at least 8 characters long.";
    } elseif (strlen($password) > 16) {
        $passwordErr = "password must be at mmost 16 char long";
    } else {
        $count++;
    }

    if ($count === 4) {
        header('Location: Login.php');
        exit();
    }

    if ($file['error'] == UPLOAD_ERR_OK) {

        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($fileExt, $allowed)) {
            $imageErr = "Only JPG, JPEG, and PNG files are allowed.";
        }
    }

    if (empty($nameErr) && empty($ageErr) && empty($emailErr) && empty($passwordErr) && empty($imageErr)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (name, age, email, password) VALUES (:name, :age, :email, :password)";
        $stmt = $db->connection->prepare($query);
        $stmt->execute([
            'name' => $name,
            'age' => $age,
            'email' => $email,
            'password' => $passwordHash
        ]);

        $userId = $db->connection->lastInsertId();

        $fileNameNew = uniqid('', true) . '.' . $fileExt;
        $fileDestination = 'uploads/' . $fileNameNew;

        if (move_uploaded_file($file['tmp_name'], $fileDestination)) {
            $mediaQuery = "INSERT INTO media (user_id, image_path) VALUES (:user_id, :image_path)";
            $mediaStmt = $db->connection->prepare($mediaQuery);
            $mediaStmt->execute([
                'user_id' => $userId,
                'image_path' => $fileNameNew
            ]);

            header('Location: Login.php');
            exit();
        }
    }
}
require 'index.view.php';
