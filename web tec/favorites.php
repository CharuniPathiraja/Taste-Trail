<?php
session_start();
require_once 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h2 class="display-6 font-weight-bold">My Favorites</h2>
            <p class="text-muted">A collection of your favorite culinary masterpieces.</p>
        </div>
    </div>

    <div class="row g-4" id="recipeGrid">
        <?php
        $stmt = $pdo->prepare("
            SELECT r.* FROM recipes r 
            JOIN favorites f ON r.id = f.recipe_id 
            WHERE f.user_id = ? 
            ORDER BY f.created_at DESC
        ");
        $stmt->execute([$user_id]);
        $has_favorites = false;
        
        while ($row = $stmt->fetch()):
            $has_favorites = true;
        ?>
        <div class="col-md-4 recipe-item animate-fade" data-title="<?php echo strtolower($row['title']); ?>" data-ingredients="<?php echo strtolower($row['ingredients']); ?>">
            <div class="recipe-card-premium h-100 shadow-sm border-0 rounded-4 overflow-hidden position-relative" style="background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);">
                <div class="ratio ratio-4x3">
                    <img src="<?php echo $row['image_url']; ?>" class="object-fit-cover" alt="<?php echo $row['title']; ?>">
                    <div class="heart-overlay active" data-recipe-id="<?php echo $row['id']; ?>">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2"><?php echo $row['title']; ?></h5>
                    <p class="text-muted small mb-3"><?php echo substr($row['description'], 0, 100); ?>...</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-primary rounded-pill px-3 py-2 border">Favorite</span>
                        <button class="btn btn-primary btn-sm px-4 rounded-pill view-recipe" 
                                data-title="<?php echo $row['title']; ?>" 
                                data-ingredients="<?php echo $row['ingredients']; ?>" 
                                data-instructions="<?php echo $row['instructions']; ?>">
                            View
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>

        <?php if (!$has_favorites): ?>
            <div class="col-12 text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-heart text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h4>No favorites yet</h4>
                <p class="text-muted">Explore our recipes and click the heart icon to save your favorites!</p>
                <a href="recipes.php" class="btn btn-primary px-4 rounded-pill mt-3 shadow-sm">Explore Recipes</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Recipe Modal (Same as recipes.php) -->
<div class="modal fade" id="recipeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
            <div class="modal-header border-0 pb-0">
                <h3 class="modal-title fw-bold" id="modalTitle"></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <h6 class="text-primary fw-bold text-uppercase small mb-3">Ingredients</h6>
                    <p id="modalIngredients" class="text-muted"></p>
                </div>
                <hr class="my-4 opacity-25">
                <div>
                    <h6 class="text-primary fw-bold text-uppercase small mb-3">Preparation Steps</h6>
                    <p id="modalInstructions" class="lh-lg"></p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
