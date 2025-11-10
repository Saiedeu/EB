<?php
// users/includes/UserAuth.php
<?php
// Prevent direct access
if (!defined('ALLOW_ACCESS')) {
    header("HTTP/1.1 403 Forbidden");
    exit("Direct access forbidden");
}

class UserAuth {
    private $db;
    
    public function __construct() {
        try {
            $this->db = Database::getInstance();
        } catch (Exception $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
    
    /**
     * Login user
     */
    public function login($email, $password) {
        try {
            // Check if site_users table exists
            $tableExists = $this->db->getValue("SHOW TABLES LIKE 'site_users'");
            if (!$tableExists) {
                return ['success' => false, 'message' => 'User system not installed. Please run database migration.'];
            }
            
            $user = $this->db->getRow(
                "SELECT * FROM site_users WHERE email = ? AND status = 'active'", 
                [$email]
            );
            
            if (!$user) {
                return ['success' => false, 'message' => 'Invalid email or password'];
            }
            
            // For email login, verify password
            if ($user['login_type'] === 'email' && !password_verify($password, $user['password'])) {
                return ['success' => false, 'message' => 'Invalid email or password'];
            }
            
            // Check email verification
            if (getSetting('require_email_verification', 'yes') === 'yes' && !$user['email_verified']) {
                return ['success' => false, 'message' => 'Please verify your email before logging in'];
            }
            
            // Update last login
            $this->db->update('site_users', 
                ['last_login' => date('Y-m-d H:i:s')], 
                'id = ?', 
                [$user['id']]
            );
            
            // Set session
            $this->setUserSession($user);
            
            return ['success' => true, 'message' => 'Login successful', 'user' => $user];
            
        } catch (Exception $e) {
            error_log("UserAuth::login error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Login failed: ' . $e->getMessage()];
        }
    }
    
    /**
     * Register user
     */
    public function register($email, $password, $name = null) {
        try {
            // Check if site_users table exists
            $tableExists = $this->db->getValue("SHOW TABLES LIKE 'site_users'");
            if (!$tableExists) {
                return ['success' => false, 'message' => 'User system not installed. Please run database migration.'];
            }
            
            // Check if email already exists
            $existingUser = $this->db->getRow(
                "SELECT id FROM site_users WHERE email = ?", 
                [$email]
            );
            
            if ($existingUser) {
                return ['success' => false, 'message' => 'Email already registered'];
            }
            
            // Generate verification token
            $verificationToken = bin2hex(random_bytes(32));
            
            // Prepare user data
            $userData = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'name' => $name,
                'email_verification_token' => $verificationToken,
                'email_verified' => getSetting('require_email_verification', 'yes') === 'yes' ? 0 : 1,
                'login_type' => 'email',
                'status' => 'active'
            ];
            
            // Insert user
            $userId = $this->db->insert('site_users', $userData);
            
            if ($userId) {
                $user = $this->getUserById($userId);
                
                return [
                    'success' => true, 
                    'message' => 'Registration successful',
                    'user' => $user,
                    'needs_verification' => getSetting('require_email_verification', 'yes') === 'yes'
                ];
            }
            
            return ['success' => false, 'message' => 'Registration failed'];
            
        } catch (Exception $e) {
            error_log("UserAuth::register error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()];
        }
    }
    
    /**
     * Set user session
     */
    private function setUserSession($user) {
        $_SESSION['site_user_id'] = $user['id'];
        $_SESSION['site_user_uid'] = $user['user_id'];
        $_SESSION['site_user_email'] = $user['email'];
        $_SESSION['site_user_name'] = $user['name'];
        $_SESSION['site_user_logged_in'] = true;
    }
    
    /**
     * Check if user is logged in
     */
    public static function isLoggedIn() {
        return isset($_SESSION['site_user_logged_in']) && $_SESSION['site_user_logged_in'] === true;
    }
    
    /**
     * Get current user
     */
    public static function getCurrentUser() {
        if (!self::isLoggedIn()) {
            return null;
        }
        
        try {
            $db = Database::getInstance();
            return $db->getRow("SELECT * FROM site_users WHERE id = ?", [$_SESSION['site_user_id']]);
        } catch (Exception $e) {
            return null;
        }
    }
    
    /**
     * Get user by ID
     */
    public function getUserById($id) {
        return $this->db->getRow("SELECT * FROM site_users WHERE id = ?", [$id]);
    }
    
    /**
     * Logout user
     */
    public static function logout() {
        // Unset user session variables
        unset($_SESSION['site_user_id']);
        unset($_SESSION['site_user_uid']);
        unset($_SESSION['site_user_email']);
        unset($_SESSION['site_user_name']);
        unset($_SESSION['site_user_logged_in']);
        
        return true;
    }
}
?>