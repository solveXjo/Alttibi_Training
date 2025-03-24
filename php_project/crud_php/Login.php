<?php require_once 'Login.view.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'head.php'; ?>
    <title>Login</title>
</head>

<body class='background'>

    <h2>Login</h2>
    <div class="d-flex justify-content-center">

        <form action="" method="post" class="login">
            <label for="" class="form-label">email</label>
            <input class="form-control" type="email" name="email" placeholder="Enter email"><br>
            <label for="" class="form-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter password">
            <br>
            <br>
            <input class="btn btn-primary" type="submit" value="Submit">
            <p>Don't have an account? <a href="index.php">Signup</a></p>
        </form>

    </div>

</body>

</html>