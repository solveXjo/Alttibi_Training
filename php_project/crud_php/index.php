<?php require 'index.view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>Signup</title>
</head>
<body class='background'>
<h2>Signup</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">

    <label for="name">Name</label>
    <input type="text" name="name" placeholder="Enter name">

    <label for="age">Age</label>
    <input type="number" name="age" placeholder="Enter age">

    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Enter email">

    <label for="password">Password</label>
    <input type="password" name="password" placeholder="Enter password">
    <label for="image">Upload Profile Image:</label>
    <input type="file" name="fileToUpload" id="fileToUpload">

    <input type="hidden" name="submit" value="Upload Image">

    <button class="btn btn-primary" type="submit">Signup</button>

    <p>Already have an account? <a href="Login.php">Login</a></p>

</form>
</body>
</html>