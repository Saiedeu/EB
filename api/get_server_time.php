<?php
header('Content-Type: application/json');

// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include configuration to get timezone setting
require_once(dirname(__DIR__) . '/includes/config.php');
require_once(dirname(__DIR__) . '/includes/functions.php');

try {
    // Set timezone
    $timezone = getSetting('site_timezone', 'Asia/Dhaka');
    date_default_timezone_set($timezone);
    
    // Get current server time
    $timestamp = time();
    $serverTime = date('Y-m-d H:i:s');
    
    echo json_encode([
        'success' => true,
        'server_time' => $serverTime,
        'timestamp' => $timestamp,
        'timezone' => $timezone
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'timestamp' => time()
    ]);
}
?>