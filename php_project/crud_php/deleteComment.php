<?php
    require 'config.php';
    require 'Database.php';

    $db = new Database(require 'config.php');

    $query = "DELETE FROM comments WHERE post_id = :post_id";
    $stmt = $db->connection->prepare($query);
    $stmt->bindParam(':post_id', $_GET['post_id'], PDO::PARAM_INT);
    $stmt->execute();
?>
