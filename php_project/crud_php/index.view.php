<?php
session_start();
require_once 'config.php';
require_once 'Database.php';


$config = include 'config.php';
$db = new Database($config);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($name) || empty($age) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: index.php");
        exit();
    }

    
    $name = 'name';
    $age = 'age';
    $email = 'email';
    $password = $_POST['password'];

 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format!";
        header("Location: index.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->connection->prepare($query);
    $stmt->execute(['email' => $email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "This email is already registered.";
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['submit'])) {
        if (!isset($_FILES['fileToUpload']) || $_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
            die("Error: No file uploaded or upload failed.");
        }
    
        $file = $_FILES['fileToUpload'];
        $filename = $file['name'];
    
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
    
        $filetype = $file['type'];
    
        $fileSize = $file['size'];
    
        // echo "Uploaded file: " . htmlspecialchars($filename);
    
        $fileExt = explode('.', $filename); // split a string by a string to take the extenstion of the file
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('jpg', 'png', 'jpeg');
    
        if(!in_array($fileActualExt, $allowed)){
          echo "you can't upload files from this type.";
        }
        else{
          if($fileError!==0){
            echo "there was an error!";
          }
          else{
            $fileNameNew = uniqid('', true). '.' .$fileActualExt;
            $fileDestination = 'uploads/' . $fileNameNew; 
    
            $query = "INSERT INTO users (image) VALUES (:image)";
            $stmt = $db->connection->prepare($query);
              
            $stmt->execute([
                ':image' => $fileNameNew,
            ]);
        
    
            move_uploaded_file($fileTmpName, $fileDestination); 
           // header('Location: index.php');
          }
        }
    }
    

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (name, age, email, password, image) VALUES (:name, :age, :email, :password, :image)";
    $stmt = $db->connection->prepare($query);
    $stmt->execute([
        'name' => $name,
        'age' => $age,
        'email' => $email,
        'password' => $passwordHash,
        'image' => $fileNameNew
    ]);

    $_SESSION['success'] = "Signup successful! Please login.";
    header("Location: Login.php");
    exit();
}
?>