<?php
// users/test-userauth.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== USERAUTH TEST ===<br>";

session_start();
define('ALLOW_ACCESS', true);

require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';

echo "1. Basic includes loaded<br>";

try {
    require_once 'includes/UserAuth.php';
    echo "2. ✓ UserAuth.php loaded successfully<br>";
} catch (Exception $e) {
    echo "2. ✗ UserAuth.php failed: " . $e->getMessage() . "<br>";
    die();
}

try {
    $userAuth = new UserAuth();
    echo "3. ✓ UserAuth instance created<br>";
} catch (Exception $e) {
    echo "3. ✗ UserAuth instance failed: " . $e->getMessage() . "<br>";
    die();
}

echo "4. Testing login with fake credentials<br>";
$result = $userAuth->login('test@test.com', 'fakepassword');
echo "5. Login result: " . ($result['success'] ? 'Success' : 'Failed: ' . $result['message']) . "<br>";

echo "=== USERAUTH TEST COMPLETE ===<br>";
echo "If you see this, UserAuth is working properly!";
?>