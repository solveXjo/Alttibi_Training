<?php
require_once 'Database.php';
require_once 'Home.view.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class='background'>

    <?php require_once 'Partials/nav.php'; ?>
    <h2>Make a post...</h2>
    <div class="d-flex justify-content-center">

    <form action="" method="post" >
        <label for="">what Do you want to type?</label>
        <input type="text" name="caption" id="caption" placeholder="type..." required>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</body>
</html>
