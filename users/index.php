<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
define('ALLOW_ACCESS', true);

require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
require_once 'includes/UserAuth.php';

$security = Security::getInstance();
$userAuth = new UserAuth();

// Check if already logged in
if ($security->isSiteUserLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$email = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Rate limiting
    $clientIp = $security->getClientIp();
    if (!$security->checkRateLimit("login_attempts_{$clientIp}", 5, 300)) {
        $error = 'Too many login attempts. Please try again in 5 minutes.';
    } else {
        // Verify CSRF token
        if (!$security->verifyCSRFToken($_POST['csrf_token'] ?? '')) {
            $error = 'Invalid security token. Please try again.';
        } else {
            $email = $security->sanitizeInput($_POST['email']);
            $password = $_POST['password'];
            
            if ($email && $password) {
                $result = $userAuth->login($email, $password);
                
                if ($result['success']) {
                    $security->logSecurityEvent('site_user_login', "Site user logged in: {$email}", 'info');
                    header('Location: dashboard.php');
                    exit;
                } else {
                    $error = $result['message'];
                    $security->logSecurityEvent('site_user_login_failed', "Failed login attempt: {$email}", 'warning');
                }
            } else {
                $error = 'Please fill in all fields';
            }
        }
    }
}

$siteName = getSetting('site_name', 'Exchange Bridge');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo htmlspecialchars($siteName); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                        'primary-dark': '#4A4BC9'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 dark:text-white">
                    Sign in to your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                    Or
                    <a href="register.php" class="font-medium text-primary hover:text-primary-dark">
                        create a new account
                    </a>
                </p>
            </div>
            
            <form class="mt-8 space-y-6" method="POST">
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo $security->generateCSRFToken(); ?>">
                
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                               placeholder="Email address" value="<?php echo htmlspecialchars($email); ?>">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                               placeholder="Password">
                    </div>
                </div>

                <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <i class="fas fa-exclamation-circle mr-2"></i><?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                        Sign in
                    </button>
                </div>
            </form>
            
            <div class="text-center">
                <a href="../index.php" class="text-primary hover:text-primary-dark">
                    ← Back to Exchange
                </a>
            </div>
        </div>
    </div>
</body>
</html>