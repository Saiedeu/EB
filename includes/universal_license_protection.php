<?php
/**
 * Application Protection Header
 * 
 * @package   ExchangeBridge
*. @author    Saieed Rahman
*  @copyright SidMan Solution 2025
 * @version   1.0.0
 */

// Prevent direct access if not already defined
if (!defined('EB_SCRIPT_RUNNING')) {
    define('EB_SCRIPT_RUNNING', true);
}

if (!defined('ALLOW_ACCESS')) {
    define('ALLOW_ACCESS', true);
}

/**
 * CRITICAL: Protection System with Security Integration
 * WARNING: Removal or modification of this code will disable the entire system
 */

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

// Critical files check
$criticalFiles = [
    $rootDir . '/config/install.lock',
    $rootDir . '/config/verification.php',
    $rootDir . '/includes/license_check.php',
    $rootDir . '/includes/license_protection.php',
    $rootDir . '/includes/security.php'
];

// Check for system failure
if (file_exists($rootDir . '/config/.system_failure')) {
    http_response_code(403);
    $failureData = @json_decode(file_get_contents($rootDir . '/config/.system_failure'), true);
    if (file_exists($rootDir . '/templates/license_error.php')) {
        $e = new Exception('System disabled: ' . ($failureData['reason'] ?? 'License violation'));
        include $rootDir . '/templates/license_error.php';
    } else {
        exit('System disabled due to license violation. Contact support.');
    }
    exit;
}

// Verify critical files exist
foreach ($criticalFiles as $file) {
    if (!file_exists($file)) {
        // Create system failure marker
        file_put_contents($rootDir . '/config/.system_failure', json_encode([
            'reason' => 'Critical file missing: ' . basename($file),
            'timestamp' => time(),
            'file' => $currentFile,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]));
        
        http_response_code(500);
        if (file_exists($rootDir . '/templates/license_error.php')) {
            $e = new Exception('System integrity compromised - Missing: ' . basename($file));
            include $rootDir . '/templates/license_error.php';
        } else {
            exit('System integrity compromised. Contact support.');
        }
        exit;
    }
}

// Load security system first
if (!class_exists('Security')) {
    require_once $rootDir . '/includes/security.php';
}

// Initialize security instance
$security = Security::getInstance();

// Load license protection if not already loaded
if (!class_exists('ExchangeBridgeProtection')) {
    require_once $rootDir . '/includes/license_protection.php';
}

if (!function_exists('verifyScriptLicense')) {
    require_once $rootDir . '/includes/license_check.php';
}

// Perform comprehensive security check
try {
    // 1. License verification
    if (!verifyScriptLicense()) {
        $security->logSecurityEvent('LICENSE_VERIFICATION_FAILED', 'License verification failed in ' . basename($currentFile));
        throw new Exception('License verification failed');
    }
    
    // 2. Security system check
    if (!ebSecurityCheck()) {
        $security->logSecurityEvent('SECURITY_CHECK_FAILED', 'Security check failed in ' . basename($currentFile));
        throw new Exception('Security check failed');
    }
    
    // 3. Protection system verification
    if (class_exists('ExchangeBridgeProtection')) {
        $protection = ExchangeBridgeProtection::getInstance();
        if (!$protection->isSystemProtected()) {
            $security->logSecurityEvent('PROTECTION_SYSTEM_FAILED', 'Protection system verification failed');
            throw new Exception('System protection verification failed');
        }
    }
    
    // 4. Perform security health check
    $healthCheck = $security->performSecurityHealthCheck();
    if ($healthCheck['status'] !== 'healthy') {
        $security->logSecurityEvent('HEALTH_CHECK_FAILED', 'Security health check failed: ' . implode(', ', $healthCheck['problems'] ?? []));
        // Don't halt for health check issues, just log
    }
    
} catch (Exception $e) {
    // Log security event
    error_log('[LICENSE/SECURITY] Verification failed in ' . $currentFile . ': ' . $e->getMessage());
    
    // Create system failure marker for critical issues
    if (strpos($e->getMessage(), 'License verification failed') !== false || 
        strpos($e->getMessage(), 'Security check failed') !== false) {
        
        file_put_contents($rootDir . '/config/.system_failure', json_encode([
            'reason' => $e->getMessage(),
            'timestamp' => time(),
            'file' => $currentFile,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]));
    }
    
    http_response_code(403);
    if (file_exists($rootDir . '/templates/license_error.php')) {
        include $rootDir . '/templates/license_error.php';
    } else {
        exit('Security verification failed. Contact support.');
    }
    exit;
}

/**
 * Enhanced security functions integrated with Security class
 */
function ebSecurityCheck() {
    global $security;
    
    if (!$security) {
        return false;
    }
    
    // Check security status
    $status = $security->getSecurityStatus();
    if (!$status['protection_active']) {
        return false;
    }
    
    // Anti-tampering check
    $suspiciousPatterns = [
        '/\/\*.*?bypass.*?license.*?\*\//is',
        '/\/\/.*?nulled.*?script/i',
        '/function\s+crack_license/i',
        '/\$license.*?=.*?true/i',
        '/define.*?bypass.*?license/i',
        '/remove.*?protection/i'
    ];
    
    $currentFile = $_SERVER['SCRIPT_FILENAME'] ?? __FILE__;
    if (file_exists($currentFile)) {
        $content = file_get_contents($currentFile);
        foreach ($suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                $security->logSecurityEvent('TAMPERING_DETECTED', 'Suspicious pattern found in ' . basename($currentFile));
                return false;
            }
        }
    }
    
    return true;
}

function ebPeriodicSecurityCheck() {
    static $lastCheck = 0;
    global $security;
    
    if ((time() - $lastCheck) > 300) { // Check every 5 minutes
        $lastCheck = time();
        
        if (!ebSecurityCheck()) {
            // Trigger system failure
            $rootDir = dirname(dirname(__FILE__));
            file_put_contents($rootDir . '/config/.system_failure', json_encode([
                'reason' => 'Periodic security check failed - tampering detected',
                'timestamp' => time(),
                'file' => $_SERVER['SCRIPT_FILENAME'] ?? 'unknown',
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
            ]));
            
            $security->logSecurityEvent('PERIODIC_CHECK_FAILED', 'Periodic security check detected tampering');
        }
        
        // License background check
        if (function_exists('performBackgroundLicenseCheck')) {
            if (!performBackgroundLicenseCheck()) {
                $security->logSecurityEvent('BACKGROUND_LICENSE_CHECK_FAILED', 'Background license check failed');
            }
        }
    }
}

function ebQuickLicenseCheck() {
    $rootDir = dirname(dirname(__FILE__));
    $verificationFile = $rootDir . '/config/verification.php';
    
    if (!file_exists($verificationFile)) {
        return false;
    }
    
    try {
        $verification = include $verificationFile;
        if (!is_array($verification)) {
            return false;
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
        return false;
    }
}

function ebVerifySystemIntegrity() {
    global $security;
    
    if (!$security) {
        return false;
    }
    
    // Perform comprehensive integrity check
    $healthCheck = $security->performSecurityHealthCheck();
    if ($healthCheck['status'] !== 'healthy') {
        return false;
    }
    
    // Check protection system
    if (class_exists('ExchangeBridgeProtection')) {
        $protection = ExchangeBridgeProtection::getInstance();
        return $protection->isSystemProtected();
    }
    
    return true;
}

// Execute immediate security verification
if (!ebSecurityCheck()) {
    $rootDir = dirname(dirname(__FILE__));
    file_put_contents($rootDir . '/config/.system_failure', json_encode([
        'reason' => 'Initial security check failed',
        'timestamp' => time(),
        'file' => $_SERVER['SCRIPT_FILENAME'] ?? 'unknown',
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
    ]));
    
    http_response_code(403);
    if (file_exists($rootDir . '/templates/license_error.php')) {
        $e = new Exception('Security check failed');
        include $rootDir . '/templates/license_error.php';
    } else {
        exit('Security check failed. Contact support.');
    }
    exit;
}

// Register periodic monitoring
if (function_exists('register_tick_function')) {
    register_tick_function('ebPeriodicSecurityCheck');
}
?>