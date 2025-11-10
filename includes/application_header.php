<?php
/**
 * Application Protection Header
 * 
 * @package   ExchangeBridge
 * @author    Saieed Rahman
 * @copyright SidMan Solution 2025
 * @version   1.0.0
 */

// Prevent direct access if not already defined
if (!defined('EB_SCRIPT_RUNNING')) {
    define('EB_SCRIPT_RUNNING', true);
}

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define access constant only if not already defined
if (!defined('ALLOW_ACCESS')) {
    define('ALLOW_ACCESS', true);
}

// Get current file path for context
$currentFile = $_SERVER['SCRIPT_FILENAME'] ?? __FILE__;
$currentDir = dirname($currentFile);

// Determine root directory (adjust path depth as needed)
$rootDir = $currentDir;
$maxDepth = 5; // Maximum directory depth to search
$depth = 0;

while ($depth < $maxDepth && !file_exists($rootDir . '/config/install.lock')) {
    $rootDir = dirname($rootDir);
    $depth++;
}

// Define BASE_PATH if not already defined
if (!defined('BASE_PATH')) {
    define('BASE_PATH', $rootDir);
}

// Critical files check
$criticalFiles = [
    $rootDir . '/config/config.php'
];

// Check for system failure
if (file_exists($rootDir . '/config/.system_failure')) {
    http_response_code(403);
    $failureData = @json_decode(file_get_contents($rootDir . '/config/.system_failure'), true);
    showSystemFailureMessage($failureData['reason'] ?? 'System disabled');
    exit;
}

// Include core configuration first
if (file_exists($rootDir . '/config/config.php')) {
    require_once $rootDir . '/config/config.php';
} else {
    showSystemFailureMessage('Configuration file missing');
    exit;
}

// Include database class
if (file_exists($rootDir . '/includes/db.php')) {
    require_once $rootDir . '/includes/db.php';
}

// Include functions
if (file_exists($rootDir . '/includes/functions.php')) {
    require_once $rootDir . '/includes/functions.php';
}

// Load security system
if (file_exists($rootDir . '/includes/security.php') && !class_exists('Security')) {
    require_once $rootDir . '/includes/security.php';
}

/**
 * Enhanced security functions
 */
if (!function_exists('ebSecurityCheck')) {
    function ebSecurityCheck() {
        // Basic security check
        if (isset($_GET['bypass']) || isset($_POST['bypass']) || isset($_GET['debug']) || isset($_POST['debug'])) {
            return false;
        }
        return true;
    }
}

if (!function_exists('ebPeriodicSecurityCheck')) {
    function ebPeriodicSecurityCheck() {
        static $lastCheck = 0;
        
        if ((time() - $lastCheck) > 300) { // Check every 5 minutes
            $lastCheck = time();
            return ebSecurityCheck();
        }
        return true;
    }
}

if (!function_exists('ebQuickLicenseCheck')) {
    function ebQuickLicenseCheck() {
        $rootDir = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__);
        $verificationFile = $rootDir . '/config/verification.php';
        
        if (!file_exists($verificationFile)) {
            return true; // Allow if no license file exists
        }
        
        try {
            $verification = include $verificationFile;
            if (!is_array($verification)) {
                return true;
            }
            
            // Check basic requirements
            if (!isset($verification['status']) || $verification['status'] !== 'active') {
                return false;
            }
            
            // Check domain
            $currentDomain = strtolower(preg_replace('/^www\./i', '', $_SERVER['HTTP_HOST'] ?? 'localhost'));
            if (isset($verification['domain']) && $verification['domain'] !== '*' && $verification['domain'] !== $currentDomain) {
                return false;
            }
            
            // Check expiration
            if (isset($verification['expires']) && $verification['expires'] && $verification['expires'] < time()) {
                return false;
            }
            
            return true;
        } catch (Exception $e) {
            return true; // Allow on error
        }
    }
}

if (!function_exists('ebVerifySystemIntegrity')) {
    function ebVerifySystemIntegrity() {
        // Basic integrity check
        $rootDir = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__);
        
        // Check for system failure marker
        if (file_exists($rootDir . '/config/.system_failure')) {
            return false;
        }
        
        return true;
    }
}

if (!function_exists('verifyScriptLicense')) {
    function verifyScriptLicense() {
        return ebQuickLicenseCheck();
    }
}

if (!function_exists('verifyMainPageAccess')) {
    function verifyMainPageAccess() {
        try {
            // Check for installation lock
            $rootDir = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__);
            if (!file_exists($rootDir . '/config/install.lock')) {
                return false;
            }
            
            // Check for system failure marker
            if (file_exists($rootDir . '/config/.system_failure')) {
                return false;
            }
            
            return true;
        } catch (Exception $e) {
            error_log('Main page access verification failed: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('showSystemFailureMessage')) {
    function showSystemFailureMessage($message) {
        echo '<!DOCTYPE html><html><head><title>System Error</title>
        <style>body{font-family:Arial,sans-serif;background:#f44336;color:white;text-align:center;padding:50px}
        .container{max-width:600px;margin:0 auto}h1{font-size:48px}p{font-size:18px}</style>
        </head><body><div class="container">
        <h1>🔒 SYSTEM ERROR</h1>
        <p>' . htmlspecialchars($message) . '</p>
        <p>Please contact support for assistance.</p>
        </div></body></html>';
    }
}

if (!function_exists('showLicenseError')) {
    function showLicenseError($rootDir, $message = 'License verification failed') {
        http_response_code(403);
        showSystemFailureMessage($message);
        exit;
    }
}

// Perform basic security checks
try {
    // Execute security verification
    if (!ebSecurityCheck()) {
        throw new Exception('Security check failed');
    }
    
    // Quick license check
    if (!ebQuickLicenseCheck()) {
        throw new Exception('License verification failed');
    }
    
    // System integrity check
    if (!ebVerifySystemIntegrity()) {
        throw new Exception('System integrity check failed');
    }
    
} catch (Exception $e) {
    // Log error
    error_log('[LICENSE/SECURITY] Verification failed: ' . $e->getMessage());
    
    // Create system failure marker for critical issues
    if (strpos($e->getMessage(), 'License verification failed') !== false || 
        strpos($e->getMessage(), 'Security check failed') !== false) {
        
        $rootDir = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__);
        @file_put_contents($rootDir . '/config/.system_failure', json_encode([
            'reason' => $e->getMessage(),
            'timestamp' => time(),
            'file' => $currentFile,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]));
    }
    
    showLicenseError($rootDir, $e->getMessage());
    exit;
}

// Register periodic monitoring if function exists
if (function_exists('register_tick_function')) {
    register_tick_function('ebPeriodicSecurityCheck');
}
?>