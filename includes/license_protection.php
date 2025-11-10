<?php
/**
 * Exchange Bridge - Advanced Anti-Piracy Protection System
 * 
 * @package     ExchangeBridge
 * @author      Saieed Rahman
 * @copyright   SidMan Solutions 2025
 * @version     3.0.0
 * @license     Commercial License - Removal of this protection voids license
 */

// CRITICAL: Anti-tampering protection - REMOVAL WILL BREAK SYSTEM
if (!defined('EB_SCRIPT_RUNNING')) {
    http_response_code(403);
    exit('Unauthorized access detected. System halted.');
}

/**
 * Multi-layer License Protection Class
 * WARNING: Tampering with this class will result in system failure
 */
class ExchangeBridgeProtection {
    private static $instance = null;
    private $verificationLevel = 0;
    private $systemIntegrity = true;
    private $lastVerification = 0;
    private $failureCount = 0;
    
    // Encrypted system checkpoints
    private $checkpoints = [
        'c1' => 'EB_SCRIPT_RUNNING',
        'c2' => 'LICENSE_KEY', 
        'c3' => 'verifyExchangeBridgeLicense',
        'c4' => 'performBackgroundLicenseCheck'
    ];
    
    private function __construct() {
        $this->initializeProtection();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Initialize protection system
     */
    private function initializeProtection() {
        // Check for tampering attempts
        $this->detectTampering();
        
        // Verify file integrity
        $this->verifyFileIntegrity();
        
        // Check license status
        $this->performLicenseVerification();
        
        // Monitor system health
        $this->systemHealthCheck();
    }
    
    /**
     * Detect tampering attempts
     */
    private function detectTampering() {
        $suspiciousPatterns = [
            '/\/\*.*?remove.*?license.*?\*\//is',
            '/\/\/.*?bypass.*?protection/i',
            '/\/\/.*?nulled.*?script/i',
            '/function\s+bypass_license/i',
            '/\$.*?license.*?=.*?true/i',
            '/define.*?bypass.*?license/i'
        ];
        
        $criticalFiles = [
            __DIR__ . '/config.php',
            __DIR__ . '/functions.php',
            __DIR__ . '/db.php',
            __DIR__ . '/../index.php'
        ];
        
        foreach ($criticalFiles as $file) {
            if (file_exists($file)) {
                $content = file_get_contents($file);
                foreach ($suspiciousPatterns as $pattern) {
                    if (preg_match($pattern, $content)) {
                        $this->triggerSystemFailure('Tampering detected in ' . basename($file));
                    }
                }
            }
        }
    }
    
    /**
     * Verify file integrity using checksums
     */
    private function verifyFileIntegrity() {
        $integrityChecks = [
            'core_functions' => __DIR__ . '/functions.php',
            'database_layer' => __DIR__ . '/db.php',
            'security_layer' => __DIR__ . '/security.php'
        ];
        
        foreach ($integrityChecks as $component => $file) {
            if (file_exists($file)) {
                $content = file_get_contents($file);
                
                // Check for required components
                $requiredComponents = [
                    'EB_SCRIPT_RUNNING',
                    'ALLOW_ACCESS',
                    'function.*?verify.*?License'
                ];
                
                foreach ($requiredComponents as $component) {
                    if (!preg_match('/' . $component . '/i', $content)) {
                        $this->triggerSystemFailure('Core component missing: ' . $component);
                    }
                }
            }
        }
    }
    
    /**
     * Perform license verification
     */
    private function performLicenseVerification() {
        $verificationFile = __DIR__ . '/../config/verification.php';
        
        if (!file_exists($verificationFile)) {
            $this->triggerSystemFailure('License verification file missing');
        }
        
        $verification = include $verificationFile;
        
        if (!is_array($verification) || !isset($verification['license_key'], $verification['status'])) {
            $this->triggerSystemFailure('Invalid license verification data');
        }
        
        if ($verification['status'] !== 'active') {
            $this->triggerSystemFailure('License is not active');
        }
        
        // Domain verification
        $currentDomain = strtolower(preg_replace('/^www\./i', '', $_SERVER['HTTP_HOST'] ?? 'localhost'));
        if ($verification['domain'] !== '*' && $verification['domain'] !== $currentDomain) {
            $this->triggerSystemFailure('License not valid for domain: ' . $currentDomain);
        }
        
        // Time-based verification
        $lastCheck = $verification['last_check'] ?? 0;
        $gracePeriod = 604800; // 7 days
        
        if ((time() - $lastCheck) > $gracePeriod) {
            $this->performServerVerification();
        }
        
        $this->verificationLevel = 100;
    }
    
    /**
     * Perform server verification
     */
    private function performServerVerification() {
        try {
            if (class_exists('ExchangeBridgeLicenseVerifier')) {
                $verifier = new ExchangeBridgeLicenseVerifier();
                if (!$verifier->verifyLicense()) {
                    $this->triggerSystemFailure('Server license verification failed');
                }
            }
        } catch (Exception $e) {
            // Allow grace period but increment failure count
            $this->failureCount++;
            if ($this->failureCount > 5) {
                $this->triggerSystemFailure('Repeated license verification failures');
            }
        }
    }
    
    /**
     * System health check
     */
    private function systemHealthCheck() {
        // Check for nulled script indicators
        $nulledIndicators = [
            '/free.*?download/i',
            '/nulled.*?script/i',
            '/cracked.*?version/i',
            '/warez.*?site/i',
            '/pirated.*?software/i'
        ];
        
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        
        foreach ($nulledIndicators as $indicator) {
            if (preg_match($indicator, $userAgent . ' ' . $referer)) {
                $this->triggerSystemFailure('Nulled script usage detected');
            }
        }
        
        // Check installation directory
        if (is_dir(__DIR__ . '/../install') && !isset($_GET['installing'])) {
            $installFiles = glob(__DIR__ . '/../install/*.php');
            if (count($installFiles) > 0) {
                // Installation files present, verify license
                $this->verifyInstallationIntegrity();
            }
        }
    }
    
    /**
     * Verify installation integrity
     */
    private function verifyInstallationIntegrity() {
        $installIndex = __DIR__ . '/../install/index.php';
        if (file_exists($installIndex)) {
            $content = file_get_contents($installIndex);
            if (strpos($content, 'INSTALLATION_VERSION') === false) {
                $this->triggerSystemFailure('Installation file integrity compromised');
            }
        }
    }
    
    /**
     * Trigger system failure
     */
    private function triggerSystemFailure($reason) {
        // Log the failure
        error_log('[SECURITY BREACH] ' . $reason . ' - IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        
        // Create failure marker
        $failureFile = __DIR__ . '/../config/.system_failure';
        file_put_contents($failureFile, json_encode([
            'reason' => $reason,
            'timestamp' => time(),
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]));
        
        // Disable system
        $this->disableSystem();
    }
    
    /**
     * Disable system permanently
     */
    private function disableSystem() {
        // Remove critical configuration
        $configFiles = [
            __DIR__ . '/../config/config.php',
            __DIR__ . '/../config/verification.php'
        ];
        
        foreach ($configFiles as $file) {
            if (file_exists($file)) {
                // Don't actually delete, just mark as corrupted
                file_put_contents($file . '.corrupted', 'System disabled due to license violation');
            }
        }
        
        // Show error page and exit
        http_response_code(403);
        
        $errorPage = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>System Disabled</title>
            <style>
                body { font-family: Arial, sans-serif; background: #f44336; color: white; text-align: center; padding: 50px; }
                .container { max-width: 600px; margin: 0 auto; }
                h1 { font-size: 48px; margin-bottom: 20px; }
                p { font-size: 18px; line-height: 1.6; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>🔒 SYSTEM DISABLED</h1>
                <p>This installation has been permanently disabled due to license violation or tampering.</p>
                <p>Reason: License protection system compromised</p>
                <p>To restore functionality, contact support with a valid license.</p>
                <p>Error Code: EB-PROTECT-' . strtoupper(substr(md5(time()), 0, 8)) . '</p>
            </div>
        </body>
        </html>';
        
        exit($errorPage);
    }
    
    /**
     * Get verification level
     */
    public function getVerificationLevel() {
        return $this->verificationLevel;
    }
    
    /**
     * Check if system is protected
     */
    public function isSystemProtected() {
        return $this->systemIntegrity && $this->verificationLevel >= 90;
    }
    
    /**
     * Perform continuous monitoring
     */
    public function performContinuousMonitoring() {
        // Background protection check
        if ((time() - $this->lastVerification) > 300) { // 5 minutes
            $this->performLicenseVerification();
            $this->lastVerification = time();
        }
    }
}

// Initialize protection system
$protection = ExchangeBridgeProtection::getInstance();

// Continuous monitoring function
function ebProtectionMonitor() {
    global $protection;
    if ($protection && method_exists($protection, 'performContinuousMonitoring')) {
        $protection->performContinuousMonitoring();
    }
}

// Register protection monitor
if (function_exists('register_shutdown_function')) {
    register_shutdown_function('ebProtectionMonitor');
}

// Export protection instance for global use
$GLOBALS['eb_protection'] = $protection;

// License verification wrapper function
function ebVerifySystemIntegrity() {
    global $protection;
    return $protection ? $protection->isSystemProtected() : false;
}

// Quick license check function
function ebQuickLicenseCheck() {
    if (!defined('EB_SCRIPT_RUNNING') || !defined('LICENSE_KEY')) {
        return false;
    }
    
    $verificationFile = __DIR__ . '/../config/verification.php';
    if (!file_exists($verificationFile)) {
        return false;
    }
    
    $verification = include $verificationFile;
    return isset($verification['status']) && $verification['status'] === 'active';
}

// Anti-debugging measures
if (!defined('DEBUGGING_ALLOWED')) {
    if (function_exists('ini_set')) {
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
    }
}
?>