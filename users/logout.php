<?php
// users/logout.php
<?php
session_start();
define('ALLOW_ACCESS', true);

require_once '../includes/config.php';
require_once 'includes/UserAuth.php';

UserAuth::logout();

// Redirect to home page
header('Location: ../index.php');
exit;
?>