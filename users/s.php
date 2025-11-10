<?php
// users/test-security-integration.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== SECURITY INTEGRATION TEST ===<br>";

session_start();
define('ALLOW_ACCESS', true);

require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once '../includes/security.php';
require_once 'includes/UserAuth.php';

echo "1. All includes loaded<br>";

try {
    $security = Security::getInstance();
    echo "2. ✓ Security instance created<br>";
} catch (Exception $e) {
    echo "2. ✗ Security failed: " . $e->getMessage() . "<br>";
    die();
}

try {
    $userAuth = new UserAuth();
    echo "3. ✓ UserAuth instance created<br>";
} catch (Exception $e) {
    echo "3. ✗ UserAuth failed: " . $e->getMessage() . "<br>";
    die();
}

// Test security methods
echo "4. Testing security methods:<br>";
echo "&nbsp;&nbsp;- Client IP: " . $security->getClientIp() . "<br>";
echo "&nbsp;&nbsp;- CSRF Token: " . substr($security->generateCSRFToken(), 0, 16) . "...<br>";
echo "&nbsp;&nbsp;- Rate limit check: " . ($security->checkRateLimit('test', 10, 60) ? 'OK' : 'Limited') . "<br>";

// Test user access levels
echo "5. Testing access levels:<br>";
echo "&nbsp;&nbsp;- Guest access: " . ($security->checkUserAccess('guest') ? 'OK' : 'Denied') . "<br>";
echo "&nbsp;&nbsp;- Site user access: " . ($security->checkUserAccess('site_user') ? 'OK' : 'Denied') . "<br>";
echo "&nbsp;&nbsp;- Admin access: " . ($security->checkUserAccess('admin') ? 'OK' : 'Denied') . "<br>";

// Test site user methods
echo "6. Testing site user methods:<br>";
echo "&nbsp;&nbsp;- Is site user logged in: " . ($security->isSiteUserLoggedIn() ? 'Yes' : 'No') . "<br>";
echo "&nbsp;&nbsp;- Current site user: " . ($security->getCurrentSiteUser() ? 'Found' : 'None') . "<br>";

echo "=== SECURITY INTEGRATION TEST COMPLETE ===<br>";
echo "If you see this without errors, the security integration is working!";
?>