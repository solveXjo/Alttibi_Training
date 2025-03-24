<?php


require 'upload.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
    <link rel="stylesheet" href="style.css">
    <title>Signup</title>
</head>
<body class='background'>
    <h2>Signup</h2>
    <div class="form-container d-flex justify-content-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" placeholder="Enter name" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"> <?php echo $nameErr; ?></span>
            </div>

            <div class="form-group">
                <label for="age" class="form-label">Age</label>
                <input type="number" name="age" placeholder="Enter age" class="form-control" value="<?php echo htmlspecialchars($age); ?>">
                <span class="error"> <?php echo $ageErr; ?></span>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" placeholder="Enter email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"> <?php echo $emailErr; ?></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Enter password" class="form-control">
                <span class="error"><?php echo $passwordErr; ?></span>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Upload Profile Image:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                <span class="error"><?php echo $imageErr; ?></span>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Signup</button>

            <p>Already have an account? <a href="Login.php">Login</a></p>
        </form>
    </div>
</body>
</html>