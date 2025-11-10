<?php
// Start session
session_start();

// Define access constant
define('ALLOW_ACCESS', true);

// Include configuration files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

// Set 403 header
header("HTTP/1.0 403 Forbidden");

// Include header
include 'templates/header.php';
?>

<!-- Main Content -->
<main class="flex-grow container mx-auto p-4 md:p-6 flex items-center justify-center">
    <div class="text-center max-w-lg">
        <div class="text-primary text-9xl font-bold mb-4">403</div>
        <h1 class="text-3xl font-bold mb-4">Access Forbidden</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">
            You don't have permission to access this page. If you believe this is an error, please contact the site administrator.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="index.php" class="exchange-btn px-6 py-3 rounded-full font-semibold text-white shadow-md hover:shadow-lg">
                <i class="fas fa-home mr-2"></i> Go to Homepage
            </a>
            <a href="contact.php" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-full font-semibold shadow-md hover:shadow-lg">
                <i class="fas fa-envelope mr-2"></i> Contact Support
            </a>
        </div>
        <div class="mt-6">
            <p class="text-gray-600 dark:text-gray-400">
                Need help? <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', getSetting('contact_whatsapp', '8801869838872')); ?>" class="text-green-600 dark:text-green-400 hover:underline">Contact us on WhatsApp</a>
            </p>
        </div>
    </div>
</main>

<?php include 'templates/footer.php'; ?>