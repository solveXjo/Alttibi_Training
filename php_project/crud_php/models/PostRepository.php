<?php

class PostRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $query = "SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function incrementLikes($postId) {
        $query = "SELECT liked FROM posts WHERE id = ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([$postId]);
        $currentStatus = $stmt->fetchColumn();

        $newStatus = $currentStatus ? 0 : 1;

        $query = "UPDATE posts SET likes = likes + ?, liked = ? WHERE id = ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([
            $newStatus ? 1 : -1, 
            $newStatus, 
            $postId
        ]);
    }

    public function removePost($postId) {
        $stmt = $this->db->connection->prepare("DELETE FROM comments WHERE post_id = ?");
        $stmt->execute([$postId]);

        $stmt = $this->db->connection->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$postId]);

        return $stmt->rowCount() > 0; 
    }

    public function addComment($postId, $userId, $comment, $parentId = null) {
        $query = "INSERT INTO comments (post_id, user_id, comment, parent_comment_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([$postId, $userId, $comment, $parentId]);
        return $stmt->rowCount() > 0;
    }

    public function getAllComments($postId) {
        $query = "SELECT comments.*, users.name from comments INNER JOIN users on comments.user_id = users.id where post_id = ? ORDER BY created_at desc";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateComment($commentId, $newText) {
        $query = "UPDATE comments SET comment = ? WHERE id = ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([$newText, $commentId]);
        return $stmt->rowCount() > 0;
    }

    public function deleteComment($commentId) {
        $query = "DELETE FROM comments WHERE id = ? OR parent_comment_id = ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([$commentId, $commentId]);
        return $stmt->rowCount() > 0;
    }
    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getMostLikedPosts($limit = 2) {
        $query = "SELECT * from posts ORDER BY likes DESC LIMIT ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}