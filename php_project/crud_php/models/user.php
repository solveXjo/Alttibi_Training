<?php
require '../../config/config.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database(require '../../config/config.php');
    }

    public function findUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function createUser($name, $age, $email, $password, $image) {
        $query = "INSERT INTO users (name, age, email, password, image) VALUES (:name, :age, :email, :password, :image)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([
            'name' => $name,
            'age' => $age,
            'email' => $email,
            'password' => $password,
            'image' => $image
        ]);
    }

    public function uploadImage($file) {
        $filename = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($fileActualExt, $allowed)) {
            return false;
        }

        if ($fileError !== 0) {
            return false;
        }

        $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
        $fileDestination = '../../uploads/' . $fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);

        return $fileNameNew;
    }
}