<?php
// admin/pages/about/delete.php
session_start();
define('ALLOW_ACCESS', true);

require_once '../../../includes/config.php';
require_once '../../../includes/db.php';
require_once '../../../includes/functions.php';
require_once '../../../includes/auth.php';

// Check if user is logged in
if (!Auth::isLoggedIn()) {
    header("Location: ../../login.php");
    exit;
}

// Get page ID
$page_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$page_id) {
    $_SESSION['error_message'] = 'Invalid page ID!';
    header("Location: index.php");
    exit;
}

$db = Database::getInstance();

try {
    // Check if page exists and is about page
    $page = $db->getRow("SELECT * FROM pages WHERE id = ? AND slug = 'about'", [$page_id]);
    
    if ($page) {
        // Delete the page
        $db->query("DELETE FROM pages WHERE id = ?", [$page_id]);
        $_SESSION['success_message'] = 'About page deleted successfully!';
    } else {
        $_SESSION['error_message'] = 'About page not found.';
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = 'Error deleting page: ' . $e->getMessage();
}

header("Location: index.php");
exit;
?>