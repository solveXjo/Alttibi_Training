<?php
function getPageDetails()
{
    $currentPage = str_replace('.php', '', basename($_SERVER['PHP_SELF']));

    $pages = [
        'about' => [
            'title' => 'About Us - Altibi',
            'heading' => 'About Us',
            'breadcrumb' => 'About'
        ],
        'contact' => [
            'title' => 'Contact Us - Altibbi',
            'heading' => 'Contact',
            'breadcrumb' => 'Contact'
        ],
        'home' => [
            'title' => 'Home - Altibbi',
            'heading' => 'Home',
            'breadcrumb' => 'Home'
        ],
        'posts' => [
            'title' => 'Posts- Altibbi',
            'heading' => 'Posts',
            'breadcrumb' => 'Posts'
        ],
        'profile' => [
            'title' => 'Profile - Altibbi',
            'heading' => 'Profile',
            'breadcrumb' => 'Profile'
        ],
    ];

    return $pages[$currentPage] ?? [
        'title' => 'Default Title - Altibbi',
        'heading' => 'Default Heading',
        'breadcrumb' => 'Default'
    ];
}

$pageInfo = getPageDetails();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'Partials/head.php' ?>

</head>
<body>
<div class="page-title">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0"><?php echo $pageInfo['heading']; ?></h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="/home">Home</a></li>
                <li class="current"><?php echo $pageInfo['breadcrumb']; ?></li>
            </ol>
        </nav>
    </div>
</div>
</body>

</html>
