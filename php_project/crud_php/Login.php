<?php
session_start();
require 'config.php';
require 'Database.php';

$db = new Database(require 'config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $emailErr = $passErr = "";

    if(empty($_POST['email'])){
        $emailErr = "Email is required";
    }
    else{
        $email = $_POST['email'];
    }

    if(empty($_POST['password'])){
        $passErr = "Password is required";
    }
    else{
        $password = $_POST['password'];
    }

        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->connection->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            header("Location: Home.php");
            exit();
        } else {
            echo "Invalid email or password!";
        }
    
}

require 'Login.view.php';
?>