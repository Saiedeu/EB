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
    private $licenseVerified = false;
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
            $this->triggerSecurityAlert('Core security constants missing');
        }
        
        // Check for debugging attempts
        $this->detectDebuggingAttempts();
        
        // Verify system integrity
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
        // Configure secure session settings
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0);
        ini_set('session.cookie_samesite', 'Strict');
        ini_set('session.use_strict_mode', 1);
        ini_set('session.entropy_length', 32);
        ini_set('session.hash_function', 'sha256');
        
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Regenerate session ID periodically
        $this->regenerateSessionId();
        
        // Check for session hijacking
        $this->validateSession();
    }
    
    /**
     * Verify license integrity
     */
    private function verifyLicenseIntegrity() {
        // Quick license verification - placeholder for future implementation
        try {
            // Check if license protection functions exist
            if (function_exists('ebQuickLicenseCheck')) {
                if (!ebQuickLicenseCheck()) {
                    $this->triggerSecurityAlert('License verification failed');
                    return false;
                }
            }
            
            // Check protection system
            if (function_exists('ebVerifySystemIntegrity')) {
                if (!ebVerifySystemIntegrity()) {
                    $this->triggerSecurityAlert('System integrity check failed');
                    return false;
                }
            }
            
            $this->licenseVerified = true;
            return true;
        } catch (Exception $e) {
            // For now, allow operation if license check fails
            $this->licenseVerified = true;
            return true;
        }
    }
    
    /**
     * Detect debugging attempts
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
     * Perform integrity check
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
     * Check individual file integrity
     */
    private function checkFileIntegrity($file) {
        try {
            $content = file_get_contents($file);
            
            // Check for tampering indicators
            $tamperingPatterns = [
                '/\/\*.*?removed.*?protection.*?\*\//is',
                '/\/\/.*?disabled.*?license/i',
                '/\$license.*?=.*?false/i',
                '/function.*?bypass.*?\(/i',
                '/eval\s*\(/i',
                '/base64_decode\s*\(/i'
            ];
            
            foreach ($tamperingPatterns as $pattern) {
                if (preg_match($pattern, $content)) {
                    $this->triggerSecurityAlert('File tampering detected: ' . basename($file));
                }
            }
        } catch (Exception $e) {
            $this->logSecurityEvent('INTEGRITY_CHECK_FAILED', 'Failed to check file: ' . basename($file));
        }
    }
    
    /**
     * Start protection monitoring
     */
    private function startProtectionMonitoring() {
        // Monitor protection system health
        if (isset($GLOBALS['eb_protection'])) {
            $protection = $GLOBALS['eb_protection'];
            if (method_exists($protection, 'getVerificationLevel')) {
                $level = $protection->getVerificationLevel();
                if ($level < 90) {
                    $this->triggerSecurityAlert('Protection level insufficient: ' . $level);
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
        $executionTime = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
        if ($executionTime > 30) {
            $this->logSecurityEvent('LONG_EXECUTION_TIME', "Execution time: $executionTime seconds");
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
            // Check for session hijacking
            if ($_SESSION['user_agent'] !== hash('sha256', $userAgent)) {
                $this->destroySession();
                $this->logSecurityEvent('SESSION_HIJACKING_ATTEMPT', 
                    "User agent mismatch from IP: $ipAddress");
                $this->redirectToLogin('session_invalid');
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
        
        header('Location: ' . $loginUrl);
        exit();
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
            session_start();
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
        if (!$this->licenseVerified) {
            return false;
        }
        
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
     * Sanitize input data with enhanced protection
     */
    public function sanitizeInput($input, $type = 'string') {
        if (!$this->licenseVerified) {
            return null;
        }
        
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
     * Validate input data
     */
    public function validateInput($input, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $input[$field] ?? null;
            
            // Required validation
            if (isset($rule['required']) && $rule['required'] && empty($value)) {
                $errors[$field] = ucfirst($field) . ' is required';
                continue;
            }
            
            if (empty($value)) continue;
            
            // Length validation
            if (isset($rule['min_length']) && strlen($value) < $rule['min_length']) {
                $errors[$field] = ucfirst($field) . ' must be at least ' . $rule['min_length'] . ' characters';
            }
            
            if (isset($rule['max_length']) && strlen($value) > $rule['max_length']) {
                $errors[$field] = ucfirst($field) . ' must not exceed ' . $rule['max_length'] . ' characters';
            }
            
            // Type validation
            if (isset($rule['type'])) {
                switch ($rule['type']) {
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $errors[$field] = 'Invalid email format';
                        }
                        break;
                    
                    case 'url':
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            $errors[$field] = 'Invalid URL format';
                        }
                        break;
                    
                    case 'int':
                        if (!filter_var($value, FILTER_VALIDATE_INT)) {
                            $errors[$field] = 'Must be a valid integer';
                        }
                        break;
                    
                    case 'float':
                        if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
                            $errors[$field] = 'Must be a valid number';
                        }
                        break;
                    
                    case 'phone':
                        if (!preg_match('/^[\+]?[0-9\-\(\)\s]+$/', $value)) {
                            $errors[$field] = 'Invalid phone number format';
                        }
                        break;
                    
                    case 'alphanumeric':
                        if (!preg_match('/^[a-zA-Z0-9]+$/', $value)) {
                            $errors[$field] = 'Must contain only letters and numbers';
                        }
                        break;
                    
                    case 'password':
                        $passwordErrors = $this->validatePasswordStrength($value);
                        if (!empty($passwordErrors)) {
                            $errors[$field] = implode(', ', $passwordErrors);
                        }
                        break;
                }
            }
            
            // Pattern validation
            if (isset($rule['pattern']) && !preg_match($rule['pattern'], $value)) {
                $errors[$field] = $rule['pattern_message'] ?? 'Invalid format';
            }
            
            // Custom validation
            if (isset($rule['custom']) && is_callable($rule['custom'])) {
                $customResult = $rule['custom']($value);
                if ($customResult !== true) {
                    $errors[$field] = $customResult;
                }
            }
        }
        
        return $errors;
    }
    
    /**
     * Rate limiting functionality
     */
    public function checkRateLimit($action, $limit = 60, $timeWindow = 3600) {
        if (!$this->licenseVerified) {
            return false;
        }
        
        $ip = $this->getClientIp();
        $key = hash('sha256', $action . '_' . $ip . '_' . floor(time() / $timeWindow));
        
        try {
            if ($this->db) {
                // Clean old entries
                $this->db->query(
                    "DELETE FROM " . (defined('DB_PREFIX') ? DB_PREFIX : '') . "rate_limits 
                     WHERE created_at < DATE_SUB(NOW(), INTERVAL ? SECOND)", 
                    [$timeWindow]
                );
                
                // Count current requests
                $count = $this->db->getValue(
                    "SELECT COUNT(*) FROM " . (defined('DB_PREFIX') ? DB_PREFIX : '') . "rate_limits 
                     WHERE rate_key = ? AND created_at > DATE_SUB(NOW(), INTERVAL ? SECOND)", 
                    [$key, $timeWindow]
                );
                
                if ($count >= $limit) {
                    $this->logSecurityEvent('RATE_LIMIT_EXCEEDED', 
                        "Rate limit exceeded for action: $action from IP: $ip");
                    return false;
                }
                
                // Record this request
                $this->db->insert((defined('DB_PREFIX') ? DB_PREFIX : '') . 'rate_limits', [
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
     * SQL Injection protection for dynamic queries
     */
    public function sanitizeForSQL($input) {
        if (is_array($input)) {
            return array_map([$this, 'sanitizeForSQL'], $input);
        }
        
        // Remove common SQL injection patterns
        $patterns = [
            '/(\s|^)(union|select|insert|update|delete|drop|create|alter|exec|execute)(\s|$)/i',
            '/(\s|^)(or|and)(\s|$)(\d+(\s|$)=(\s|$)\d+|true|false)/i',
            '/(\'|\"|`|;|--|\/\*|\*\/)/i',
            '/\b(char|ascii|substring|length|mid|user|database|version)\s*\(/i'
        ];
        
        foreach ($patterns as $pattern) {
            $input = preg_replace($pattern, '', $input);
        }
        
        return $input;
    }
    
    /**
     * XSS Protection
     */
    public function antiXSS($input) {
        if (is_array($input)) {
            return array_map([$this, 'antiXSS'], $input);
        }
        
        // Remove dangerous tags and attributes
        $input = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $input);
        $input = preg_replace('/<iframe\b[^<]*(?:(?!<\/iframe>)<[^<]*)*<\/iframe>/mi', '', $input);
        $input = preg_replace('/<object\b[^<]*(?:(?!<\/object>)<[^<]*)*<\/object>/mi', '', $input);
        $input = preg_replace('/<embed\b[^<]*(?:(?!<\/embed>)<[^<]*)*<\/embed>/mi', '', $input);
        $input = preg_replace('/on\w+\s*=\s*["\']?[^"\']*["\']?/i', '', $input);
        $input = preg_replace('/javascript:/i', '', $input);
        $input = preg_replace('/vbscript:/i', '', $input);
        $input = preg_replace('/data:/i', '', $input);
        
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * File upload security
     */
    public function validateFileUpload($file, $allowedTypes = [], $maxSize = 5242880) {
        $errors = [];
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'File upload error: ' . $file['error'];
            return $errors;
        }
        
        // Check file size
        if ($file['size'] > $maxSize) {
            $errors[] = 'File size exceeds maximum allowed size of ' . ($maxSize / 1024 / 1024) . 'MB';
        }
        
        // Check file type
        $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!empty($allowedTypes) && !in_array($fileType, $allowedTypes)) {
            $errors[] = 'Invalid file type. Allowed types: ' . implode(', ', $allowedTypes);
        }
        
        // Check MIME type
        $allowedMimes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'txt' => 'text/plain'
        ];
        
        if (isset($allowedMimes[$fileType])) {
            if (function_exists('finfo_open')) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);
                
                if ($mimeType !== $allowedMimes[$fileType]) {
                    $errors[] = 'File type mismatch. Expected: ' . $allowedMimes[$fileType] . ', Got: ' . $mimeType;
                }
            }
        }
        
        // Check for malicious content
        $content = file_get_contents($file['tmp_name'], false, null, 0, 1024); // Read first 1KB
        $maliciousPatterns = [
            '/<\?php/i',
            '/<script/i',
            '/javascript:/i',
            '/eval\s*\(/i',
            '/exec\s*\(/i',
            '/system\s*\(/i'
        ];
        
        foreach ($maliciousPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                $errors[] = 'Malicious content detected in file';
                break;
            }
        }
        
        // Check filename for suspicious patterns
        $filename = $file['name'];
        if (preg_match('/\.(php|phtml|php3|php4|php5|pl|py|jsp|asp|sh|cgi)$/i', $filename)) {
            $errors[] = 'Dangerous file extension detected';
        }
        
        return $errors;
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
                $this->db->insert((defined('DB_PREFIX') ? DB_PREFIX : '') . 'security_logs', [
                    'event_type' => $eventType,
                    'description' => $description,
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'user_id' => $userId,
                    'created_at' => $timestamp
                ]);
            }
        } catch (Exception $e) {
            error_log("Failed to log security event to database: " . $e->getMessage());
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
     * Check if user is banned
     */
    public function checkBanStatus() {
        $ip = $this->getClientIp();
        
        try {
            if ($this->db) {
                $banned = $this->db->getValue(
                    "SELECT COUNT(*) FROM " . (defined('DB_PREFIX') ? DB_PREFIX : '') . "banned_ips 
                     WHERE ip_address = ? AND (expires_at IS NULL OR expires_at > NOW())",
                    [$ip]
                );
                
                if ($banned > 0) {
                    $this->logSecurityEvent('BANNED_IP_ACCESS_ATTEMPT', "Banned IP attempted access: $ip");
                    http_response_code(403);
                    exit('Access denied: Your IP has been banned');
                }
            }
        } catch (Exception $e) {
            // Continue if ban check fails
        }
    }
    
    /**
     * Password strength validation
     */
    public function validatePasswordStrength($password) {
        $errors = [];
        
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long';
        }
        
        if (!preg_match('/[A-Z]/', $password)) {
            $errors[] = 'Password must contain at least one uppercase letter';
        }
        
        if (!preg_match('/[a-z]/', $password)) {
            $errors[] = 'Password must contain at least one lowercase letter';
        }
        
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = 'Password must contain at least one number';
        }
        
        if (!preg_match('/[^A-Za-z0-9]/', $password)) {
            $errors[] = 'Password must contain at least one special character';
        }
        
        // Check for common passwords
        $commonPasswords = [
            'password', '123456', '123456789', 'qwerty', 'abc123', 'password123',
            'admin', 'root', 'user', 'guest', 'test', 'demo'
        ];
        
        if (in_array(strtolower($password), $commonPasswords)) {
            $errors[] = 'Password is too common. Please choose a more secure password';
        }
        
        return $errors;
    }
    
    /**
     * Generate secure random token
     */
    public function generateSecureToken($length = 32) {
        if (!$this->licenseVerified) {
            return null;
        }
        
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
    
    /**
     * Trigger security alert
     */
    private function triggerSecurityAlert($reason) {
        $this->logSecurityEvent('SECURITY_ALERT', $reason);
        
        // If critical security violation, halt system
        $criticalViolations = [
            'License verification failed',
            'System integrity check failed',
            'File tampering detected'
        ];
        
        foreach ($criticalViolations as $violation) {
            if (strpos($reason, $violation) !== false) {
                http_response_code(403);
                exit('Critical security violation detected. System halted.');
            }
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
     * Perform security health check
     */
    public function performSecurityHealthCheck() {
        $issues = [];
        
        // Check license status
        if (!$this->licenseVerified) {
            $issues[] = 'License verification failed';
        }
        
        // Check session validation
        if (!$this->sessionValidated) {
            $issues[] = 'Session validation failed';
        }
        
        // Check protection system
        if (function_exists('ebVerifySystemIntegrity') && !ebVerifySystemIntegrity()) {
            $issues[] = 'Protection system compromised';
        }
        
        // Check configuration files
        $configFiles = [
            (defined('BASE_PATH') ? BASE_PATH : __DIR__ . '/..') . '/app/config/config.php'
        ];
        
        foreach ($configFiles as $file) {
            if (!file_exists($file)) {
                $issues[] = 'Missing configuration file: ' . basename($file);
            }
        }
        
        // Check database connection
        if (!$this->db) {
            $issues[] = 'Database connection not available';
        }
        
        return empty($issues) ? ['status' => 'healthy'] : ['status' => 'issues', 'problems' => $issues];
    }
    
    /**
     * Clean up old security logs
     */
    public function cleanupSecurityLogs($daysToKeep = 30) {
        try {
            if ($this->db) {
                $deleted = $this->db->query(
                    "DELETE FROM " . (defined('DB_PREFIX') ? DB_PREFIX : '') . "security_logs 
                     WHERE created_at < DATE_SUB(NOW(), INTERVAL ? DAY)",
                    [$daysToKeep]
                );
                
                $this->logSecurityEvent('LOGS_CLEANUP', "Cleaned up old security logs: $deleted records");
                return $deleted;
            }
        } catch (Exception $e) {
            $this->logSecurityEvent('CLEANUP_FAILED', "Failed to cleanup logs: " . $e->getMessage());
        }
        
        return false;
    }
    
    /**
     * Get security statistics
     */
    public function getSecurityStats($days = 7) {
        try {
            if ($this->db) {
                $stats = [];
                
                // Total events
                $stats['total_events'] = $this->db->getValue(
                    "SELECT COUNT(*) FROM " . (defined('DB_PREFIX') ? DB_PREFIX : '') . "security_logs 
                     WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)",
                    [$days]
                );
                
                // Events by type
                $eventTypes = $this->db->getRows(
                    "SELECT event_type, COUNT(*) as count 
                     FROM " . (defined('DB_PREFIX') ? DB_PREFIX : '') . "security_logs 
                     WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
                     GROUP BY event_type 
                     ORDER BY count DESC",
                    [$days]
                );
                
                $stats['events_by_type'] = $eventTypes;
                
                // Top IPs
                $topIPs = $this->db->getRows(
                    "SELECT ip_address, COUNT(*) as count 
                     FROM " . (defined('DB_PREFIX') ? DB_PREFIX : '') . "security_logs 
                     WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
                     GROUP BY ip_address 
                     ORDER BY count DESC 
                     LIMIT 10",
                    [$days]
                );
                
                $stats['top_ips'] = $topIPs;
                
                return $stats;
            }
        } catch (Exception $e) {
            $this->logSecurityEvent('STATS_ERROR', "Failed to get security stats: " . $e->getMessage());
        }
        
        return null;
    }
}

// Initialize security system
$security = Security::getInstance();

// Export for global use
$GLOBALS['eb_security'] = $security;

// Security verification function
function ebSecurityCheck() {
    global $security;
    if (!$security) {
        exit('Security system initialization failed');
    }
    
    $status = $security->getSecurityStatus();
    if (!$status['license_verified'] || !$status['protection_active']) {
        exit('Security verification failed');
    }
    
    return true;
}

// Periodic security check
function ebPeriodicSecurityCheck() {
    static $lastCheck = 0;
    
    if ((time() - $lastCheck) > 600) { // 10 minutes
        ebSecurityCheck();
        $lastCheck = time();
    }
}

// Enhanced quick license check function with domain verification and hash integrity
function ebQuickLicenseCheck() {
    $rootDir = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__);
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
        
        // Check hash integrity
        if (isset($verification['hash'], $verification['license_key'])) {
            $salt = defined('LICENSE_SALT') ? LICENSE_SALT : 'eb_license_system_salt_key_2023';
            $expectedHash = hash('sha256', $verification['license_key'] . $verification['domain'] . $salt);
            if (!hash_equals($expectedHash, $verification['hash'])) {
                return false;
            }
        }
        
        return true;
    } catch (Exception $e) {
        error_log('License check error: ' . $e->getMessage());
        return false;
    }
}

// Enhanced system integrity verification with critical file checks and health monitoring
function ebVerifySystemIntegrity() {
    global $security;
    
    if (!$security) {
        return false;
    }
    
    // Check security system status
    $status = $security->getSecurityStatus();
    if (!$status['protection_active'] || !$status['license_verified']) {
        return false;
    }
    
    // Check critical files
    $rootDir = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__);
    $criticalFiles = [
        $rootDir . '/config/install.lock',
        $rootDir . '/config/verification.php',
        $rootDir . '/includes/license_check.php',
        $rootDir . '/includes/license_protection.php',
        $rootDir . '/includes/security.php'
    ];
    
    foreach ($criticalFiles as $file) {
        if (!file_exists($file)) {
            $security->logSecurityEvent('CRITICAL_FILE_MISSING', 'Missing file: ' . basename($file));
            return false;
        }
    }
    
    // Check for system failure marker
    if (file_exists($rootDir . '/config/.system_failure')) {
        return false;
    }
    
    // Perform health check
    $healthCheck = $security->performSecurityHealthCheck();
    if ($healthCheck['status'] !== 'healthy') {
        return false;
    }
    
    return true;
}

// Register periodic check if function exists
if (function_exists('register_tick_function')) {
    register_tick_function('ebPeriodicSecurityCheck');
}

// Cleanup function
function ebSecurityCleanup() {
    global $security;
    if ($security) {
        $security->cleanupSecurityLogs();
    }
}

// Register cleanup on shutdown
if (function_exists('register_shutdown_function')) {
    register_shutdown_function('ebSecurityCleanup');
}
?>