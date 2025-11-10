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

// Check if user is logged in, if not redirect to login page
if (!Auth::isLoggedIn()) {
    header("Location: ../login.php");
    exit;
}

// Get exchange ID and status from URL
$exchangeId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$status = isset($_GET['status']) ? sanitizeInput($_GET['status']) : '';

// Validate status
$validStatuses = ['pending', 'confirmed', 'cancelled', 'refunded'];
if (!in_array($status, $validStatuses)) {
    $_SESSION['error_message'] = 'Invalid status';
    header("Location: index.php");
    exit;
}

// Check if exchange exists
$db = Database::getInstance();
$exchange = $db->getRow("SELECT * FROM exchanges WHERE id = ?", [$exchangeId]);

if (!$exchange) {
    $_SESSION['error_message'] = 'Exchange not found';
    header("Location: index.php");
    exit;
}

// Update exchange status
$result = $db->update('exchanges', [
    'status' => $status,
    'updated_at' => date('Y-m-d H:i:s')
], 'id = ?', [$exchangeId]);

if ($result) {
    $_SESSION['success_message'] = 'Exchange status updated successfully';
} else {
    $_SESSION['error_message'] = 'Failed to update exchange status';
}

// Redirect back to exchange view
header("Location: view.php?id=$exchangeId");
exit;