<!-- <?php
require 'config.php';
require 'Database.php';

$db = new Database(require 'config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['comment'])) {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $user_id = 1; // Change this to the actual logged-in user ID

    $query = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
    $stmt = $db->connection->prepare($query);
    $stmt->execute([$post_id, $user_id, $comment]);

    header("Location: Home.php");
    exit();
}
?> -->
