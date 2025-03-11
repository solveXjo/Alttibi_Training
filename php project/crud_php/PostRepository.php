<?php
class PostRepository {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllPosts() {
        $query = "SELECT id, caption, likes, created_at FROM posts ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll(); 
    }

    public function incrementLikes($postId) {
        $query = "UPDATE posts SET likes = likes + 1 WHERE id = :id";
        $this->db->query($query, [':id' => $postId]);
    }
}