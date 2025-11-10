<?php
// Debug file to check tutorials
require_once 'includes/config.php';
require_once 'includes/db.php';

echo "<h1>Tutorial Debug Information</h1>";

try {
    $db = Database::getInstance();
    
    // Get all tutorials with detailed debugging
    $tutorials = $db->getRows("SELECT * FROM tutorials_ads ORDER BY created_at DESC");
    
    echo "<h3>All Tutorials Raw Data:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Title</th><th>Type</th><th>Status (raw)</th><th>Homepage (raw)</th><th>Priority</th><th>File Path</th></tr>";
    
    foreach ($tutorials as $tutorial) {
        echo "<tr>";
        echo "<td>" . $tutorial['id'] . "</td>";
        echo "<td>" . htmlspecialchars($tutorial['title']) . "</td>";
        echo "<td>" . $tutorial['type'] . "</td>";
        echo "<td>" . var_export($tutorial['status'], true) . "</td>";
        echo "<td>" . var_export($tutorial['display_on_homepage'], true) . "</td>";
        echo "<td>" . $tutorial['priority'] . "</td>";
        echo "<td>" . htmlspecialchars($tutorial['file_path'] ?? '') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Test different query variations
    echo "<h3>Query Testing:</h3>";
    
    // Test 1: Basic query
    $test1 = $db->getRows("SELECT * FROM tutorials_ads");
    echo "<p>All tutorials: " . count($test1) . "</p>";
    
    // Test 2: Status filter only
    $test2 = $db->getRows("SELECT * FROM tutorials_ads WHERE status = 'active'");
    echo "<p>Active tutorials: " . count($test2) . "</p>";
    
    // Test 3: Homepage filter only  
    $test3 = $db->getRows("SELECT * FROM tutorials_ads WHERE display_on_homepage = 1");
    echo "<p>Homepage tutorials: " . count($test3) . "</p>";
    
    // Test 4: Both filters with explicit casting
    $test4 = $db->getRows("SELECT * FROM tutorials_ads WHERE status = 'active' AND display_on_homepage = 1");
    echo "<p>Active + Homepage tutorials: " . count($test4) . "</p>";
    
    // Test 5: Different boolean check
    $test5 = $db->getRows("SELECT * FROM tutorials_ads WHERE status = 'active' AND display_on_homepage > 0");
    echo "<p>Active + Homepage (>0): " . count($test5) . "</p>";
    
    // Test 6: String comparison for boolean
    $test6 = $db->getRows("SELECT * FROM tutorials_ads WHERE status = 'active' AND display_on_homepage = '1'");
    echo "<p>Active + Homepage ('1'): " . count($test6) . "</p>";
    
    if (!empty($test4)) {
        echo "<h3>Working Query Results:</h3>";
        foreach ($test4 as $t) {
            echo "<p>ID: {$t['id']}, Title: " . htmlspecialchars($t['title']) . ", Type: {$t['type']}</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}
?>