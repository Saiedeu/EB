<?php
// users/google-callback.php
<?php
session_start();
define('ALLOW_ACCESS', true);

require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once 'includes/UserAuth.php';
require_once 'includes/GoogleOAuth.php';

$userAuth = new UserAuth();
$googleOAuth = new GoogleOAuth();

$error = '';

// Check if Google OAuth is enabled
if (!$googleOAuth->isEnabled()) {
    header('Location: login.php');
    exit;
}

// Handle callback
if (isset($_GET['code']) && isset($_GET['state'])) {
    $result = $googleOAuth->handleCallback($_GET['code'], $_GET['state']);
    
    if ($result['success']) {
        // Authenticate with Google user data
        $authResult = $userAuth->googleAuth($result['user_data']);
        
        if ($authResult['success']) {
            $redirect = isset($_SESSION['oauth_redirect']) ? $_SESSION['oauth_redirect'] : 'dashboard.php';
            unset($_SESSION['oauth_redirect']);
            header('Location: ' . $redirect);
            exit;
        } else {
            $error = $authResult['message'];
        }
    } else {
        $error = $result['message'];
    }
} elseif (isset($_GET['error'])) {
    $error = 'Google authentication was cancelled or failed.';
} else {
    $error = 'Invalid callback request.';
}

// Redirect to login with error
header('Location: login.php?error=' . urlencode($error));
exit;
?>