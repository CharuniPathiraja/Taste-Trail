<?php
session_start();
require_once 'includes/db.php';
include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h2 class="display-6 font-weight-bold">Explore Recipes</h2>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" id="recipeSearch" class="form-control border-start-0" placeholder="Search by name or ingredients...">
            </div>
        </div>
    </div>

    <div class="row g-4" id="recipeGrid">
        <?php
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $stmt = $pdo->query("SELECT * FROM recipes");
        while ($row = $stmt->fetch()):
            $is_favorited = false;
            if ($user_id) {
                $fav_stmt = $pdo->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND recipe_id = ?");
                $fav_stmt->execute([$user_id, $row['id']]);
                $is_favorited = $fav_stmt->fetchColumn();
            }
        ?>
        <div class="col-md-4 recipe-item animate-fade" data-title="<?php echo strtolower($row['title']); ?>" data-ingredients="<?php echo strtolower($row['ingredients']); ?>">
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
                        <span class="badge bg-light text-primary rounded-pill px-3 py-2 border">Easy</span>
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
    </div>
</div>

<!-- Recipe Modal -->
<div class="modal fade" id="recipeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title font-weight-bold" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Ingredients:</h6>
                <p id="modalIngredients" class="text-muted"></p>
                <hr>
                <h6>Preparation Steps:</h6>
                <p id="modalInstructions"></p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
