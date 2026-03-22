<?php
session_start();
require_once 'includes/db.php';
include 'includes/header.php';
?>

<!-- Hero Section -->
<header class="hero-section">
    <div class="hero-content animate-fade">
        <h1>Taste Trail</h1>
        <p class="lead">Your Ultimate Interactive Digital Recipe Book</p>
        <a href="recipes.php" class="btn btn-primary btn-lg mt-3">Explore Recipes</a>
    </div>
</header>

<!-- Featured Recipes Section -->
<section class="container my-5">
    <div class="text-center mb-5">
        <h2 class="display-5 font-weight-bold">Featured Recipes</h2>
        <div class="header-underline mx-auto" style="width: 80px; height: 4px; background: var(--primary-color);"></div>
    </div>

    <div class="row g-4">
        <?php
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $stmt = $pdo->query("SELECT * FROM recipes ORDER BY id DESC LIMIT 6");
        while ($row = $stmt->fetch()):
            $is_favorited = false;
            if ($user_id) {
                $fav_stmt = $pdo->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND recipe_id = ?");
                $fav_stmt->execute([$user_id, $row['id']]);
                $is_favorited = $fav_stmt->fetchColumn();
            }
        ?>
        <div class="col-md-4">
            <div class="recipe-card-premium h-100 shadow-sm border-0 rounded-4 overflow-hidden position-relative" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);">
                <div class="ratio ratio-4x3">
                    <img src="<?php echo $row['image_url']; ?>" class="object-fit-cover" alt="<?php echo $row['title']; ?>">
                    <?php if ($user_id): ?>
                        <div class="heart-overlay <?php echo $is_favorited ? 'active' : ''; ?>" data-recipe-id="<?php echo $row['id']; ?>">
                            <i class="bi <?php echo $is_favorited ? 'bi-heart-fill' : 'bi-heart'; ?>"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2"><?php echo $row['title']; ?></h5>
                    <p class="text-muted small mb-3"><?php echo substr($row['description'], 0, 100); ?>...</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-primary rounded-pill px-3 py-2 border">Premium</span>
                        <a href="recipe-details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm px-4 rounded-pill">Explore</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h3 class="mb-4">Have a Secret Recipe?</h3>
        <p class="mb-4">Join our community and share your culinary masterpieces with the world.</p>
        <a href="auth/register.php" class="btn btn-primary">Join Taste Trail Today</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
