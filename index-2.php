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
require_once 'includes/security.php';

// Initialize security class
$security = Security::getInstance();

// Check for banned IPs
$security->checkBanStatus();

// Rate limiting for homepage visits (100 visits per hour per IP)
if (!$security->checkRateLimit('homepage_visit', 100, 3600)) {
    http_response_code(429);
    exit('Too many requests. Please try again later.');
}

// Check maintenance mode AFTER all functions are loaded
include_once 'includes/maintenance_check.php';

// Set timezone for consistent time display
date_default_timezone_set('Asia/Dhaka');

// Include header
include 'templates/header.php';
?>

<!-- Main Content -->
<main class="flex-grow container mx-auto p-4 md:p-6">
    <?php include 'templates/exchange-form.php'; ?>
    
    <!-- Features section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex flex-col items-center text-center">
                <div class="bg-blue-100 dark:bg-blue-900 text-primary dark:text-blue-300 p-3 rounded-full mb-3">
                    <i class="fas fa-bolt text-xl"></i>
                </div>
                <h3 class="font-bold mb-2">Fast Processing</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Quick and efficient currency exchange in minutes</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex flex-col items-center text-center">
                <div class="bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 p-3 rounded-full mb-3">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <h3 class="font-bold mb-2">Secure Transactions</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Encrypted and protected exchange process</p>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex flex-col items-center text-center">
                <div class="bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 p-3 rounded-full mb-3">
                    <i class="fas fa-headset text-xl"></i>
                </div>
                <h3 class="font-bold mb-2">24/7 Support</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">Always available to assist with your exchange needs</p>
            </div>
        </div>
    </div>
    
    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Transaction Tracker -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 section-bg animated-border">
                <div class="track-header rounded-t-lg px-4 py-3">
                    <h2 class="text-xl font-bold text-white mb-0 flex items-center">
                        <i class="fas fa-search mr-2"></i> Track Transaction
                    </h2>
                </div>
                
                <div class="section-content p-6">
                    <form class="mb-4" action="track.php" method="get">
                        <!-- CSRF Protection for track form -->
                        <input type="hidden" name="csrf_token" value="<?php echo $security->generateCSRFToken(); ?>">
                        <div class="relative">
                            <input type="text" name="ref" placeholder="Enter Transaction ID" maxlength="20" pattern="[A-Za-z0-9\-]+" 
                                   class="block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md py-3 px-4 text-gray-700 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                                   title="Transaction ID can only contain letters, numbers and hyphens">
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-primary hover:bg-blue-700 text-white p-2 rounded-md transition-colors">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Latest Exchanges -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-card overflow-hidden section-bg animated-border">
                <div class="table-header rounded-t-lg px-4 py-3 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">
                        <i class="fas fa-history mr-2"></i> Latest Exchanges
                    </h2>
                    <div class="flex items-center space-x-2">
                        <a href="track.php" class="text-white text-sm hover:underline flex items-center">
                            <i class="fas fa-search mr-1"></i> Track Exchange
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto section-content">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">S/N</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Exchange Direction</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Username</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php
                            $recentExchanges = getRecentExchanges(5);
                            $totalExchanges = count($recentExchanges);
                            
                            foreach ($recentExchanges as $index => $exchange):
                                // Calculate backwards serial number (newest = 1, oldest = highest number)
                                $serialNumber = $totalExchanges - $index;
                            ?>
                            <tr class="animate-row hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                                <td class="py-2 px-4 whitespace-nowrap font-semibold"><?php echo $serialNumber; ?></td>
                                <td class="py-2 px-4">
                                    <div class="flex items-center">
                                        <div class="payment-icon <?php echo $exchange['from_bg_class'] ?: 'bg-blue-100 text-blue-500'; ?> w-7 h-7 rounded-full flex items-center justify-center">
                                            <?php if ($exchange['from_logo']): ?>
                                                <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($exchange['from_logo']); ?>" alt="<?php echo htmlspecialchars($exchange['from_currency_name']); ?>" class="w-6 h-6 object-contain rounded-full">
                                            <?php else: ?>
                                                <i class="<?php echo $exchange['from_icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-xs"></i>
                                            <?php endif; ?>
                                        </div>
                                        <span class="ml-1 text-sm"><?php echo htmlspecialchars($exchange['from_currency_name']); ?></span>
                                        <i class="fas fa-arrow-right mx-2 text-gray-400"></i>
                                        <div class="payment-icon <?php echo $exchange['to_bg_class'] ?: 'bg-gray-100 text-gray-500'; ?> w-7 h-7 rounded-full flex items-center justify-center">
                                            <?php if ($exchange['to_logo']): ?>
                                                <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($exchange['to_logo']); ?>" alt="<?php echo htmlspecialchars($exchange['to_currency_name']); ?>" class="w-6 h-6 object-contain rounded-full">
                                            <?php else: ?>
                                                <i class="<?php echo $exchange['to_icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-xs"></i>
                                            <?php endif; ?>
                                        </div>
                                        <span class="ml-1 text-sm"><?php echo htmlspecialchars($exchange['to_currency_name']); ?></span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 whitespace-nowrap"><?php echo htmlspecialchars($security->sanitizeInput($exchange['customer_name'], 'string')); ?></td>
                                <td class="py-2 px-4 whitespace-nowrap">
                                    <span class="status-<?php echo $exchange['status']; ?> px-2 py-0.5 rounded text-xs"><?php echo ucfirst($exchange['status']); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($recentExchanges)): ?>
                            <tr>
                                <td colspan="4" class="py-4 px-4 text-center text-gray-500 dark:text-gray-400">No exchanges found</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tutorial & Ads Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-card overflow-hidden section-bg animated-border">
                <div class="tutorial-header rounded-t-lg px-4 py-3">
                    <h2 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-play-circle mr-2"></i> Tutorial & Information
                    </h2>
                </div>
                
                <div class="section-content p-6">
                    <?php
                    try {
                        $db = Database::getInstance();
                        
                        // Try multiple query variations to find what works
                        $activeTutorials = [];
                        
                        // Try different query approaches
                        $queries = [
                            "SELECT * FROM tutorials_ads WHERE status = 'active' AND display_on_homepage = 1 ORDER BY priority ASC, created_at DESC LIMIT 6",
                            "SELECT * FROM tutorials_ads WHERE status = 'active' AND display_on_homepage > 0 ORDER BY priority ASC, created_at DESC LIMIT 6",
                            "SELECT * FROM tutorials_ads WHERE status = 'active' AND display_on_homepage = '1' ORDER BY priority ASC, created_at DESC LIMIT 6",
                            "SELECT * FROM tutorials_ads WHERE status = 'active' AND CAST(display_on_homepage AS UNSIGNED) = 1 ORDER BY priority ASC, created_at DESC LIMIT 6"
                        ];
                        
                        foreach ($queries as $query) {
                            try {
                                $activeTutorials = $db->getRows($query);
                                if (!empty($activeTutorials)) {
                                    break; // Found working query
                                }
                            } catch (Exception $e) {
                                continue; // Try next query
                            }
                        }
                        
                        // If still empty, try getting all active tutorials
                        if (empty($activeTutorials)) {
                            $activeTutorials = $db->getRows("SELECT * FROM tutorials_ads WHERE status = 'active' ORDER BY priority ASC, created_at DESC LIMIT 6");
                        }
                        
                        if (!empty($activeTutorials)):
                    ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($activeTutorials as $tutorial): ?>
                        <div class="tutorial-item bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-sm">
                            <?php if ($tutorial['type'] === 'video_upload' && $tutorial['file_path']): ?>
                                <!-- Uploaded Video -->
                                <?php
                                $videoPath = 'assets/uploads/media/' . htmlspecialchars($tutorial['file_path']);
                                if (file_exists($videoPath)):
                                ?>
                                <video class="w-full h-48 object-cover" controls poster="<?php echo $tutorial['thumbnail'] ? 'assets/uploads/media/' . htmlspecialchars($tutorial['thumbnail']) : ''; ?>">
                                    <source src="<?php echo $videoPath; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <?php else: ?>
                                <div class="w-full h-48 bg-red-200 dark:bg-red-600 flex items-center justify-center">
                                    <p class="text-red-700 text-center text-sm">Video file not found<br><?php echo $videoPath; ?></p>
                                </div>
                                <?php endif; ?>
                            
                            <?php elseif ($tutorial['type'] === 'image_upload' && $tutorial['file_path']): ?>
                                <!-- Uploaded Image -->
                                <?php
                                $imagePath = 'asstes/uploads/media/' . htmlspecialchars($tutorial['file_path']);
                                if (file_exists($imagePath)):
                                ?>
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    <img src="<?php echo $imagePath; ?>" 
                                         alt="<?php echo htmlspecialchars($tutorial['title']); ?>" 
                                         class="max-w-full max-h-full object-contain">
                                </div>
                                <?php else: ?>
                                <div class="w-full h-48 bg-red-200 dark:bg-red-600 flex items-center justify-center">
                                    <p class="text-red-700 text-center text-sm">Image file not found<br><?php echo $imagePath; ?></p>
                                </div>
                                <?php endif; ?>
                            
                            <?php elseif ($tutorial['type'] === 'youtube_embed' && $tutorial['embed_code']): ?>
                                <!-- YouTube Embed -->
                                <div class="w-full h-48">
                                    <?php
                                    $youtubeUrl = $tutorial['embed_code'];
                                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $youtubeUrl, $matches);
                                    if (isset($matches[1])):
                                    ?>
                                    <iframe class="w-full h-full rounded-t-lg" 
                                            src="https://www.youtube.com/embed/<?php echo htmlspecialchars($matches[1]); ?>?rel=0" 
                                            frameborder="0" 
                                            allowfullscreen>
                                    </iframe>
                                    <?php else: ?>
                                    <div class="w-full h-full bg-yellow-200 dark:bg-yellow-600 flex items-center justify-center">
                                        <p class="text-yellow-700 text-center text-sm">Invalid YouTube URL<br><?php echo htmlspecialchars(substr($youtubeUrl, 0, 30)); ?>...</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            
                            <?php elseif ($tutorial['type'] === 'facebook_embed' && $tutorial['embed_code']): ?>
                                <!-- Facebook Embed -->
                                <div class="w-full h-48">
                                    <iframe class="w-full h-full rounded-t-lg" 
                                            src="https://www.facebook.com/plugins/video.php?href=<?php echo urlencode($tutorial['embed_code']); ?>&show_text=false&width=400" 
                                            frameborder="0" 
                                            allowfullscreen>
                                    </iframe>
                                </div>
                            
                            <?php elseif ($tutorial['type'] === 'google_drive_embed' && $tutorial['embed_code']): ?>
                                <!-- Google Drive Embed -->
                                <div class="w-full h-48">
                                    <?php
                                    preg_match('/\/d\/([a-zA-Z0-9-_]+)/', $tutorial['embed_code'], $matches);
                                    if (isset($matches[1])):
                                    ?>
                                    <iframe class="w-full h-full rounded-t-lg" 
                                            src="https://drive.google.com/file/d/<?php echo htmlspecialchars($matches[1]); ?>/preview" 
                                            frameborder="0">
                                    </iframe>
                                    <?php else: ?>
                                    <div class="w-full h-full bg-yellow-200 dark:bg-yellow-600 flex items-center justify-center">
                                        <p class="text-yellow-700 text-center text-sm">Invalid Google Drive URL</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            
                            <?php elseif ($tutorial['type'] === 'adsense' && $tutorial['adsense_code']): ?>
                                <!-- Google AdSense -->
                                <div class="w-full h-48 bg-gray-100 dark:bg-gray-600 flex items-center justify-center overflow-hidden rounded-t-lg">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <?php echo $tutorial['adsense_code']; ?>
                                    </div>
                                </div>
                            
                            <?php else: ?>
                                <!-- Default placeholder -->
                                <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-video text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-500 text-sm">Type: <?php echo $tutorial['type']; ?></p>
                                        <p class="text-gray-500 text-xs">File: <?php echo $tutorial['file_path'] ?? 'None'; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-4">
                                <h3 class="font-semibold text-sm mb-2 text-gray-800 dark:text-gray-200"><?php echo htmlspecialchars($tutorial['title']); ?></h3>
                                <?php if ($tutorial['description']): ?>
                                <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2"><?php echo htmlspecialchars($tutorial['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-8">
                        <i class="fas fa-video text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 dark:text-gray-400">
                            No tutorials found to display.
                        </p>
                        <a href="debug_tutorials.php" class="text-blue-500 hover:underline mt-2 inline-block">
                            <i class="fas fa-bug mr-1"></i> Debug Tutorials
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php
                    } catch (Exception $e) {
                    ?>
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-4"></i>
                        <p class="text-red-500">Error loading tutorials: <?php echo htmlspecialchars($e->getMessage()); ?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Right Column (1/3 width) -->
        <div>
            <!-- Our Reserves -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-card overflow-hidden mb-6 section-bg animated-border">
                <div class="reserve-header rounded-t-lg px-4 py-3 border-b border-gray-200 dark:border-gray-600">
                    <h2 class="text-xl font-semibold text-center text-white">
                        <i class="fas fa-wallet mr-2"></i> Our Reserves
                    </h2>
                </div>
                
                <div class="reserve-container section-content">
                    <?php
                    try {
                        $reserves = getCurrencyReserves();
                        foreach ($reserves as $reserve):
                    ?>
                    <div class="p-3 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="payment-icon <?php echo $reserve['background_class'] ?: 'bg-pink-100 text-pink-500'; ?> w-8 h-8 rounded-full flex items-center justify-center">
                                <?php if ($reserve['logo']): ?>
                                    <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($reserve['logo']); ?>" alt="<?php echo htmlspecialchars($reserve['name']); ?>" class="w-7 h-7 object-contain rounded-full">
                                <?php else: ?>
                                    <i class="<?php echo $reserve['icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-sm"></i>
                                <?php endif; ?>
                            </div>
                            <span class="ml-2 text-sm"><?php echo htmlspecialchars($reserve['name']); ?></span>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-sm"><?php echo number_format($reserve['amount'], 2); ?> <span class="text-xs text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($reserve['display_name'] ?: $reserve['currency_code']); ?></span></div>
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    } catch (Exception $e) {
                        error_log("Error loading reserves: " . $e->getMessage());
                    ?>
                    <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                        Unable to load reserves at the moment
                    </div>
                    <?php } ?>
                    
                    <?php if (empty($reserves)): ?>
                    <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                        No reserves found
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Exchange Rates -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-card overflow-hidden mb-6 section-bg animated-border">
                <div class="exchange-rate-header rounded-t-lg px-4 py-3 border-b border-gray-200 dark:border-gray-600">
                    <h2 class="text-xl font-semibold text-center text-white">
                        <i class="fas fa-chart-line mr-2"></i> Today Exchange Rate
                    </h2>
                </div>
                
                <div class="section-content">
                    <?php
                    try {
                        // Get exchange rates that are marked for homepage display
                        $db = Database::getInstance();
                        
                        // Check if new columns exist
                        $hasNewColumns = false;
                        try {
                            $checkColumns = $db->query("SHOW COLUMNS FROM exchange_rates LIKE 'display_on_homepage'");
                            if ($checkColumns && $checkColumns->rowCount() > 0) {
                                $hasNewColumns = true;
                            }
                        } catch (Exception $e) {
                            // Ignore if columns don't exist yet
                        }
                        
                        if ($hasNewColumns) {
                            // New system with we_buy, we_sell and homepage display toggle
                            $homepageRates = $db->getRows(
                                "SELECT er.*, 
                                 fc.name as from_currency_name, fc.display_name as from_display_name, fc.logo as from_logo, fc.background_class as from_bg_class, fc.icon_class as from_icon_class
                                 FROM exchange_rates er
                                 JOIN currencies fc ON er.from_currency = fc.code
                                 WHERE er.status = 'active' AND fc.status = 'active' AND er.display_on_homepage = 1
                                 AND (er.we_buy > 0 OR er.we_sell > 0)
                                 ORDER BY fc.name ASC"
                            );
                            
                            if (!empty($homepageRates)):
                            ?>
                            <div class="p-3 border-b border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-700">
                                <div class="grid grid-cols-3 gap-2 text-center text-sm font-semibold">
                                    <div>We Accept</div>
                                    <div>We Buy</div>
                                    <div>We Sell</div>
                                </div>
                            </div>
                            
                            <?php foreach ($homepageRates as $rate): ?>
                            <div class="p-3 border-b border-gray-200 dark:border-gray-700">
                                <div class="grid grid-cols-3 gap-2 items-center">
                                    <!-- Currency Name with Logo -->
                                    <div class="flex items-center">
                                        <div class="payment-icon <?php echo $rate['from_bg_class'] ?: 'bg-blue-100 text-blue-500'; ?> w-7 h-7 rounded-full flex items-center justify-center">
                                            <?php if ($rate['from_logo']): ?>
                                                <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($rate['from_logo']); ?>" alt="<?php echo htmlspecialchars($rate['from_currency_name']); ?>" class="w-6 h-6 object-contain rounded-full">
                                            <?php else: ?>
                                                <i class="<?php echo $rate['from_icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-xs"></i>
                                            <?php endif; ?>
                                        </div>
                                        <span class="text-xs ml-1"><?php echo htmlspecialchars($rate['from_currency_name']); ?></span>
                                    </div>
                                    
                                    <!-- We Buy Rate -->
                                    <div class="text-center">
                                        <div class="font-bold text-xs">
                                            <?php echo ($rate['we_buy'] > 0) ? number_format($rate['we_buy'], 2) : '-'; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- We Sell Rate -->
                                    <div class="text-center">
                                        <div class="font-bold text-xs">
                                            <?php echo ($rate['we_sell'] > 0) ? number_format($rate['we_sell'], 2) : '-'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <?php else: ?>
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                No exchange rates configured for homepage display
                            </div>
                            <?php endif; ?>
                            
                            <?php
                        } else {
                            // Fallback to old system for backwards compatibility
                            $exchangeRates = $db->getRows(
                                "SELECT er.*, 
                                 fc.name as from_currency_name, fc.display_name as from_display_name, fc.logo as from_logo, fc.background_class as from_bg_class, fc.icon_class as from_icon_class,
                                 tc.name as to_currency_name, tc.display_name as to_display_name, tc.logo as to_logo, tc.background_class as to_bg_class, tc.icon_class as to_icon_class
                                 FROM exchange_rates er
                                 JOIN currencies fc ON er.from_currency = fc.code
                                 JOIN currencies tc ON er.to_currency = tc.code
                                 WHERE er.status = 'active' AND fc.status = 'active' AND tc.status = 'active'
                                 ORDER BY er.from_currency, er.to_currency LIMIT 5"
                            );
                            
                            if (!empty($exchangeRates)):
                            ?>
                            <?php foreach ($exchangeRates as $rate): ?>
                            <div class="p-3 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                <div class="flex items-center">
                                    <!-- From Currency -->
                                    <div class="payment-icon <?php echo $rate['from_bg_class'] ?: 'bg-blue-100 text-blue-500'; ?> w-7 h-7 rounded-full flex items-center justify-center">
                                        <?php if ($rate['from_logo']): ?>
                                            <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($rate['from_logo']); ?>" alt="<?php echo htmlspecialchars($rate['from_currency_name']); ?>" class="w-6 h-6 object-contain rounded-full">
                                        <?php else: ?>
                                            <i class="<?php echo $rate['from_icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-xs"></i>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-xs ml-1"><?php echo htmlspecialchars($rate['from_display_name'] ?: $rate['from_currency']); ?></span>
                                    
                                    <!-- Arrow -->
                                    <i class="fas fa-arrow-right mx-2 text-gray-400 text-xs"></i>
                                    
                                    <!-- To Currency -->
                                    <div class="payment-icon <?php echo $rate['to_bg_class'] ?: 'bg-green-100 text-green-500'; ?> w-7 h-7 rounded-full flex items-center justify-center">
                                        <?php if ($rate['to_logo']): ?>
                                            <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($rate['to_logo']); ?>" alt="<?php echo htmlspecialchars($rate['to_currency_name']); ?>" class="w-6 h-6 object-contain rounded-full">
                                        <?php else: ?>
                                            <i class="<?php echo $rate['to_icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-xs"></i>
                                        <?php endif; ?>
                                    </div>
                                    <span class="text-xs ml-1"><?php echo htmlspecialchars($rate['to_display_name'] ?: $rate['to_currency']); ?></span>
                                </div>
                                
                                <div class="text-right">
                                    <div class="font-bold text-xs">
                                        1 <?php echo htmlspecialchars($rate['from_display_name'] ?: $rate['from_currency']); ?> = 
                                        <?php echo number_format($rate['rate'], 4); ?> 
                                        <span class="text-xs text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($rate['to_display_name'] ?: $rate['to_currency']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <?php else: ?>
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                No exchange rates available at the moment
                            </div>
                            <?php endif; ?>
                            <?php
                        }
                    } catch (Exception $e) {
                        error_log("Error loading exchange rates: " . $e->getMessage());
                    ?>
                    <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                        Unable to load exchange rates at the moment
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <!-- Testimonials -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-card overflow-hidden section-bg animated-border">
                <div class="testimonial-header rounded-t-lg px-4 py-3 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">
                        <i class="fas fa-comment-dots mr-2"></i> Testimonials
                    </h2>
                    <div class="flex items-center space-x-2">
                        <a href="write-review.php" class="text-white text-sm hover:underline flex items-center">
                            <i class="fas fa-plus mr-1"></i> Write a Review
                        </a>
                        <?php 
                        try {
                            $testimonialCount = count(getActiveTestimonials());
                            if ($testimonialCount > 0):
                        ?>
                        <span class="bg-white text-yellow-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold"><?php echo $testimonialCount; ?></span>
                        <?php 
                            endif;
                        } catch (Exception $e) {
                            error_log("Error loading testimonial count: " . $e->getMessage());
                        }
                        ?>
                    </div>
                </div>
                
                <div class="p-4 section-content">
                    <?php
                    try {
                        $testimonials = getActiveTestimonials(3);
                        foreach ($testimonials as $testimonial):
                    ?>
                    <div class="testimonial-card bg-gray-50 dark:bg-gray-700 p-3 mb-4 rounded">
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-sm text-gray-500 dark:text-gray-400">by <?php echo htmlspecialchars($security->sanitizeInput($testimonial['name'], 'string')); ?></div>
                            <div class="star-rating">
                                <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                <i class="fas fa-star text-yellow-400"></i>
                                <?php endfor; ?>
                                <?php for ($i = $testimonial['rating']; $i < 5; $i++): ?>
                                <i class="far fa-star text-gray-300"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <?php if ($testimonial['from_currency'] && $testimonial['to_currency']): ?>
                        <div class="flex items-center text-sm mb-2">
                            <div class="payment-icon <?php echo $testimonial['from_bg_class'] ?: 'bg-green-500 text-white'; ?> w-6 h-6 rounded-full flex items-center justify-center">
                                <?php if ($testimonial['from_logo']): ?>
                                    <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($testimonial['from_logo']); ?>" alt="<?php echo htmlspecialchars($testimonial['from_currency_name']); ?>" class="w-5 h-5 object-contain rounded-full">
                                <?php else: ?>
                                    <i class="<?php echo $testimonial['from_icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-xs"></i>
                                <?php endif; ?>
                            </div>
                            <span class="ml-1 text-xs"><?php echo htmlspecialchars($testimonial['from_currency_name']); ?></span>
                            <i class="fas fa-arrow-right mx-2 text-gray-400"></i>
                            <div class="payment-icon <?php echo $testimonial['to_bg_class'] ?: 'bg-blue-500 text-white'; ?> w-6 h-6 rounded-full flex items-center justify-center">
                                <?php if ($testimonial['to_logo']): ?>
                                    <img src="<?php echo ASSETS_URL; ?>/uploads/currencies/<?php echo htmlspecialchars($testimonial['to_logo']); ?>" alt="<?php echo htmlspecialchars($testimonial['to_currency_name']); ?>" class="w-5 h-5 object-contain rounded-full">
                                <?php else: ?>
                                    <i class="<?php echo $testimonial['to_icon_class'] ?: 'fas fa-money-bill-wave'; ?> text-xs"></i>
                                <?php endif; ?>
                            </div>
                            <span class="ml-1 text-xs"><?php echo htmlspecialchars($testimonial['to_currency_name']); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="font-semibold text-sm"><?php echo htmlspecialchars($security->sanitizeInput($testimonial['message'], 'string')); ?></div>
                    </div>
                    <?php 
                        endforeach;
                    } catch (Exception $e) {
                        error_log("Error loading testimonials: " . $e->getMessage());
                    ?>
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4">
                        Unable to load testimonials at the moment
                    </div>
                    <?php } ?>
                    
                    <?php if (empty($testimonials)): ?>
                    <div class="text-center text-gray-500 dark:text-gray-400 py-4">
                        No testimonials yet. Be the first to leave a review!
                        <br>
                        <a href="write-review.php" class="text-primary hover:underline mt-2 inline-block">
                            <i class="fas fa-plus mr-1"></i> Write a Review
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Custom CSS for circular logo frames and tutorial section -->
<style>
.payment-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    flex-shrink: 0;
}

.payment-icon img {
    border-radius: 50%;
    object-fit: cover;
}

.star-rating i {
    font-size: 0.75rem;
}

.animate-row {
    animation: fadeInUp 0.3s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-hover {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.section-bg {
    position: relative;
    overflow: hidden;
}

.animated-border {
    border: 1px solid #e5e7eb;
    transition: border-color 0.3s ease;
}

.animated-border:hover {
    border-color: #3b82f6;
}

/* Tutorial specific styles */
.tutorial-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.tutorial-item {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.tutorial-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.tutorial-item video,
.tutorial-item iframe {
    border-radius: 8px 8px 0 0;
}

/* Line clamp for description */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Ensure proper contrast in dark mode */
.dark .tutorial-item {
    background-color: #374151;
}

.dark .tutorial-item h3 {
    color: #f9fafb;
}

.dark .tutorial-item p {
    color: #d1d5db;
}
</style>

<script>
// Enhanced security for frontend
document.addEventListener('DOMContentLoaded', function() {
    // Prevent right-click context menu on sensitive elements
    const sensitiveElements = document.querySelectorAll('.payment-icon, .testimonial-card, .tutorial-item');
    sensitiveElements.forEach(element => {
        element.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });
    });
    
    // Add loading state for track form
    const trackForm = document.querySelector('form[action="track.php"]');
    if (trackForm) {
        trackForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            submitBtn.disabled = true;
        });
    }
});
</script>

<?php include 'templates/footer.php'; ?>