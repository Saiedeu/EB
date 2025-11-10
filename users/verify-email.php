<?php
// users/verify-email.php
<?php
session_start();
define('ALLOW_ACCESS', true);

require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once 'includes/UserAuth.php';

$userAuth = new UserAuth();
$message = '';
$messageType = '';

// Handle verification
if (isset($_GET['token'])) {
    $result = $userAuth->verifyEmail($_GET['token']);
    
    if ($result['success']) {
        $message = 'Email verified successfully! You can now login to your account.';
        $messageType = 'success';
    } else {
        $message = $result['message'];
        $messageType = 'error';
    }
} else {
    $message = 'Invalid verification link.';
    $messageType = 'error';
}

require_once '../templates/header.php';
?>

<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                Email Verification
            </h2>
        </div>
        
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <?php if ($messageType === 'success'): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-check-circle mr-2"></i><?php echo htmlspecialchars($message); ?>
            </div>
            
            <div class="text-center">
                <a href="login.php" class="bg-primary text-white px-6 py-2 rounded-md hover:bg-primary-dark inline-block">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login to Your Account
                </a>
            </div>
            <?php else: ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-exclamation-circle mr-2"></i><?php echo htmlspecialchars($message); ?>
            </div>
            
            <div class="text-center space-x-2">
                <a href="register.php" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark inline-block">
                    <i class="fas fa-user-plus mr-2"></i>Register
                </a>
                <a href="login.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 inline-block">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>