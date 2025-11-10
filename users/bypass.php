<?php
// users/bypass-test.php
// Test bypassing security for user pages
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Skip security for user pages temporarily
define('ALLOW_ACCESS', true);
define('SKIP_SECURITY', true);

require_once '../includes/config.php';
require_once '../includes/db.php';

// Only include functions, skip security
if (file_exists('../includes/functions.php')) {
    require_once '../includes/functions.php';
    echo "Functions loaded without security<br>";
}

echo "Bypass test successful!<br>";

// Test database
try {
    $db = Database::getInstance();
    $test = $db->getValue("SELECT 1");
    echo "Database works: $test<br>";
} catch (Exception $e) {
    echo "Database error: " . $e->getMessage() . "<br>";
}

// Test getSetting
try {
    $siteName = getSetting('site_name', 'Default');
    echo "Site name: " . htmlspecialchars($siteName) . "<br>";
} catch (Exception $e) {
    echo "getSetting error: " . $e->getMessage() . "<br>";
}
?>