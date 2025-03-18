<?php
class UserRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserById($userId) {
        $query = "SELECT id, name, age, email FROM users WHERE id = :id";
        $stmt = $this->db->query($query, [':id' => $userId]);
        return $stmt->fetch();
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


    public function updateImage($image){
        $query = "SELECT media set image_path = :image_path";
        $params = [':image_path' => $image_path];

        $query .= " WHERE id = :id";
        $params[':id'] = $userId;    


        $this->db->query($query, $params);

    }


    // public function deleteUser($userId) {
    // $this->db->query("DELETE from posts where user_id = :user_id", [':user_id'=>$userId]);

    //     $this->db->query("DELETE FROM comments WHERE user_id = :user_id", [':user_id' => $userId]);

    //     $this->db->query("DELETE FROM users WHERE id = :id", [':id' => $userId]);
    // }
}
