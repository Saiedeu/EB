<?php
// users/debug.php
echo "=== DEBUG START ===<br>";

// Enable all error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "1. PHP Error reporting enabled<br>";

session_start();
echo "2. Session started<br>";

define('ALLOW_ACCESS', true);
echo "3. ALLOW_ACCESS defined<br>";

try {
    echo "4. Attempting to include config.php<br>";
    require_once '../includes/config.php';
    echo "5. ✓ Config.php loaded<br>";
} catch (Exception $e) {
    echo "5. ✗ Config.php failed: " . $e->getMessage() . "<br>";
    die();
}

try {
    echo "6. Attempting to include db.php<br>";
    require_once '../includes/db.php';
    echo "7. ✓ DB.php loaded<br>";
} catch (Exception $e) {
    echo "7. ✗ DB.php failed: " . $e->getMessage() . "<br>";
    die();
}

try {
    echo "8. Attempting to test database connection<br>";
    $db = Database::getInstance();
    echo "9. ✓ Database instance created<br>";
    
    $test = $db->getValue("SELECT 1");
    echo "10. ✓ Database connection works<br>";
} catch (Exception $e) {
    echo "10. ✗ Database failed: " . $e->getMessage() . "<br>";
    die();
}

try {
    echo "11. Attempting to include functions.php<br>";
    require_once '../includes/functions.php';
    echo "12. ✓ Functions.php loaded<br>";
} catch (Exception $e) {
    echo "12. ✗ Functions.php failed: " . $e->getMessage() . "<br>";
    die();
}

try {
    echo "13. Testing getSetting function<br>";
    $siteName = getSetting('site_name', 'Test Site');
    echo "14. ✓ getSetting works: " . htmlspecialchars($siteName) . "<br>";
} catch (Exception $e) {
    echo "14. ✗ getSetting failed: " . $e->getMessage() . "<br>";
}

try {
    echo "15. Attempting to include UserAuth.php<br>";
    require_once 'includes/UserAuth.php';
    echo "16. ✓ UserAuth.php loaded<br>";
} catch (Exception $e) {
    echo "16. ✗ UserAuth.php failed: " . $e->getMessage() . "<br>";
    die();
}

try {
    echo "17. Attempting to create UserAuth instance<br>";
    $userAuth = new UserAuth();
    echo "18. ✓ UserAuth instance created<br>";
} catch (Exception $e) {
    echo "18. ✗ UserAuth instance failed: " . $e->getMessage() . "<br>";
}

echo "=== DEBUG END ===<br>";
echo "If you see this, all basic components are working!";
?>