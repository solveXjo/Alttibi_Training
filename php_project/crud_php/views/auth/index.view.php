<?php
require_once '../../controllers/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../../Partials/head.php'; ?>
    <title>Signup</title>
</head>

<body class='background'>
    <h2>Signup</h2>
    <div class="form-container d-flex justify-content-center">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
                <span class="error"><?= $nameErr ?></span>
            </div>

            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="<?= htmlspecialchars($age) ?>" required>
                <span class="error"><?= $ageErr ?></span>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                <span class="error"><?= $emailErr ?></span>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                <span class="error"><?= $passErr ?></span>
            </div>

            <div class="form-group">
                <label>Profile Image</label>
                <input type="file" name="fileToUpload">
                <span class="error"><?= $imageErr ?></span>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Signup</button>
            <p>Already have an account? <a href="Login.view.php">Login</a></p>
        </form>
    </div>
</body>

</html>