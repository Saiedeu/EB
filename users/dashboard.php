<?php
// users/dashboard.php
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

// Get user transaction history
$transactions = $userAuth->getUserTransactions($currentUser['id'], 10);
$totalTransactions = count($userAuth->getUserTransactions($currentUser['id'], 999999));

require_once '../templates/header.php';
?>

<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                    <p class="text-gray-600 dark:text-gray-400">Welcome back, <?php echo htmlspecialchars($currentUser['name'] ?: 'User'); ?>!</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="profile.php" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark">
                        <i class="fas fa-user mr-2"></i>Edit Profile
                    </a>
                    <a href="logout.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- User ID Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-id-card text-blue-500 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">User ID</dt>
                                <dd class="text-lg font-medium text-gray-900 dark:text-white"><?php echo htmlspecialchars($currentUser['user_id']); ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Transactions Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exchange-alt text-green-500 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Transactions</dt>
                                <dd class="text-lg font-medium text-gray-900 dark:text-white"><?php echo $totalTransactions; ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Status Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-shield-check text-<?php echo $currentUser['email_verified'] ? 'green' : 'yellow'; ?>-500 text-2xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Account Status</dt>
                                <dd class="text-lg font-medium text-gray-900 dark:text-white">
                                    <?php echo $currentUser['email_verified'] ? 'Verified' : 'Unverified'; ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-8">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Quick Actions</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="../index.php" class="bg-primary text-white p-4 rounded-lg hover:bg-primary-dark transition-colors text-center">
                        <i class="fas fa-exchange-alt text-2xl mb-2"></i>
                        <div class="font-medium">New Exchange</div>
                    </a>
                    <a href="../track.php" class="bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-600 transition-colors text-center">
                        <i class="fas fa-search text-2xl mb-2"></i>
                        <div class="font-medium">Track Exchange</div>
                    </a>
                    <a href="profile.php" class="bg-gray-500 text-white p-4 rounded-lg hover:bg-gray-600 transition-colors text-center">
                        <i class="fas fa-user text-2xl mb-2"></i>
                        <div class="font-medium">Edit Profile</div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Recent Transactions</h2>
            </div>
            <div class="overflow-x-auto">
                <?php if (empty($transactions)): ?>
                <div class="p-6 text-center">
                    <i class="fas fa-exchange-alt text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">No transactions yet</p>
                    <a href="../index.php" class="mt-4 inline-block bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark">
                        Start Your First Exchange
                    </a>
                </div>
                <?php else: ?>
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reference ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">From</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">To</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                        <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    <?php echo htmlspecialchars($transaction['reference_id']); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    <?php echo number_format($transaction['send_amount'], 2); ?> <?php echo htmlspecialchars($transaction['from_currency']); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    <?php echo number_format($transaction['receive_amount'], 2); ?> <?php echo htmlspecialchars($transaction['to_currency']); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full status-<?php echo $transaction['status']; ?>">
                                    <?php echo ucfirst($transaction['status']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                <?php echo date('M j, Y', strtotime($transaction['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="../receipt.php?ref=<?php echo urlencode($transaction['reference_id']); ?>" 
                                   class="text-primary hover:text-primary-dark">
                                    View Receipt
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>