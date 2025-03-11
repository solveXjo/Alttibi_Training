<?php
session_start();
require 'config.php';
require 'Database.php';

$db = new Database(require 'config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "All fields are required!";
    } else {
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
}
?>