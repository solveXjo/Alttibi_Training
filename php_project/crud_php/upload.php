<?php

require 'config.php';
require_once 'Database.php';

$db = new Database(require 'config.php');

if (isset($_POST['submit'])) {
    // // Validate file upload
    // if (!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
    //     die("Error: No file uploaded or upload failed.");
    // }

    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $file = $_FILES['fileToUpload'];
    $filename = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileSize = $file['size'];

    $fileExt = explode('.', $filename);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = ['jpg', 'jpeg', 'png', ''];

    if (!in_array($fileActualExt, $allowed)) {
        echo '<script>alert("You can not upload files of this type.")</script>';
        exit();
    } 
    
    else {
        // if ($fileError !== 0) {
        //     echo "There was an error!";
        //     exit();
        // } 

    foreach(str_split($name) as $char){
        if(!preg_match("/^[a-zA-Z\s]+$/", $name)){
            echo '<script>alert("Name must contain only letters.")</script>';
            exit();
        }
    }    
    if($age < 18 || $age >80){
        echo '<script>alert("Age must be between 18 and 80.")</script>';
        exit();
    } 
    $emailquery = "SELECT * FROM users WHERE email = :email";
    $stmt2 = $db->connection->prepare($emailquery);
    $stmt2->execute(['email' => $email]);

    if ($stmt2->rowCount() > 0) {
        echo '<script>alert("This email is already registered.")</script>';
        // $_SESSION['error'] = "This email is already registered.";
        
        // header("Location: index.php");
        exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<script>alert("please write a valid email.")<script>';
        exit();
    }

            $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
            $fileDestination = 'uploads/' . $fileNameNew;


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

