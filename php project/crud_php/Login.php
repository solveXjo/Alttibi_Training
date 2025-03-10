<?php require 'Login.view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body style="background-image: url('images/Background.jpg');">

<h2>Login</h2>
<form action="" method="post">
    <input type="email" name="email" placeholder="Enter email"><br>
    <input type="password" name="password" placeholder="Enter password"><br>
    <input type="submit" value="Login">
    <button><a href="index.php">Don't Have an account?</a></button>

</form>
</body>
</html>
