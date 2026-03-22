<?php
session_start();
require_once 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$body_class = 'body-dashboard';
include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow border-0 p-4 mb-4">
                <div class="text-center mb-4 pt-3">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" class="rounded-circle shadow-sm border border-3 border-white" width="100" height="100" style="object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-2"></span>
                    </div>
                    <h4>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h4>
                    <p class="text-muted small">Chef • Member since 2024</p>
                </div>
                <hr>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action border-0 px-0">My Recipes (0)</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 px-0">Saved Favorites</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 px-0">Account Settings</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow border-0 p-4 animate-fade">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">My Recipe Collection</h5>
                    <button class="btn btn-primary btn-sm">Add New Recipe</button>
                </div>
                
                <div class="alert alert-light border-0 text-center py-5 rounded-4" style="background: rgba(255,255,255,0.5);">
                    <div class="mb-4">
                        <img src="https://images.unsplash.com/photo-1547517023-7ca0c162f816?auto=format&fit=crop&w=400&q=80" class="rounded-4 shadow-sm opacity-75" width="200" alt="No Recipes">
                    </div>
                    <i class="bi bi-journal-plus display-4 text-muted mb-3 d-block"></i>
                    <p class="text-muted">You haven't added any culinary masterpieces yet. Start building your digital cookbook today!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
