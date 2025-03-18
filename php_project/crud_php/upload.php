<?php

require 'config.php';
require_once 'Database.php';

$db = new Database(require 'config.php');

if (isset($_POST['submit'])) {
    // Validate file upload
    if (!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
        die("Error: No file uploaded or upload failed.");
    }

    $file = $_FILES['fileToUpload'];
    $filename = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileSize = $file['size'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($fileActualExt, $allowed)) {
        echo "You can't upload files of this type.";
        exit();
    } 
    
    else {
        if ($fileError !== 0) {
            echo "There was an error!";
            exit();
        } 
        
        else {
            $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
            $fileDestination = 'uploads/' . $fileNameNew;

            $name = $_POST['name'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $password = $_POST['password'];
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

            $mediaQuery = "INSERT INTO media (user_id, image_path) VALUES (:user_id, :image_path)";
            $mediaStmt = $db->connection->prepare($mediaQuery);
            $mediaStmt->execute([
                'user_id' => $userId,
                'image_path' => $fileNameNew
            ]);

            move_uploaded_file($fileTmpName, $fileDestination);

            header('Location: Login.php');
            exit();
        }
    }
}