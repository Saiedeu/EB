<?php
// about.php (updated to use database content)
// Start session
session_start();

// Define access constant
define('ALLOW_ACCESS', true);

// Include configuration files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

// Get about page content from database
$page = getPageBySlug('about');

// If no page found in database, create default content
if (!$page) {
    $page = [
        'title' => 'About Us',
        'content' => '<p class="text-center text-gray-500 dark:text-gray-400">About Us content has not been added yet. Please add content from the admin panel.</p>'
    ];
}

// Include header
include 'templates/header.php';
?>

<!-- Main Content -->
<main class="flex-grow container mx-auto p-4 md:p-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-card overflow-hidden mb-6 section-bg">
        <div class="bg-primary text-white p-4 border-b border-gray-200 dark:border-gray-600">
            <h1 class="text-xl font-semibold text-center">
                <?php echo htmlspecialchars($page['title']); ?>
            </h1>
        </div>
        
        <div class="p-6 section-content">
            <div class="prose dark:prose-invert max-w-none">
                <?php echo $page['content']; ?>
            </div>
        </div>
    </div>
</main>

<?php include 'templates/footer.php'; ?>