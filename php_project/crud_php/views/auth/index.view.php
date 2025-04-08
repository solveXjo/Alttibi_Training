<?php
require_once 'controllers/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'Partials/head.php'; ?>
    <title>Signup</title>
    <style>
        :root {
            --primary-color: #5F99AE;
            --secondary-color: #F5ECE0;
            --hover: #336D82;
            --hover-text: #FFF;
            --form-bg: #FFFFFF;
        }

        body {
            background-color: var(--secondary-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .signup-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-section {
            background: var(--form-bg);
            padding: 3rem;
        }

        .graphic-section {
            background: var(--primary-color);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-header img {
            width: 120px;
            margin-bottom: 1.5rem;
        }

        .form-header h4 {
            font-weight: 600;
            color: #2c3e50;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(95, 153, 174, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--hover);
            color: var(--hover-text);
        }

        .login-link {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }

        .login-link:hover {
            color: var(--hover);
            text-decoration: underline;
        }

        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        .file-input-label {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #6c757d;
        }

        @media (max-width: 992px) {
            .graphic-section {
                display: none;
            }

            .form-section {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="signup-card">
                    <div class="row no-gutters">
                        <div class="col-lg-7 form-section">
                            <div class="form-header">
                                <img src="images/download.png" alt="Sign up icon">
                                <h4>Create Your Account</h4>
                            </div>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($name) ?>" required>
                                    <span class="error"><?= $nameErr ?></span>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Age</label>
                                    <input type="number" class="form-control" name="age" value="<?= htmlspecialchars($age) ?>" required>
                                    <span class="error"><?= $ageErr ?></span>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" required>
                                    <span class="error"><?= $emailErr ?></span>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                    <span class="error"><?= $passErr ?></span>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Profile Photo</label>
                                    <input type="file" class="form-control" name="fileToUpload">
                                    <span class="file-input-label">JPEG or PNG, max 2MB</span>
                                    <span class="error"><?= $imageErr ?></span>
                                </div>

                                <div class="d-grid gap-2 mt-5">
                                    <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                                </div>

                                <div class="d-flex align-items-center justify-content-center pb-4 mt-4">
                                    <p class="mb-0 me-2">Already have an account?</p>
                                    <a href="/Login" class="btn btn-outline-danger  ">Login</a>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-5 graphic-section">
                            <div>
                                <h3>Join Our Community</h3>
                                <p class="mt-4">Create an account to unlock all features and connect with like-minded people. We're excited to have you on board!</p>
                                <ul class="mt-4" style="list-style-type: none; padding-left: 0;">
                                    <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Personalized dashboard</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2"></i> Secure data storage</li>
                                    <li class="mb-3"><i class="fas fa-check-circle me-2"></i> 24/7 customer support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>