<?php
session_start();
require_once '../includes/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $recipe_id = isset($_POST['recipe_id']) ? intval($_POST['recipe_id']) : 0;

    if ($recipe_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid recipe ID']);
        exit();
    }

    // Check if already favorited
    $stmt = $pdo->prepare("SELECT 1 FROM favorites WHERE user_id = ? AND recipe_id = ?");
    $stmt->execute([$user_id, $recipe_id]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        // Remove from favorites
        $stmt = $pdo->prepare("DELETE FROM favorites WHERE user_id = ? AND recipe_id = ?");
        if ($stmt->execute([$user_id, $recipe_id])) {
            echo json_encode(['status' => 'success', 'action' => 'removed']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to remove from favorites']);
        }
    } else {
        // Add to favorites
        $stmt = $pdo->prepare("INSERT INTO favorites (user_id, recipe_id) VALUES (?, ?)");
        if ($stmt->execute([$user_id, $recipe_id])) {
            echo json_encode(['status' => 'success', 'action' => 'added']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add to favorites']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
