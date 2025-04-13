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
    public function hasUserLikedPost($userId, $postId) {
        $query = "SELECT COUNT(*) FROM post_likes WHERE user_id = :user_id AND post_id = :post_id";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['user_id' => $userId, 'post_id' => $postId]);
        return $stmt->fetchColumn() > 0;
    }
    
    public function addLike($userId, $postId) {
        $query = "INSERT INTO post_likes (user_id, post_id) VALUES (:user_id, :post_id)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['user_id' => $userId, 'post_id' => $postId]);
        
        $query = "UPDATE posts SET likes = likes + 1 WHERE id = :post_id";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['post_id' => $postId]);
    }
    
    public function removeLike($userId, $postId) {
        $query = "DELETE FROM post_likes WHERE user_id = :user_id AND post_id = :post_id";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['user_id' => $userId, 'post_id' => $postId]);
        
        $query = "UPDATE posts SET likes = likes - 1 WHERE id = :post_id";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['post_id' => $postId]);
    }
    
    public function toggleLike($userId, $postId) {
        // Start transaction
        $this->db->connection->beginTransaction();
        
        try {
            // Check current like status
            $stmt = $this->db->connection->prepare("SELECT liked FROM posts WHERE id = :post_id AND user_id = :user_id");
            $stmt->execute(['post_id' => $postId, 'user_id' => $userId]);
            $currentStatus = $stmt->fetchColumn();
            
            // Toggle like status
            $newStatus = $currentStatus ? 0 : 1;
            $likeChange = $newStatus ? 1 : -1;
            
            // Update post
            $stmt = $this->db->connection->prepare("UPDATE posts SET liked = :liked, likes = likes + :like_change WHERE id = :post_id");
            $stmt->execute([
                'liked' => $newStatus,
                'like_change' => $likeChange,
                'post_id' => $postId
            ]);
            
            $this->db->connection->commit();
            
            return [
                'success' => true,
                'liked' => $newStatus,
                'likes' => $this->getLikeCount($postId)
            ];
        } catch (Exception $e) {
            $this->db->connection->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    public function getLikeCount($postId) {
        $query = "SELECT likes FROM posts WHERE id = :post_id";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute(['post_id' => $postId]);
        return $stmt->fetchColumn();
    }
}