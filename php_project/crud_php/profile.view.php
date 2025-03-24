<!DOCTYPE html>
<html lang="en">

<head>

    <title>Profile</title>
</head>

<body class="background">

    <?php require 'partials/nav.php'; ?>

    <div class="profile-container">
        <h2 class="text-center mb-4">My Profile</h2>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" action="" enctype="multipart/form-data">

            <div class="profile-image">
                <?php if (isset($user['image_path']) && $user['image_path']): ?>
                    <img src="uploads/<?php echo htmlspecialchars($user['image_path']); ?>" alt="Profile Image">
                <?php else: ?>
                    <img src="uploads/default.png" alt="Default Profile Image">
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Update Profile Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
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

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <!-- Update Profile Button -->
            <button type="submit" class="btn btn-primary">Update Profile</button>

        </form>

        <!-- Delete Account Form -->
        <form method="post" action="" class="mt-4">
            <input type="hidden" name="delete_account" value="1">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? This cannot be undone.')">
                Delete Account
            </button>
        </form>
    </div>

</body>

</html>