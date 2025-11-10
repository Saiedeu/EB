<?php
// users/login.php
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
$success = '';

// Redirect if already logged in
if (UserAuth::isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    if ($email && $password) {
        $result = $userAuth->login($email, $password);
        
        if ($result['success']) {
            $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard.php';
            header('Location: ' . $redirect);
            exit;
        } else {
            $error = $result['message'];
            if (isset($result['needs_verification'])) {
                $error .= ' <a href="resend-verification.php?email=' . urlencode($email) . '" class="text-blue-500 underline">Resend verification email</a>';
            }
        }
    } else {
        $error = 'Please fill in all fields';
    }
}

// Get Google login URL
$googleLoginUrl = $googleOAuth->isEnabled() ? $googleOAuth->getLoginUrl() : false;

require_once '../templates/header.php';
?>

<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
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
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white dark:bg-gray-700 rounded-t-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                           placeholder="Email address" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white dark:bg-gray-700 rounded-b-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm"
                           placeholder="Password">
                </div>
            </div>

            <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>

            <div class="flex items-center justify-between">
                <div class="text-sm">
                    <a href="forgot-password.php" class="font-medium text-primary hover:text-primary-dark">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt text-primary-light group-hover:text-primary-lighter"></i>
                    </span>
                    Sign in
                </button>
            </div>

            <?php if ($googleLoginUrl): ?>
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="<?php echo htmlspecialchars($googleLoginUrl); ?>"
                       class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="ml-2">Sign in with Google</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>