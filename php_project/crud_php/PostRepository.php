<?php
class PostRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $query = "SELECT * from posts order by id desc";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function incrementLikes($postId) {
        $query = "SELECT liked from posts WHERE id = :id";
        $result = $this->db->query($query, [':id' => $postId]);
        $currentStatus = $result->fetchColumn();
    
        $newStatus = $currentStatus ? 0 : 1;
    
        $query = "UPDATE posts set likes = likes + :increment, liked = :liked WHERE id = :id";
        $this->db->query($query, [
            ':increment' => $newStatus ? 1 : -1,
            ':liked' => $newStatus,
            ':id' => $postId
        ]);
    }
    public function addComment($postId, $userId, $comment) {
        $query = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
        $stmt = $this->db->connection->prepare($query);
        $stmt->execute([$postId, $userId, $comment]);
        return $stmt->rowCount() > 0;
    }

    public function getAllComments($postId) {
        $stmt = $this->db->connection->prepare("
            SELECT comments.*, users.name 
            FROM comments 
            INNER JOIN users ON comments.user_id = users.id 
            WHERE post_id = ?
        ");
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }
    public function getCommentById($commentId) {
        $stmt = $this->db->connection->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$commentId]);
        return $stmt->fetch();
    }
    
    public function updateComment($commentId, $newText) {
        $stmt = $this->db->connection->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        $stmt->execute([$newText, $commentId]);
        return $stmt->rowCount() > 0;
    }
    
    public function deleteComment($commentId) {
        $stmt = $this->db->connection->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$commentId]);
        return $stmt->rowCount() > 0;
    }

}
?>