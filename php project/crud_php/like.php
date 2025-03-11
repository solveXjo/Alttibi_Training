<!-- <?php
require 'config.php';
require 'Database.php';

$db = new Database(require 'config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];


    $query = "UPDATE posts SET likes = likes + 1 WHERE id = ?";
    $stmt = $db->connection->prepare($query);
    $stmt->execute([$post_id]);

    $newQuery = "SELECT likes FROM posts WHERE id = ?";
    $newStmt = $db->connection->prepare($newQuery);
    $newStmt->execute([$post_id]);
    $newLikes = $newStmt->fetchColumn();

    echo $newLikes;
}
?> -->
