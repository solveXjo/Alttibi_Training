<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Posts</title>
</head>
<body class='background'>
<?php require 'partials/nav.php'; ?>

    <h2>My Profile</h2>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php 
    // echo $user['name']?>


    <form method="post" action="">

    <div class="text-center">
        <img src="<?= ($user['image'] ?? 'images/Solvex Logo.jpg') ?>" class="rounded" alt="Profile Picture">
    </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" 
                   value="<?= htmlspecialchars($user['age'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" 
                   value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password (leave blank to keep current)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>


    <form method="post" action="" class="mt-4">
        <input type="hidden" name="delete_account" value="1">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? This cannot be undone.')">
            Delete Account
        </button>
    </form>

    </form>

</body>
</html>