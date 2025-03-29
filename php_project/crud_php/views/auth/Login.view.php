<?php

// $config = require '../../config.php';
// require '../../Database.php';
require_once '../../controllers/Login.php';

// $db = new Database($config);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $include = include '../../Partials/head.php'; 
    // echo $include;?>

    <title>Login</title>
</head>

<body class='background'>

    <h2>Login</h2>
    <div class="d-flex justify-content-center">

        <form action="" method="post" class="login">
        <span class="error"><?php echo $invalid; ?></span>

            <label for="" class="form-label">email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter email"required><br>
            <label for="" class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter password" required>
            <br>
            <br>
            <input class="btn btn-primary" type="submit" value="Submit">
            <p>Don't have an account? <a href="../../index.php">Signup</a></p>
        </form>

    </div>

</body>

</html>