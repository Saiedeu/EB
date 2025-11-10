<?php
// Start session
session_start();

// Define access constant
define('ALLOW_ACCESS', true);

// Set content type to JSON
header('Content-Type: application/json');

// Allow CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include your database configuration
require_once(dirname(__DIR__) . '/includes/config.php');
require_once(dirname(__DIR__) . '/includes/functions.php');
require_once(dirname(__DIR__) . '/includes/db.php');

// Function to generate sequential exchange ID
function generateSequentialExchangeId() {
    try {
        $db = Database::getInstance();
        
        // Set timezone
        $timezone = getSetting('site_timezone', 'Asia/Dhaka');
        date_default_timezone_set($timezone);
        
        // Get current date
        $currentDate = date('Y-m-d');
        $todayPrefix = date('ymd'); // YYMMDD format
        
        // Get the highest sequence number for today
        $lastId = $db->getValue(
            "SELECT MAX(CAST(SUBSTRING(reference_id, -2) AS UNSIGNED)) as max_seq 
             FROM exchanges 
             WHERE DATE(created_at) = ? 
             AND reference_id LIKE ?",
            [$currentDate, "EB-{$todayPrefix}%"]
        );
        
        // Calculate next sequence number
        $nextSequence = ($lastId !== false && $lastId !== null) ? intval($lastId) + 1 : 1;
        $sequenceStr = str_pad($nextSequence, 2, '0', STR_PAD_LEFT);
        
        // Generate the ID
        $exchangeId = "EB-{$todayPrefix}{$sequenceStr}";
        
        return $exchangeId;
        
    } catch (Exception $e) {
        error_log("Error generating sequential exchange ID: " . $e->getMessage());
        
        // Fallback to timestamp-based ID with proper format
        $timestamp = date('ymd');
        $randomSeq = str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT);
        return "EB-{$timestamp}{$randomSeq}";
    }
}

try {
    // Handle both POST and GET requests
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input || $input['action'] !== 'generate_id') {
            throw new Exception('Invalid request');
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'generate_id') {
        // Allow GET request for testing
    } else {
        throw new Exception('Invalid request method or parameters');
    }
    
    // Set timezone
    $timezone = getSetting('site_timezone', 'Asia/Dhaka');
    date_default_timezone_set($timezone);
    
    // Generate sequential exchange ID
    $exchangeId = generateSequentialExchangeId();
    
    // Return success response
    echo json_encode([
        'success' => true,
        'exchange_id' => $exchangeId,
        'timestamp' => time(),
        'timezone' => $timezone,
        'date' => date('Y-m-d H:i:s')
    ]);
    
} catch (Exception $e) {
    // Return error response
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'timestamp' => time()
    ]);
}
?>