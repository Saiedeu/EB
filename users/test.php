<?php
// users/test.php
echo "PHP is working!<br>";
echo "Current directory: " . __DIR__ . "<br>";
echo "Document root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

// Test file includes
$files_to_check = [
    '../includes/config.php',
    '../includes/db.php',
    '../includes/functions.php',
    'includes/UserAuth.php'
];

foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        echo "✓ Found: $file<br>";
    } else {
        echo "✗ Missing: $file<br>";
    }
}
?>