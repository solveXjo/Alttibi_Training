<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <title>Signup</title>
</head>
<body class='background'>
    <h2>Signup</h2>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Enter name" required>

            <label for="age">Age</label>
            <input type="number" name="age" placeholder="Enter age" required>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter password" required>

            <label for="image">Upload Profile Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" required>

            <button class="btn btn-primary" type="submit">Signup</button>

            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>