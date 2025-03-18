<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profile</title>
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

    <form method="post" action="" enctype="multipart/form-data">

        <div class="mb-3">
        <label for="image" class="form-label">Profile Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        
        </div>
            <?php if (isset($user['image_path']) && $user['image_path']): ?>
                <img src="uploads/<?php echo ($user['image_path']); ?>" alt="Profile Image" style="justify-content: center;   vertical-align: middle; width: 150px; height: 150px; border-radius: 50%; display: block; object-fit: cover; border: 2px solid #f1f1f1; position: relative; left: 50%; transform: translateX(-50%);">
            <?php else: ?>
            <img src="uploads/default.png" alt="Default Profile Image" style="justify-content: center; width: 100px; height: 100px; border-radius: 50%; display: block; object-fit: cover; border: 2px solid #f1f1f1; position: relative; left: 50%; transform: translateX(-50%);">
            <?php endif; ?>
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

    </form>

    <form method="post" action="" class="mt-4">
        <input type="hidden" name="delete_account" value="1">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? This cannot be undone.')">
            Delete Account
        </button>
    </form>

</body>
</html>