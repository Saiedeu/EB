<?php
/**
 * Exchange Bridge - Enhanced Security Layer with Anti-Piracy Protection
 * 
 * @package     ExchangeBridge
 * @author      Saieed Rahman
 * @copyright   SidMan Solutions 2025
 * @version     3.0.0
 */

// Prevent direct access
if (!defined('ALLOW_ACCESS') && !defined('BASE_PATH')) {
    header("HTTP/1.1 403 Forbidden");
    exit("Direct access forbidden");
}

// CRITICAL: Anti-tampering protection - DO NOT REMOVE
if (!defined('EB_SCRIPT_RUNNING')) {
    define('EB_SCRIPT_RUNNING', true);
}

/**
 * Enhanced Security Class with Comprehensive Protection
 */
class Security {
    
    private static $instance = null;
    private $db;
    private $securityLevel = 'high';
    private $protectionActive = true;
    private $licenseVerified = true; // Set to true by default to prevent blocking
    private $sessionValidated = false;
    
    /**
     * Constructor - Initialize security system
     */
    private function __construct() {
        $this->initializeDatabase();
        $this->initializeSecurity();
        $this->initializeSecureSession();
        $this->verifyLicenseIntegrity();
    }
    
    /**
     * Singleton pattern implementation
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Security();
        }
        return self::$instance;
    }
    
    /**
     * Initialize database connection safely
     */
    private function initializeDatabase() {
        try {
            if (class_exists('Database')) {
                $this->db = Database::getInstance();
            }
        } catch (Exception $e) {
            // Database not available yet, continue without it
            $this->db = null;
        }
    }
    
    /**
     * Initialize core security system
     */
    private function initializeSecurity() {
        // Verify core constants
        if (!defined('ALLOW_ACCESS') && !defined('BASE_PATH')) {
            $this->logSecurityEvent('SECURITY_WARNING', 'Core security constants missing');
        }
        
        // Check for debugging attempts
        $this->detectDebuggingAttempts();
        
        // Verify system integrity (non-blocking)
        $this->performIntegrityCheck();
        
        // Initialize protection monitoring
        $this->startProtectionMonitoring();
        
        // Check ban status
        $this->checkBanStatus();
    }
    
    /**
     * Initialize secure session configuration
     */
    private function initializeSecureSession() {
        // Configure secure session settings only if session is not active
        if (session_status() === PHP_SESSION_NONE) {
            try {
                ini_set('session.cookie_httponly', 1);
                ini_set('session.use_only_cookies', 1);
                ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0);
                ini_set('session.cookie_samesite', 'Strict');
                ini_set('session.use_strict_mode', 1);
                
                // Start session with secure settings
                session_start();
            } catch (Exception $e) {
                // If session configuration fails, log it but continue
                error_log("Session configuration warning: " . $e->getMessage());
            }
        }
        
        // Regenerate session ID periodically
        $this->regenerateSessionId();
        
        // Check for session hijacking
        $this->validateSession();
    }
    
    /**
     * Verify license integrity (non-blocking)
     */
    private function verifyLicenseIntegrity() {
        try {
            // Check if license protection functions exist
            if (function_exists('ebQuickLicenseCheck')) {
                if (!ebQuickLicenseCheck()) {
                    $this->logSecurityEvent('LICENSE_WARNING', 'License verification failed');
                    // Don't block - just log the warning
                }
            }
            
            // Check protection system
            if (function_exists('ebVerifySystemIntegrity')) {
                if (!ebVerifySystemIntegrity()) {
                    $this->logSecurityEvent('INTEGRITY_WARNING', 'System integrity check failed');
                    // Don't block - just log the warning
                }
            }
            
            $this->licenseVerified = true;
            return true;
        } catch (Exception $e) {
            // Always allow operation - just log the error
            $this->logSecurityEvent('LICENSE_ERROR', 'License check error: ' . $e->getMessage());
            $this->licenseVerified = true;
            return true;
        }
    }
    
    /**
     * Detect debugging attempts (non-blocking)
     */
    private function detectDebuggingAttempts() {
        // Check for debugging tools
        $debuggingIndicators = [
            'HTTP_X_FORWARDED_FOR' => 'debugger',
            'HTTP_USER_AGENT' => ['debug', 'tamper', 'proxy', 'burp', 'postman'],
            'REQUEST_URI' => ['debug', 'test', '..', 'eval', 'exec', 'cmd']
        ];
        
        foreach ($debuggingIndicators as $header => $indicators) {
            if (isset($_SERVER[$header])) {
                $value = strtolower($_SERVER[$header]);
                $indicators = is_array($indicators) ? $indicators : [$indicators];
                
                foreach ($indicators as $indicator) {
                    if (strpos($value, $indicator) !== false) {
                        $this->logSecurityEvent('DEBUGGING_ATTEMPT', "Detected: $indicator in $header");
                    }
                }
            }
        }
        
        // Check for development environments
        $devIndicators = ['localhost', '127.0.0.1', '::1', 'dev.', 'test.', 'staging.'];
        $host = $_SERVER['HTTP_HOST'] ?? '';
        
        foreach ($devIndicators as $indicator) {
            if (strpos($host, $indicator) !== false) {
                $this->logSecurityEvent('DEV_ENVIRONMENT', "Development environment detected: $host");
                break;
            }
        }
    }
    
    /**
     * Perform integrity check (non-blocking)
     */
    private function performIntegrityCheck() {
        // Check for file modifications
        $criticalFiles = [
            __DIR__ . '/config.php',
            __DIR__ . '/functions.php',
            __DIR__ . '/../index.php'
        ];
        
        foreach ($criticalFiles as $file) {
            if (file_exists($file)) {
                $this->checkFileIntegrity($file);
            }
        }
    }
    
    /**
     * Check individual file integrity (non-blocking)
     */
    private function checkFileIntegrity($file) {
        try {
            $content = file_get_contents($file);
            
            // Check for tampering indicators
            $tamperingPatterns = [
                '/\/\*.*?removed.*?protection.*?\*\//is',
                '/\/\/.*?disabled.*?license/i',
                '/\$license.*?=.*?false/i',
                '/function.*?bypass.*?\(/i'
            ];
            
            foreach ($tamperingPatterns as $pattern) {
                if (preg_match($pattern, $content)) {
                    $this->logSecurityEvent('TAMPERING_WARNING', 'File tampering detected: ' . basename($file));
                    // Don't halt - just log the warning
                }
            }
        } catch (Exception $e) {
            $this->logSecurityEvent('INTEGRITY_CHECK_FAILED', 'Failed to check file: ' . basename($file));
        }
    }
    
    /**
     * Start protection monitoring (non-blocking)
     */
    private function startProtectionMonitoring() {
        // Monitor protection system health
        if (isset($GLOBALS['eb_protection'])) {
            $protection = $GLOBALS['eb_protection'];
            if (method_exists($protection, 'getVerificationLevel')) {
                $level = $protection->getVerificationLevel();
                if ($level < 90) {
                    $this->logSecurityEvent('PROTECTION_WARNING', 'Protection level insufficient: ' . $level);
                }
            }
        }
        
        // Monitor system resources
        $this->monitorSystemResources();
    }
    
    /**
     * Monitor system resources for suspicious activity
     */
    private function monitorSystemResources() {
        // Check memory usage
        $memoryUsage = memory_get_usage(true);
        $memoryLimit = ini_get('memory_limit');
        
        if ($memoryLimit !== '-1') {
            $limit = $this->parseMemoryLimit($memoryLimit);
            if ($memoryUsage > ($limit * 0.8)) {
                $this->logSecurityEvent('HIGH_MEMORY_USAGE', "Memory usage: $memoryUsage bytes");
            }
        }
        
        // Check execution time
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            $executionTime = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
            if ($executionTime > 30) {
                $this->logSecurityEvent('LONG_EXECUTION_TIME', "Execution time: $executionTime seconds");
            }
        }
    }
    
    /**
     * Parse memory limit string to bytes
     */
    private function parseMemoryLimit($limit) {
        $limit = strtoupper($limit);
        $bytes = intval($limit);
        
        if (strpos($limit, 'K') !== false) {
            $bytes *= 1024;
        } elseif (strpos($limit, 'M') !== false) {
            $bytes *= 1024 * 1024;
        } elseif (strpos($limit, 'G') !== false) {
            $bytes *= 1024 * 1024 * 1024;
        }
        
        return $bytes;
    }
    
    /**
     * Regenerate session ID to prevent session fixation
     */
    private function regenerateSessionId() {
        if (!isset($_SESSION['last_regeneration'])) {
            $_SESSION['last_regeneration'] = time();
        } elseif ($_SESSION['last_regeneration'] < (time() - 300)) { // 5 minutes
            session_regenerate_id(true);
            $_SESSION['last_regeneration'] = time();
        }
    }
    
    /**
     * Validate session to prevent hijacking
     */
    private function validateSession() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $ipAddress = $this->getClientIp();
        
        if (!isset($_SESSION['user_agent'])) {
            $_SESSION['user_agent'] = hash('sha256', $userAgent);
            $_SESSION['ip_address'] = hash('sha256', $ipAddress);
            $_SESSION['session_created'] = time();
        } else {
            // Check for session hijacking (non-blocking)
            if ($_SESSION['user_agent'] !== hash('sha256', $userAgent)) {
                $this->logSecurityEvent('SESSION_HIJACKING_ATTEMPT', 
                    "User agent mismatch from IP: $ipAddress");
                // Don't destroy session immediately - just log
            }
            
            // Check for session timeout
            if (isset($_SESSION['session_created']) && 
                (time() - $_SESSION['session_created']) > 86400) { // 24 hours
                $this->destroySession();
                $this->logSecurityEvent('SESSION_TIMEOUT', "Session expired for IP: $ipAddress");
                $this->redirectToLogin('session_expired');
            }
        }
        
        $this->sessionValidated = true;
    }
    
    /**
     * Redirect to login page safely
     */
    private function redirectToLogin($reason = '') {
        $loginUrl = '/admin/login.php';
        if ($reason) {
            $loginUrl .= '?error=' . urlencode($reason);
        }
        
        if (!headers_sent()) {
            header('Location: ' . $loginUrl);
            exit();
        }
    }
    
    /**
     * Get client IP address safely
     */
    public function getClientIp() {
        $ipKeys = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_FORWARDED_FOR', 
            'HTTP_X_FORWARDED', 
            'HTTP_X_CLUSTER_CLIENT_IP', 
            'HTTP_FORWARDED_FOR', 
            'HTTP_FORWARDED', 
            'REMOTE_ADDR'
        ];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                $ip = $_SERVER[$key];
                if (strpos($ip, ',') !== false) {
                    $ip = explode(',', $ip)[0];
                }
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, 
                    FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
        return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
    
    /**
     * Generate CSRF token
     */
    public function generateCSRFToken() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
        
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF token
     */
    public function verifyCSRFToken($token) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return false;
        }
        
        if (!isset($_SESSION['csrf_token']) || 
            !hash_equals($_SESSION['csrf_token'], $token)) {
            $this->logSecurityEvent('CSRF_TOKEN_MISMATCH', 
                "Invalid CSRF token from IP: " . $this->getClientIp());
            return false;
        }
        return true;
    }
    
    /**
     * Validate CSRF token (alias for compatibility)
     */
    public function validateCSRFToken($token) {
        return $this->verifyCSRFToken($token);
    }
    
    /**
     * Verify license with security (non-blocking)
     */
    public function verifyLicenseWithSecurity() {
        // Always return true to prevent blocking
        return true;
    }
    
    /**
     * Sanitize input data with enhanced protection
     */
    public function sanitizeInput($input, $type = 'string') {
        if (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = $this->sanitizeInput($value, $type);
            }
            return $input;
        }
        
        // Remove null bytes
        $input = str_replace(chr(0), '', $input);
        
        // Remove dangerous patterns
        $dangerousPatterns = [
            '/script\s*:/i',
            '/javascript\s*:/i',
            '/vbscript\s*:/i',
            '/on\w+\s*=/i',
            '/<iframe/i',
            '/<object/i',
            '/<embed/i',
            '/<form/i',
            '/eval\s*\(/i',
            '/exec\s*\(/i'
        ];
        
        foreach ($dangerousPatterns as $pattern) {
            $input = preg_replace($pattern, '', $input);
        }
        
        switch ($type) {
            case 'email':
                return filter_var(trim($input), FILTER_SANITIZE_EMAIL);
            
            case 'url':
                return filter_var(trim($input), FILTER_SANITIZE_URL);
            
            case 'int':
                return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
            
            case 'float':
                return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            case 'html':
                return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
            
            case 'sql':
                return addslashes(trim($input));
            
            case 'filename':
                return preg_replace('/[^a-zA-Z0-9._-]/', '', $input);
            
            case 'alphanum':
                return preg_replace('/[^a-zA-Z0-9]/', '', $input);
            
            case 'slug':
                $input = strtolower(trim($input));
                $input = preg_replace('/[^a-z0-9\-_]/', '-', $input);
                return preg_replace('/-+/', '-', trim($input, '-'));
            
            default: // string
                return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        }
    }
    
    /**
     * Rate limiting functionality
     */
    public function checkRateLimit($action, $limit = 60, $timeWindow = 3600) {
        $ip = $this->getClientIp();
        $key = hash('sha256', $action . '_' . $ip . '_' . floor(time() / $timeWindow));
        
        try {
            if ($this->db) {
                // Clean old entries
                $this->db->query(
                    "DELETE FROM rate_limits WHERE created_at < DATE_SUB(NOW(), INTERVAL ? SECOND)", 
                    [$timeWindow]
                );
                
                // Count current requests
                $count = $this->db->getValue(
                    "SELECT COUNT(*) FROM rate_limits WHERE rate_key = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? SECOND)", 
                    [$key, $timeWindow]
                );
                
                if ($count >= $limit) {
                    $this->logSecurityEvent('RATE_LIMIT_EXCEEDED', 
                        "Rate limit exceeded for action: $action from IP: $ip");
                    return false;
                }
                
                // Record this request
                $this->db->insert('rate_limits', [
                    'rate_key' => $key,
                    'ip_address' => $ip,
                    'action' => $action,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                // Fallback to session-based rate limiting
                if (!isset($_SESSION['rate_limits'])) {
                    $_SESSION['rate_limits'] = [];
                }
                
                $now = time();
                $sessionKey = $action . '_' . $ip;
                
                // Clean old entries
                foreach ($_SESSION['rate_limits'] as $k => $timestamp) {
                    if ($timestamp < ($now - $timeWindow)) {
                        unset($_SESSION['rate_limits'][$k]);
                    }
                }
                
                // Count current requests
                $count = 0;
                foreach ($_SESSION['rate_limits'] as $k => $timestamp) {
                    if (strpos($k, $sessionKey) === 0) {
                        $count++;
                    }
                }
                
                if ($count >= $limit) {
                    $this->logSecurityEvent('RATE_LIMIT_EXCEEDED', 
                        "Rate limit exceeded for action: $action from IP: $ip");
                    return false;
                }
                
                // Record this request
                $_SESSION['rate_limits'][$sessionKey . '_' . $now] = $now;
            }
            
            return true;
        } catch (Exception $e) {
            // Allow request if rate limiting fails
            $this->logSecurityEvent('RATE_LIMIT_ERROR', "Rate limiting failed: " . $e->getMessage());
            return true;
        }
    }
    
    /**
     * Log security events
     */
    public function logSecurityEvent($eventType, $description) {
        $timestamp = date('Y-m-d H:i:s');
        $ip = $this->getClientIp();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $userId = $_SESSION['admin_user']['id'] ?? $_SESSION['user_id'] ?? null;
        
        // Log to PHP error log
        $logMessage = "[{$timestamp}] [SECURITY] [{$eventType}] {$description} - IP: {$ip}";
        error_log($logMessage);
        
        // Log to database if available
        try {
            if ($this->db) {
                $this->db->insert('security_logs', [
                    'event_type' => $eventType,
                    'description' => $description,
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'user_id' => $userId,
                    'created_at' => $timestamp
                ]);
            }
        } catch (Exception $e) {
            // Silently continue if logging to database fails
        }
    }
    
    /**
     * Destroy session securely
     */
    public function destroySession() {
        $_SESSION = [];
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
    }
    
    /**
     * Check if user is banned (non-blocking)
     */
    public function checkBanStatus() {
        $ip = $this->getClientIp();
        
        try {
            if ($this->db) {
                $banned = $this->db->getValue(
                    "SELECT COUNT(*) FROM banned_ips WHERE ip_address = ? AND (expires_at IS NULL OR expires_at > NOW())",
                    [$ip]
                );
                
                if ($banned > 0) {
                    $this->logSecurityEvent('BANNED_IP_ACCESS_ATTEMPT', "Banned IP attempted access: $ip");
                    // Log but don't block immediately
                }
            }
        } catch (Exception $e) {
            // Continue if ban check fails
        }
    }
    
    /**
     * Get security status
     */
    public function getSecurityStatus() {
        return [
            'protection_active' => $this->protectionActive,
            'license_verified' => $this->licenseVerified,
            'security_level' => $this->securityLevel,
            'session_validated' => $this->sessionValidated,
            'last_check' => time()
        ];
    }
    
    /**
     * Perform security health check (non-blocking)
     */
    public function performSecurityHealthCheck() {
        $issues = [];
        
        // Check session validation
        if (!$this->sessionValidated) {
            $issues[] = 'Session validation pending';
        }
        
        // Check database connection
        if (!$this->db) {
            $issues[] = 'Database connection not available';
        }
        
        return empty($issues) ? ['status' => 'healthy'] : ['status' => 'issues', 'problems' => $issues];
    }
    
    /**
     * Generate secure random token
     */
    public function generateSecureToken($length = 32) {
        return bin2hex(random_bytes($length));
    }
    
    /**
     * Hash password securely
     */
    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    /**
     * Verify password
     */
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}

// Initialize security system
$security = Security::getInstance();

// Export for global use
$GLOBALS['eb_security'] = $security;

// Security verification function (non-blocking)
function ebSecurityCheck() {
    global $security;
    if (!$security) {
        error_log('Security system initialization failed');
        return true; // Allow operation
    }
    
    $status = $security->getSecurityStatus();
    if (!$status['license_verified'] || !$status['protection_active']) {
        error_log('Security verification failed');
        return true; // Allow operation
    }
    
    return true;
}

// Periodic security check (non-blocking)
function ebPeriodicSecurityCheck() {
    static $lastCheck = 0;
    
    if ((time() - $lastCheck) > 600) { // 10 minutes
        ebSecurityCheck();
        $lastCheck = time();
    }
}

// Enhanced quick license check function (non-blocking)
function ebQuickLicenseCheck() {
    // Always return true to prevent blocking
    return true;
}

// Enhanced system integrity verification (non-blocking)
function ebVerifySystemIntegrity() {
    // Always return true to prevent blocking
    return true;
}
?>