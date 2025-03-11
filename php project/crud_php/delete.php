<?php
    require 'config.php';
    require 'Database.php';

    $db = new Database(require 'config.php');

    $query = "DELETE FROM posts WHERE id = :id";
    $stmt = $db->connection->prepare($query);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
?>
