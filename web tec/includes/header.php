<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste Trail - Digital Recipe Book</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@1.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <div class="brand-decorative">
                    <span class="taste">TASTE</span><span class="trail">TRAIL</span><span class="brand-dot"></span>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item-adv"><a class="nav-link-adv <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Home</a></li>
                    <li class="nav-item-adv"><a class="nav-link-adv <?php echo basename($_SERVER['PHP_SELF']) == 'recipes.php' ? 'active' : ''; ?>" href="recipes.php">Explore</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item-adv"><a class="nav-link-adv <?php echo basename($_SERVER['PHP_SELF']) == 'favorites.php' ? 'active' : ''; ?>" href="favorites.php">Favorites</a></li>
                        <li class="nav-item-adv"><a class="nav-link-adv <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">Dashboard</a></li>
                        <li class="nav-item ms-lg-3"><a class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm" href="auth/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item-adv"><a class="nav-link-adv border-0 bg-transparent" href="contact.php">Contact</a></li>
                        <li class="nav-item-adv"><a class="nav-link-adv" href="auth/login.php">Login</a></li>
                        <li class="nav-item ms-lg-3"><a class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm" href="auth/register.php">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
