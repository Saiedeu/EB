<?php
// Start session
session_start();

// Define access constant
define('ALLOW_ACCESS', true);

// Include configuration files
require_once '../../includes/config.php';
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

// Check if user is logged in
if (!Auth::isLoggedIn()) {
    header("Location: ../login.php");
    exit;
}

// Check if ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $reserve_id = intval($_GET['id']);
    
    // Check if reserve exists
    $db = Database::getInstance();
    $existingReserve = $db->getRow("SELECT * FROM reserves WHERE id = ?", [$reserve_id]);
    
    if (!$existingReserve) {
        $_SESSION['error_message'] = 'Reserve not found.';
        header("Location: index.php");
        exit;
    }
    
    // Delete reserve
    $result = $db->delete('reserves', 'id = ?', [$reserve_id]);
    
    if ($result) {
        $_SESSION['success_message'] = 'Reserve deleted successfully.';
    } else {
        $_SESSION['error_message'] = 'Failed to delete reserve. Please try again.';
    }
} else {
    $_SESSION['error_message'] = 'Invalid reserve ID.';
}

header("Location: index.php");
exit;
?>