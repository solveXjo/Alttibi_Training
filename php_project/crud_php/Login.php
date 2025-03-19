<?php require_once 'Login.view.php';
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
      <title>Login</title>
</head>
<body class='background'>

<h2>Login</h2>
<div class="container">
 <form action="" method="post" class="login">
    <label for="">email</label>
    <input type="email" name="email" placeholder="Enter email"><br>
    <label for="">Password</label>

    <input type="password" name="password" placeholder="Enter password">
    <br>
    <br>
    <input class="btn btn-primary" type="submit" value="Submit">
    <p>Don't have an account? <a href="index.php">Signup</a></p>
 </form>

</div>

</body>
</html>
