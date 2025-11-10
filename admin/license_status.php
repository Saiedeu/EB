<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/config.php';

// Check admin authentication
// Add your existing admin authentication check here

$pageTitle = 'License Status';
$currentPage = 'license';

// Get license information
$licenseInfo = null;
$verificationFile = __DIR__ . '/../config/verification.php';

if (file_exists($verificationFile)) {
    $licenseInfo = include $verificationFile;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Exchange Bridge Admin</title>
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        .license-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .status-active { color: #28a745; font-weight: bold; }
        .status-inactive { color: #dc3545; font-weight: bold; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .info-card { background: white; padding: 20px; border-radius: 8px; border: 1px solid #dee2e6; }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Include your existing admin header/navigation -->
        
        <div class="content">
            <h1>License Status</h1>
            
            <?php if ($licenseInfo): ?>
                <div class="license-info">
                    <h2>License Information</h2>
                    
                    <div class="info-grid">
                        <div class="info-card">
                            <h3>License Key</h3>
                            <p><?= htmlspecialchars(substr($licenseInfo['license_key'], 0, 10) . '...') ?></p>
                        </div>
                        
                        <div class="info-card">
                            <h3>Status</h3>
                            <p class="<?= $licenseInfo['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                                <?= ucfirst($licenseInfo['status']) ?>
                            </p>
                        </div>
                        
                        <div class="info-card">
                            <h3>Domain</h3>
                            <p><?= htmlspecialchars($licenseInfo['domain']) ?></p>
                        </div>
                        
                        <div class="info-card">
                            <h3>Last Check</h3>
                            <p><?= date('Y-m-d H:i:s', $licenseInfo['last_check']) ?></p>
                        </div>
                        
                        <div class="info-card">
                            <h3>Validation Type</h3>
                            <p><?= ucfirst($licenseInfo['validation_type'] ?? 'Unknown') ?></p>
                        </div>
                        
                        <div class="info-card">
                            <h3>Server Status</h3>
                            <p><?= ucfirst($licenseInfo['server_status'] ?? 'Unknown') ?></p>
                        </div>
                    </div>
                    
                    <?php if (isset($licenseInfo['expires']) && $licenseInfo['expires']): ?>
                        <div class="info-card" style="margin-top: 20px;">
                            <h3>Expires</h3>
                            <p><?= date('Y-m-d H:i:s', $licenseInfo['expires']) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <h3>No License Information Available</h3>
                    <p>License verification file not found. Please reinstall the script.</p>
                </div>
            <?php endif; ?>
            
            <div style="margin-top: 30px;">
                <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
                <button onclick="checkLicense()" class="btn btn-primary">Check License Now</button>
            </div>
        </div>
    </div>

    <script>
        function checkLicense() {
            // Add AJAX call to check license status
            fetch('api/check_license.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('License verified successfully!');
                    location.reload();
                } else {
                    alert('License check failed: ' + data.message);
                }
            })
            .catch(error => {
                alert('Error checking license: ' + error);
            });
        }
    </script>
</body>
</html>