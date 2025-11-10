<?php
// Debug file to check tutorials
require_once 'includes/config.php';
require_once 'includes/db.php';

echo "<h1>Tutorial Debug Information</h1>";

// Check if table exists
try {
    $db = Database::getInstance();
    $tableCheck = $db->query("SHOW TABLES LIKE 'tutorials_ads'");
    
    if ($tableCheck && $tableCheck->rowCount() > 0) {
        echo "<p style='color: green;'>✓ Table 'tutorials_ads' exists</p>";
        
        // Check table structure
        $structure = $db->query("DESCRIBE tutorials_ads");
        echo "<h3>Table Structure:</h3>";
        echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
        while ($row = $structure->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . implode("</td><td>", $row) . "</td></tr>";
        }
        echo "</table>";
        
        // Get all tutorials
        $tutorials = $db->getRows("SELECT * FROM tutorials_ads ORDER BY created_at DESC");
        
        echo "<h3>Total tutorials in database: " . count($tutorials) . "</h3>";
        
        if (!empty($tutorials)) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Title</th><th>Type</th><th>Status</th><th>Homepage</th><th>File Path</th><th>Embed Code</th><th>File Exists</th></tr>";
            
            foreach ($tutorials as $tutorial) {
                $fileExists = 'N/A';
                if ($tutorial['file_path']) {
                    $filePath = 'uploads/tutorials/' . $tutorial['file_path'];
                    $fileExists = file_exists($filePath) ? 'YES' : 'NO (' . $filePath . ')';
                }
                
                echo "<tr>";
                echo "<td>" . $tutorial['id'] . "</td>";
                echo "<td>" . htmlspecialchars($tutorial['title']) . "</td>";
                echo "<td>" . $tutorial['type'] . "</td>";
                echo "<td>" . $tutorial['status'] . "</td>";
                echo "<td>" . $tutorial['display_on_homepage'] . "</td>";
                echo "<td>" . htmlspecialchars($tutorial['file_path'] ?? '') . "</td>";
                echo "<td>" . htmlspecialchars(substr($tutorial['embed_code'] ?? '', 0, 50)) . "...</td>";
                echo "<td style='color: " . ($fileExists === 'YES' ? 'green' : 'red') . ";'>" . $fileExists . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // Test the query used in index.php
            $activeHomepageTutorials = $db->getRows(
                "SELECT * FROM tutorials_ads WHERE status = 'active' AND display_on_homepage = 1 ORDER BY priority ASC, created_at DESC LIMIT 6"
            );
            
            echo "<h3>Active homepage tutorials: " . count($activeHomepageTutorials) . "</h3>";
            
        } else {
            echo "<p style='color: orange;'>No tutorials found in database</p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Table 'tutorials_ads' does not exist</p>";
        echo "<p>Run this SQL to create it:</p>";
        echo "<textarea style='width: 100%; height: 200px;'>";
        echo "CREATE TABLE IF NOT EXISTS `tutorials_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `type` enum('video_upload','image_upload','youtube_embed','facebook_embed','google_drive_embed','adsense') NOT NULL,
  `file_path` varchar(500) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `embed_code` text,
  `adsense_code` text,
  `priority` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `display_on_homepage` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `display_on_homepage` (`display_on_homepage`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        echo "</textarea>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Database Error: " . $e->getMessage() . "</p>";
}

// Check upload directory
echo "<h3>Upload Directory Check:</h3>";
$uploadDir = 'uploads/tutorials/';

if (!is_dir($uploadDir)) {
    echo "<p style='color: red;'>✗ Directory '$uploadDir' does not exist</p>";
    echo "<p>Create it with: mkdir -p uploads/tutorials && chmod 755 uploads/tutorials</p>";
} else {
    echo "<p style='color: green;'>✓ Directory '$uploadDir' exists</p>";
    
    if (is_writable($uploadDir)) {
        echo "<p style='color: green;'>✓ Directory is writable</p>";
    } else {
        echo "<p style='color: orange;'>⚠ Directory is not writable. Run: chmod 755 uploads/tutorials</p>";
    }
    
    $files = scandir($uploadDir);
    $files = array_filter($files, function($file) {
        return !in_array($file, ['.', '..']);
    });
    
    echo "<p>Files in upload directory: " . count($files) . "</p>";
    if (!empty($files)) {
        echo "<ul>";
        foreach ($files as $file) {
            echo "<li>" . $file . "</li>";
        }
        echo "</ul>";
    }
}

echo "<h3>Constants Check:</h3>";
if (defined('SITE_URL')) {
    echo "<p>SITE_URL: " . SITE_URL . "</p>";
} else {
    echo "<p style='color: red;'>SITE_URL not defined</p>";
}

if (defined('ASSETS_URL')) {
    echo "<p>ASSETS_URL: " . ASSETS_URL . "</p>";
} else {
    echo "<p style='color: red;'>ASSETS_URL not defined</p>";
}
?>