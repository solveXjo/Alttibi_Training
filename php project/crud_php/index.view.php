<?php
    require 'config.php';
    require 'Database.php';

    $db = new Database(require 'config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = ($_POST['name']);
        $age =  $_POST['age'];
        $email = ($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->connection->prepare($query);
        $stmt->execute(['email' => $email]);
        if (empty($name) || empty($age) || empty($email) || empty($_POST['password'])) {
            echo "All fields are required!";
        } 
        elseif ($stmt->rowCount() > 0) {
            echo "This email is already registered.";
        }
        else {
            $query = "INSERT INTO users (name, age, email, password) VALUES (:name, :age, :email, :password)";
            $stmt = $db->connection->prepare($query);
            $stmt->execute([
                'name' => $name,
                'age' => $age,
                'email' => $email,
                'password' => $password
            ]);
            header("Location: Login.php");
            exit();

        }


    }
?>