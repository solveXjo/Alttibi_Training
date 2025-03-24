<?php
session_start();
require '../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($name) || empty($age) || empty($email) || empty($password)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: ../public/index.php");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format!";
                header("Location: ../public/index.php");
                exit();
            }

            if ($this->userModel->findUserByEmail($email)) {
                $_SESSION['error'] = "This email is already registered.";
                header("Location: ../public/index.php");
                exit();
            }

            if (isset($_FILES['fileToUpload'])) {
                $file = $_FILES['fileToUpload'];
                $fileNameNew = $this->userModel->uploadImage($file);

                if (!$fileNameNew) {
                    $_SESSION['error'] = "File upload failed.";
                    header("Location: ../public/index.php");
                    exit();
                }
            }

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $this->userModel->createUser($name, $age, $email, $passwordHash, $fileNameNew);

            $_SESSION['success'] = "Signup successful! Please login.";
            header("Location: ../public/login.php");
            exit();
        }

        require '../app/views/auth/signup.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "All fields are required!";
                header("Location: ../public/login.php");
                exit();
            }

            $user = $this->userModel->findUserByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                $_SESSION['error'] = "Invalid email or password!";
                header("Location: ../public/login.php");
                exit();
            }
            $_SESSION['user_id'] = $user['id'];
            header("Location: Home.php");
            exit();
        }

        require '../app/views/auth/login.php';
    }
}
