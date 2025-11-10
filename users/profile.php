<?php
// users/profile.php
<?php
session_start();
define('ALLOW_ACCESS', true);

require_once '../includes/config.php';
require_once '../includes/db.php';
require_once '../includes/functions.php';
require_once 'includes/UserAuth.php';

// Check if user is logged in
if (!UserAuth::isLoggedIn()) {
    header('Location: login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

$userAuth = new UserAuth();
$currentUser = UserAuth::getCurrentUser();

if (!$currentUser) {
    UserAuth::logout();
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    
    if ($name) {
        $result = $userAuth->updateProfile($currentUser['id'], [
            'name' => $name,
            'phone' => $phone
        ]);
        
        if ($result['success']) {
            $success = 'Profile updated successfully!';
            // Refresh user data
            $currentUser = UserAuth::getCurrentUser();
        } else {
            $error = $result['message'];
        }
    } else {
        $error = 'Name is required';
    }
}

require_once '../templates/header.php';
?>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Profile</h1>
                    <p class="text-gray-600 dark:text-gray-400">Update your account information</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Profile Information</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">Update your personal information and contact details.</p>
            </div>
            
            <form method="POST" class="p-6">
                <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?php echo htmlspecialchars($success); ?>
                </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 gap-6">
                    <!-- User ID (Read-only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">User ID</label>
                        <input type="text" value="<?php echo htmlspecialchars($currentUser['user_id']); ?>" 
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white" 
                               readonly>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Your unique user ID cannot be changed.</p>
                    </div>

                    <!-- Email (Read-only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                        <div class="flex items-center mt-1">
                            <input type="email" value="<?php echo htmlspecialchars($currentUser['email']); ?>" 
                                   class="block w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white" 
                                   readonly>
                            <?php if ($currentUser['email_verified']): ?>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Verified
                                </span>
                            <?php else: ?>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-circle mr-1"></i>Unverified
                                </span>
                            <?php endif; ?>
                        </div>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Your email address cannot be changed.</p>
                    </div>

                    <!-- Login Type (Read-only) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Login Type</label>
                        <div class="flex items-center mt-1">
                            <span class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium <?php echo $currentUser['login_type'] === 'google' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800'; ?>">
                                <i class="<?php echo $currentUser['login_type'] === 'google' ? 'fab fa-google' : 'fas fa-envelope'; ?> mr-2"></i>
                                <?php echo ucfirst($currentUser['login_type']); ?>
                            </span>
                        </div>
                    </div>

                    <!-- Name (Editable) -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                        <input type="text" id="name" name="name" required maxlength="100"
                               value="<?php echo htmlspecialchars($currentUser['name'] ?: ''); ?>"
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Phone (Editable) -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                        <input type="tel" id="phone" name="phone" maxlength="20"
                               value="<?php echo htmlspecialchars($currentUser['phone'] ?: ''); ?>"
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-primary focus:border-primary dark:bg-gray-700 dark:text-white">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Optional: Used for auto-filling exchange forms.</p>
                    </div>

                    <!-- Account Statistics -->
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Account Statistics</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Member Since</div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                    <?php echo date('M j, Y', strtotime($currentUser['created_at'])); ?>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Last Login</div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                    <?php echo $currentUser['last_login'] ? date('M j, Y H:i', strtotime($currentUser['last_login'])) : 'Never'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" 
                            class="bg-primary text-white px-6 py-2 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>