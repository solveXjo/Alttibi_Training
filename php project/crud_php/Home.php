
<?php
require 'config.php';
require 'Database.php';

$db = new Database(require 'config.php');

// Fetch a post from the database
$query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 1"; // Get latest post
$stmt = $db->connection->prepare($query);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .container img {
            width: 100%;
            height: auto;
        }
        .content {
            padding: 15px;
        }
        h5 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        p {
            font-size: 14px;
            color: #555;
        }
        .likes {
            font-size: 13px;
            font-weight: bold;
        }
        .timestamp {
            font-size: 12px;
            color: gray;
        }
    </style> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require 'Partials/nav.php' ?>



    <div class='upload'>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <input type="text" name="caption" id="caption" placeholder="Caption">
            <button type="submit" name="submit">Upload</button>
        </form>

    </div>
    <div class='container'>
    <img src="<?= htmlspecialchars('http://localhost/php project/' . $post['image_url']) ?>" alt="Post Image">
    <div class="content">
            <h5></h5>
            <p><?= htmlspecialchars($post['caption']) ?></p>
            <span class="likes"><?= $post['likes'] ?> likes</span><br>
            <span class="timestamp"><?= date("F j, Y", strtotime($post['created_at'])) ?></span>
        </div>
   </div>





</body>
</html>

