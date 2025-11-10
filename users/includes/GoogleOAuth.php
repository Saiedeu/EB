<?php
// users/includes/GoogleOAuth.php
<?php
// Prevent direct access
if (!defined('ALLOW_ACCESS')) {
    header("HTTP/1.1 403 Forbidden");
    exit("Direct access forbidden");
}

class GoogleOAuth {
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    
    public function __construct() {
        $this->clientId = getSetting('google_client_id', '');
        $this->clientSecret = getSetting('google_client_secret', '');
        $this->redirectUri = $this->getRedirectUri();
    }
    
    /**
     * Get redirect URI
     */
    private function getRedirectUri() {
        $siteUrl = defined('SITE_URL') ? SITE_URL : 'http://' . $_SERVER['HTTP_HOST'];
        return $siteUrl . '/users/google-callback.php';
    }
    
    /**
     * Get Google login URL
     */
    public function getLoginUrl() {
        if (!$this->clientId) {
            return false;
        }
        
        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'scope' => 'email profile',
            'response_type' => 'code',
            'access_type' => 'online',
            'state' => bin2hex(random_bytes(16))
        ];
        
        // Store state in session for verification
        $_SESSION['google_oauth_state'] = $params['state'];
        
        return 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($params);
    }
    
    /**
     * Handle Google callback
     */
    public function handleCallback($code, $state) {
        try {
            // Verify state
            if (!isset($_SESSION['google_oauth_state']) || $_SESSION['google_oauth_state'] !== $state) {
                throw new Exception('Invalid state parameter');
            }
            
            // Unset state
            unset($_SESSION['google_oauth_state']);
            
            // Exchange code for access token
            $tokenData = $this->getAccessToken($code);
            if (!$tokenData) {
                throw new Exception('Failed to get access token');
            }
            
            // Get user data
            $userData = $this->getUserData($tokenData['access_token']);
            if (!$userData) {
                throw new Exception('Failed to get user data');
            }
            
            return ['success' => true, 'user_data' => $userData];
            
        } catch (Exception $e) {
            error_log("GoogleOAuth::handleCallback error: " . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    /**
     * Get access token
     */
    private function getAccessToken($code) {
        $postData = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code',
            'code' => $code
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        
        error_log("Google token request failed: HTTP $httpCode - $response");
        return false;
    }
    
    /**
     * Get user data from Google
     */
    private function getUserData($accessToken) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v2/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200) {
            return json_decode($response, true);
        }
        
        error_log("Google user data request failed: HTTP $httpCode - $response");
        return false;
    }
    
    /**
     * Check if Google OAuth is enabled
     */
    public function isEnabled() {
        return getSetting('google_oauth_enabled', 'no') === 'yes' && 
               !empty($this->clientId) && 
               !empty($this->clientSecret);
    }
}
?>