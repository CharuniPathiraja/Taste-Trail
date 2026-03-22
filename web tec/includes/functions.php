<?php
/**
 * Helper Functions for Taste Trail
 */

// Function to clean input data
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to format dates
function format_date($date) {
    return date('F j, Y', strtotime($date));
}
?>
