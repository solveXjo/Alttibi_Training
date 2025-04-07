<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /index");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #5F99AE;
            --secondary-color: #F5ECE0;
            --hover: #336D82;
            --hover-text: #FFF;
            --card-bg: #FFFFFF;
            --text-dark: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #e0e0e0;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .create-post-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            padding: 20px;
        }
        
        .post-input {
            border: none;
            border-radius: 8px;
            background: #f8f9fa;
            padding: 15px;
            width: 100%;
            resize: none;
            min-height: 100px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .post-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--primary-color);
            background: white;
        }
        
        .post-button {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
        }
        
        .post-button:hover {
            background-color: var(--hover);
            transform: translateY(-2px);
        }
        
        .post-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .post-header {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .post-user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }
        
        .post-user-name {
            font-weight: 600;
            margin-bottom: 0;
            color: var(--text-dark);
        }
        
        .post-time {
            font-size: 0.8rem;
            color: var(--text-light);
        }
        
        .post-content {
            padding: 15px;
            color: var(--text-dark);
            line-height: 1.5;
        }
        
        .post-actions {
            padding: 10px 15px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-around;
        }
        
        .action-btn {
            color: var(--text-light);
            background: none;
            border: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        
        .action-btn:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }
        
        .action-btn i {
            margin-right: 5px;
        }
        
        .sidebar {
            position: sticky;
            top: 20px;
        }
        
        .sidebar-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .trending-tag {
            display: inline-block;
            background: #f8f9fa;
            padding: 5px 12px;
            border-radius: 20px;
            margin-right: 8px;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: var(--text-dark);
            transition: all 0.2s;
        }
        
        .trending-tag:hover {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php require_once 'Partials/nav.php'; ?>

    <div class="container py-4">
        <div class="row">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                <!-- Create Post Card -->
                <div class="create-post-card">
                    <form action="" method="post">
                        <div class="d-flex align-items-center mb-3">
                            <!-- <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['name']) ?>&background=5F99AE&color=fff"  -->
                                 <!-- class="post-user-img" alt="Profile"> -->
                            <!-- <h5 class="mb-0">What's on your mind, <?= htmlspecialchars($_SESSION['name']) ?>?</h5> -->
                        </div>
                        <textarea class="post-input mb-3" name="caption" id="caption" placeholder="Share your thoughts..." required></textarea>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-secondary me-2">
                                    <i class="fas fa-image"></i> Photo
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-video"></i> Video
                                </button>
                            </div>
                            <button type="submit" class="post-button">Post</button>
                        </div>
                    </form>
                </div>

                <!-- Sample Post (would be dynamic in real app) -->
                <div class="post-card">
                    <div class="post-header">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="post-user-img" alt="User">
                        <div>
                            <h6 class="post-user-name">John Doe</h6>
                            <small class="post-time">2 hours ago</small>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Just finished my morning hike! The view was absolutely breathtaking. Nature always helps me clear my mind and find new inspiration.</p>
                        <img src="https://images.unsplash.com/photo-1682686580391-615bd4062efb" class="img-fluid rounded mb-2" alt="Post image">
                    </div>
                    <div class="post-actions">
                        <button class="action-btn">
                            <i class="far fa-thumbs-up"></i> Like
                        </button>
                        <button class="action-btn">
                            <i class="far fa-comment"></i> Comment
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>
                </div>

                <!-- Another Sample Post -->
                <div class="post-card">
                    <div class="post-header">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="post-user-img" alt="User">
                        <div>
                            <h6 class="post-user-name">Jane Smith</h6>
                            <small class="post-time">5 hours ago</small>
                        </div>
                    </div>
                    <div class="post-content">
                        <p>Working on a new project that I'm really excited about! Can't wait to share more details soon. #coding #webdevelopment</p>
                    </div>
                    <div class="post-actions">
                        <button class="action-btn">
                            <i class="far fa-thumbs-up"></i> Like
                        </button>
                        <button class="action-btn">
                            <i class="far fa-comment"></i> Comment
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4 sidebar">
                <div class="sidebar-card">
                    <h5>Trending Today</h5>
                    <div class="mt-3">
                        <a href="#" class="trending-tag">#WebDevelopment</a>
                        <a href="#" class="trending-tag">#TechNews</a>
                        <a href="#" class="trending-tag">#Programming</a>
                        <a href="#" class="trending-tag">#Design</a>
                        <a href="#" class="trending-tag">#SocialMedia</a>
                        <a href="#" class="trending-tag">#Trending</a>
                    </div>
                </div>

                <div class="sidebar-card">
                    <h5>Suggested Friends</h5>
                    <div class="mt-3">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" class="post-user-img" alt="User">
                            <div>
                                <h6 class="post-user-name mb-0">Mike Johnson</h6>
                                <small class="post-time">12 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">Add</button>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://randomuser.me/api/portraits/women/33.jpg" class="post-user-img" alt="User">
                            <div>
                                <h6 class="post-user-name mb-0">Sarah Williams</h6>
                                <small class="post-time">8 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">Add</button>
                        </div>
                        <div class="d-flex align-items-center">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" class="post-user-img" alt="User">
                            <div>
                                <h6 class="post-user-name mb-0">David Brown</h6>
                                <small class="post-time">5 mutual friends</small>
                            </div>
                            <button class="btn btn-sm btn-outline-primary ms-auto">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>