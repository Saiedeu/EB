<?php
// admin/pages/delete.php
session_start();
define('ALLOW_ACCESS', true);

require_once '../../includes/config.php';
require_once '../../includes/db.php';
require_once '../../includes/functions.php';
require_once '../../includes/auth.php';

// Check if user is logged in
if (!Auth::isLoggedIn()) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $page_id = (int)$_GET['id'];
    $db = Database::getInstance();
    
    try {
        // Check if page exists
        $page = $db->getRow("SELECT * FROM pages WHERE id = ?", [$page_id]);
        
        if ($page) {
            // Delete the page
            $db->query("DELETE FROM pages WHERE id = ?", [$page_id]);
            $_SESSION['success_message'] = 'Page deleted successfully!';
        } else {
            $_SESSION['error_message'] = 'Page not found.';
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = 'Error deleting page: ' . $e->getMessage();
    }
} else {
    $_SESSION['error_message'] = 'Invalid page ID.';
}

header("Location: index.php");
exit;
?>