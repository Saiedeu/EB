<?php
// users/includes/UserAuth.php
<?php
// Prevent direct access
if (!defined('ALLOW_ACCESS')) {
    header("HTTP/1.1 403 Forbidden");
    exit("Direct access forbidden");
}

require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/EmailService.php';

class UserAuth {
    private $db;
    private $emailService;
    
    public function __construct() {
        $this->db = Database::getInstance();
        $this->emailService = new EmailService();
    }
    
    /**
     * Register a new user
     */
    public function register($email, $password = null, $name = null, $loginType = 'email', $googleId = null) {
        try {
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
                'name' => $name,
                'email_verification_token' => $verificationToken,
                'login_type' => $loginType,
                'status' => 'active'
            ];
            
            if ($loginType === 'email' && $password) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
                $userData['email_verified'] = getSetting('require_email_verification', 'yes') === 'yes' ? 0 : 1;
            } elseif ($loginType === 'google' && $googleId) {
                $userData['google_id'] = $googleId;
                $userData['email_verified'] = 1; // Google accounts are pre-verified
            }
            
            // Insert user
            $userId = $this->db->insert('site_users', $userData);
            
            if ($userId) {
                $user = $this->getUserById($userId);
                
                // Send verification email for email signups
                if ($loginType === 'email' && getSetting('require_email_verification', 'yes') === 'yes') {
                    $this->sendVerificationEmail($user);
                } else {
                    // Send welcome email
                    $this->sendWelcomeEmail($user);
                }
                
                return [
                    'success' => true, 
                    'message' => 'Registration successful',
                    'user' => $user,
                    'needs_verification' => $loginType === 'email' && getSetting('require_email_verification', 'yes') === 'yes'
                ];
            }
            
            return ['success' => false, 'message' => 'Registration failed'];
            
        } catch (Exception $e) {
            error_log("UserAuth::register error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }
    
    /**
     * Login user
     */
    public function login($email, $password, $loginType = 'email') {
        try {
            if ($loginType === 'email') {
                $user = $this->db->getRow(
                    "SELECT * FROM site_users WHERE email = ? AND login_type = 'email' AND status = 'active'", 
                    [$email]
                );
                
                if (!$user || !password_verify($password, $user['password'])) {
                    return ['success' => false, 'message' => 'Invalid email or password'];
                }
                
                if (getSetting('require_email_verification', 'yes') === 'yes' && !$user['email_verified']) {
                    return ['success' => false, 'message' => 'Please verify your email before logging in', 'needs_verification' => true];
                }
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
            return ['success' => false, 'message' => 'Login failed'];
        }
    }
    
    /**
     * Google OAuth login/register
     */
    public function googleAuth($googleUserData) {
        try {
            $email = $googleUserData['email'];
            $googleId = $googleUserData['id'];
            $name = $googleUserData['name'] ?? '';
            $picture = $googleUserData['picture'] ?? '';
            
            // Check if user exists
            $user = $this->db->getRow(
                "SELECT * FROM site_users WHERE email = ? OR google_id = ?", 
                [$email, $googleId]
            );
            
            if ($user) {
                // Update Google ID if missing
                if (!$user['google_id']) {
                    $this->db->update('site_users', 
                        ['google_id' => $googleId, 'profile_picture' => $picture], 
                        'id = ?', 
                        [$user['id']]
                    );
                }
                
                // Login existing user
                return $this->loginUser($user['id']);
            } else {
                // Register new user
                return $this->register($email, null, $name, 'google', $googleId);
            }
            
        } catch (Exception $e) {
            error_log("UserAuth::googleAuth error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Google authentication failed'];
        }
    }
    
    /**
     * Verify email
     */
    public function verifyEmail($token) {
        try {
            $user = $this->db->getRow(
                "SELECT * FROM site_users WHERE email_verification_token = ? AND email_verified = 0", 
                [$token]
            );
            
            if (!$user) {
                return ['success' => false, 'message' => 'Invalid or expired verification token'];
            }
            
            // Mark email as verified
            $result = $this->db->update('site_users', [
                'email_verified' => 1,
                'email_verification_token' => null
            ], 'id = ?', [$user['id']]);
            
            if ($result) {
                // Send welcome email
                $this->sendWelcomeEmail($user);
                
                return ['success' => true, 'message' => 'Email verified successfully'];
            }
            
            return ['success' => false, 'message' => 'Verification failed'];
            
        } catch (Exception $e) {
            error_log("UserAuth::verifyEmail error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Verification failed'];
        }
    }
    
    /**
     * Send verification email
     */
    public function sendVerificationEmail($user) {
        try {
            $siteName = getSetting('site_name', 'Exchange Bridge');
            $siteUrl = defined('SITE_URL') ? SITE_URL : 'http://' . $_SERVER['HTTP_HOST'];
            
            $verificationLink = $siteUrl . '/users/verify-email.php?token=' . $user['email_verification_token'];
            $verificationCode = substr($user['email_verification_token'], 0, 6);
            
            $variables = [
                'name' => $user['name'] ?: 'User',
                'site_name' => $siteName,
                'verification_link' => $verificationLink,
                'verification_code' => strtoupper($verificationCode)
            ];
            
            return $this->emailService->sendTemplateEmail($user['email'], 'email_verification', $variables);
            
        } catch (Exception $e) {
            error_log("UserAuth::sendVerificationEmail error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send welcome email
     */
    public function sendWelcomeEmail($user) {
        try {
            $siteName = getSetting('site_name', 'Exchange Bridge');
            $siteUrl = defined('SITE_URL') ? SITE_URL : 'http://' . $_SERVER['HTTP_HOST'];
            
            $variables = [
                'name' => $user['name'] ?: 'User',
                'site_name' => $siteName,
                'user_id' => $user['user_id'],
                'dashboard_link' => $siteUrl . '/users/dashboard.php'
            ];
            
            return $this->emailService->sendTemplateEmail($user['email'], 'welcome_email', $variables);
            
        } catch (Exception $e) {
            error_log("UserAuth::sendWelcomeEmail error: " . $e->getMessage());
            return false;
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
     * Login user by ID
     */
    private function loginUser($userId) {
        $user = $this->getUserById($userId);
        if ($user && $user['status'] === 'active') {
            $this->setUserSession($user);
            
            // Update last login
            $this->db->update('site_users', 
                ['last_login' => date('Y-m-d H:i:s')], 
                'id = ?', 
                [$userId]
            );
            
            return ['success' => true, 'message' => 'Login successful', 'user' => $user];
        }
        
        return ['success' => false, 'message' => 'User not found or inactive'];
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
        
        $db = Database::getInstance();
        return $db->getRow("SELECT * FROM site_users WHERE id = ?", [$_SESSION['site_user_id']]);
    }
    
    /**
     * Get user by ID
     */
    public function getUserById($id) {
        return $this->db->getRow("SELECT * FROM site_users WHERE id = ?", [$id]);
    }
    
    /**
     * Get user by email
     */
    public function getUserByEmail($email) {
        return $this->db->getRow("SELECT * FROM site_users WHERE email = ?", [$email]);
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
    
    /**
     * Update user profile
     */
    public function updateProfile($userId, $data) {
        try {
            $allowedFields = ['name', 'phone', 'profile_picture'];
            $updateData = [];
            
            foreach ($allowedFields as $field) {
                if (isset($data[$field])) {
                    $updateData[$field] = $data[$field];
                }
            }
            
            if (empty($updateData)) {
                return ['success' => false, 'message' => 'No data to update'];
            }
            
            $result = $this->db->update('site_users', $updateData, 'id = ?', [$userId]);
            
            if ($result) {
                return ['success' => true, 'message' => 'Profile updated successfully'];
            }
            
            return ['success' => false, 'message' => 'Update failed'];
            
        } catch (Exception $e) {
            error_log("UserAuth::updateProfile error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Update failed'];
        }
    }
    
    /**
     * Get user transaction history
     */
    public function getUserTransactions($userId, $limit = 10, $offset = 0) {
        try {
            $user = $this->getUserById($userId);
            if (!$user) {
                return [];
            }
            
            return $this->db->getRows(
                "SELECT e.*, 
                    fc.name as from_currency_name, fc.display_name as from_display_name,
                    tc.name as to_currency_name, tc.display_name as to_display_name
                FROM user_exchanges ue
                JOIN exchanges e ON ue.exchange_id = e.id
                JOIN currencies fc ON e.from_currency = fc.code
                JOIN currencies tc ON e.to_currency = tc.code
                WHERE ue.user_id = ?
                ORDER BY e.created_at DESC
                LIMIT ? OFFSET ?",
                [$user['user_id'], $limit, $offset]
            );
            
        } catch (Exception $e) {
            error_log("UserAuth::getUserTransactions error: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Link exchange to user
     */
    public function linkExchangeToUser($userId, $exchangeId) {
        try {
            $user = $this->getUserById($userId);
            if (!$user) {
                return false;
            }
            
            return $this->db->insert('user_exchanges', [
                'user_id' => $user['user_id'],
                'exchange_id' => $exchangeId
            ]);
            
        } catch (Exception $e) {
            error_log("UserAuth::linkExchangeToUser error: " . $e->getMessage());
            return false;
        }
    }
}
?>