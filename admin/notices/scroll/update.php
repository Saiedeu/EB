<?php
// Start session
session_start();

// Define access constant
define('ALLOW_ACCESS', true);

// Include configuration files
require_once '../../../includes/config.php';
require_once '../../../includes/db.php';
require_once '../../../includes/functions.php';
require_once '../../../includes/auth.php';

// Check if user is logged in
if (!Auth::isLoggedIn()) {
    header("Location: ../../login.php");
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $status = isset($_POST['status']) ? sanitizeInput($_POST['status']) : 'active';
    $position = isset($_POST['position']) ? (int)$_POST['position'] : 1;
    
    if ($id <= 0) {
        $_SESSION['error_message'] = 'Invalid notice ID';
        header("Location: index.php");
        exit;
    }
    
    $db = Database::getInstance();
    
    // Get current notice data and verify it's a scrolling notice
    $currentNotice = $db->getRow("SELECT * FROM notices WHERE id = ? AND type = 'scrolling'", [$id]);
    if (!$currentNotice) {
        $_SESSION['error_message'] = 'Scrolling notice not found';
        header("Location: index.php");
        exit;
    }
    
    // Validate form data
    if (empty($content)) {
        $_SESSION['error_message'] = 'Content is required';
    } else {
        // Update scrolling notice
        $updateData = [
            'content' => $content,
            'status' => $status,
            'position' => $position,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $updated = $db->update('notices', $updateData, 'id = ?', [$id]);
        
        if ($updated) {
            $_SESSION['success_message'] = 'Scrolling notice updated successfully';
        } else {
            $_SESSION['error_message'] = 'Failed to update scrolling notice';
        }
    }
}

// Redirect back to scrolling notices list
header("Location: index.php");
exit;
?>