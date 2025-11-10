<?php
session_start();
define('ALLOW_ACCESS', true);

require_once '../../includes/config.php';
require_once '../../includes/db.php';
require_once '../../includes/auth.php';

if (!Auth::isLoggedIn()) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $db = Database::getInstance();
    $id = (int)$_GET['id'];
    
    // Get button details for file cleanup
    $button = $db->getRow("SELECT * FROM floating_buttons WHERE id = ?", [$id]);
    
    if ($button) {
        // Delete custom icon file if exists
        if (!empty($button['custom_icon']) && file_exists('../../' . $button['custom_icon'])) {
            unlink('../../' . $button['custom_icon']);
        }
        
        // Delete from database
        $result = $db->delete('floating_buttons', ['id' => $id]);
        
        if ($result) {
            $_SESSION['success_message'] = 'Floating button deleted successfully!';
        } else {
            $_SESSION['error_message'] = 'Failed to delete floating button.';
        }
    } else {
        $_SESSION['error_message'] = 'Floating button not found.';
    }
} else {
    $_SESSION['error_message'] = 'Invalid request.';
}

header("Location: index.php");
exit;
?>