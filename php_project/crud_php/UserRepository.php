<?php
class UserRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserById($userId) {
        $query = "
            SELECT users.id, users.name, users.age, users.email, media.image_path 
            FROM users 
            LEFT JOIN media ON users.id = media.user_id 
            WHERE users.id = :id
        ";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $name, $age, $email, $password = null) {
        $query = "UPDATE users SET name = :name, age = :age, email = :email";
        $params = [':name' => $name, ':age' => $age, ':email' => $email];

        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query .= ", password = :password";
            $params[':password'] = $hashedPassword;
        }

        $query .= " WHERE id = :id";
        $params[':id'] = $userId;

        $this->db->query($query, $params);
    }

    public function updateImage($userId, $imagePath) {
        $query2 = "SELECT COUNT(*) FROM media WHERE user_id = :user_id";
        $stmt = $this->db->connection->prepare($query2);
        $stmt->execute(['user_id' => $userId]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            $query = "UPDATE media SET image_path = :image_path WHERE user_id = :user_id";
        } else {
            $query = "INSERT INTO media (user_id, image_path) VALUES (:user_id, :image_path)";
        }

        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['user_id' => $userId, 'image_path' => $imagePath]);
    }
}