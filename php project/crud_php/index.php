<?php require 'index.view.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Signup</title>
</head>
<body style="background-image: url('Background.jpg');">
<h2>Signup</h2>
<form action="" method="post">
    <label for="">Name</label>
    <input type="text" name="name" placeholder="Enter name">

    <label for="">age</label>
    <input type="number" name="age" placeholder="Enter age">


    <label for="">email</label>
    <input type="email" name="email" placeholder="Enter email">

    <label for="">Password</label>
    <input type="password" name="password" placeholder="Enter password"><br>
    <input type="submit" value="Signup">
    <button><a href="Login.php">Have an account?</a></button>

</form>
</body>
</html>
