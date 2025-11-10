<?php
// Admin Setup Script
// This script helps you create or reset the admin user
// Run this file once to set up your admin credentials, then delete it for security

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include configuration
require_once 'config.php';
require_once 'db.php';

// Security check - remove this file after use
$setup_file = __FILE__;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Setup - Exchange Bridge</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900">
                        Exchange<span class="text-yellow-500">Bridge</span>
                    </h2>
                    <h3 class="mt-2 text-xl font-bold text-gray-700">Admin Setup</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Create or reset your admin user credentials
                    </p>
                </div>
            </div>

            <?php
            $message = '';
            $messageType = '';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                try {
                    $db = Database::getInstance();
                    
                    $username = trim($_POST['username']);
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);
                    $confirm_password = trim($_POST['confirm_password']);
                    
                    // Validation
                    if (empty($username) || empty($email) || empty($password)) {
                        throw new Exception('All fields are required');
                    }
                    
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception('Invalid email format');
                    }
                    
                    if (strlen($password) < 6) {
                        throw new Exception('Password must be at least 6 characters long');
                    }
                    
                    if ($password !== $confirm_password) {
                        throw new Exception('Passwords do not match');
                    }
                    
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Check if admin user already exists
                    $existingAdmin = $db->getRow("SELECT * FROM users WHERE role = 'admin' LIMIT 1");
                    
                    if ($existingAdmin) {
                        // Update existing admin
                        $result = $db->update('users', [
                            'username' => $username,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'status' => 'active'
                        ], 'id = ?', [$existingAdmin['id']]);
                        
                        if ($result) {
                            $message = 'Admin user updated successfully! You can now login with your new credentials.';
                            $messageType = 'success';
                        } else {
                            throw new Exception('Failed to update admin user');
                        }
                    } else {
                        // Create new admin
                        $userId = $db->insert('users', [
                            'username' => $username,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'role' => 'admin',
                            'status' => 'active'
                        ]);
                        
                        if ($userId) {
                            $message = 'Admin user created successfully! You can now login with your credentials.';
                            $messageType = 'success';
                        } else {
                            throw new Exception('Failed to create admin user');
                        }
                    }
                    
                } catch (Exception $e) {
                    $message = $e->getMessage();
                    $messageType = 'error';
                }
            }

            // Check current admin users
            try {
                $db = Database::getInstance();
                $adminUsers = $db->getRows("SELECT username, email, created_at, last_login FROM users WHERE role = 'admin'");
            } catch (Exception $e) {
                $adminUsers = [];
                if (empty($message)) {
                    $message = 'Database connection error: ' . $e->getMessage();
                    $messageType = 'error';
                }
            }
            ?>

            <?php if ($message): ?>
                <div class="rounded-md p-4 <?php echo $messageType === 'success' ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200'; ?>">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="<?php echo $messageType === 'success' ? 'fas fa-check-circle text-green-400' : 'fas fa-exclamation-circle text-red-400'; ?>"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium <?php echo $messageType === 'success' ? 'text-green-800' : 'text-red-800'; ?>">
                                <?php echo htmlspecialchars($message); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($adminUsers)): ?>
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-blue-800 mb-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Current Admin Users:
                    </h4>
                    <?php foreach ($adminUsers as $admin): ?>
                        <div class="text-sm text-blue-700">
                            <strong><?php echo htmlspecialchars($admin['username']); ?></strong> 
                            (<?php echo htmlspecialchars($admin['email']); ?>)
                            <?php if ($admin['last_login']): ?>
                                - Last login: <?php echo date('M j, Y g:i A', strtotime($admin['last_login'])); ?>
                            <?php else: ?>
                                - Never logged in
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form class="mt-8 space-y-6" method="POST">
                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1 relative">
                            <input id="username" name="username" type="text" required 
                                   class="appearance-none relative block w-full px-3 py-2 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Enter username"
                                   value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : 'admin'; ?>">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1 relative">
                            <input id="email" name="email" type="email" required 
                                   class="appearance-none relative block w-full px-3 py-2 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Enter email address"
                                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : 'admin@exchangebridge.com'; ?>">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" required 
                                   class="appearance-none relative block w-full px-3 py-2 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Enter password (min 6 characters)">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <div class="mt-1 relative">
                            <input id="confirm_password" name="confirm_password" type="password" required 
                                   class="appearance-none relative block w-full px-3 py-2 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Confirm your password">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-user-shield text-blue-500 group-hover:text-blue-400"></i>
                        </span>
                        <?php echo !empty($adminUsers) ? 'Update Admin User' : 'Create Admin User'; ?>
                    </button>
                </div>
            </form>

            <div class="text-center">
                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-800">
                                <strong>Security Notice:</strong> Please delete this file (setup_admin.php) after creating your admin user for security reasons.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($messageType === 'success'): ?>
                <div class="text-center">
                    <a href="admin/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        <i class="fas fa-arrow-right mr-2"></i>
                        Go to Admin Dashboard
                    </a>
                </div>
            <?php endif; ?>

            <div class="text-center text-xs text-gray-500">
                <p>Exchange Bridge Admin Setup v1.0</p>
                <p class="mt-1">Make sure your database connection is properly configured in config.php</p>
            </div>
        </div>
    </div>

    <script>
        // Simple password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('password-strength');
            
            if (password.length === 0) {
                if (strengthDiv) strengthDiv.remove();
                return;
            }
            
            let strength = 0;
            let message = '';
            let color = '';
            
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            switch (strength) {
                case 0:
                case 1:
                    message = 'Very Weak';
                    color = 'text-red-600';
                    break;
                case 2:
                    message = 'Weak';
                    color = 'text-orange-600';
                    break;
                case 3:
                    message = 'Medium';
                    color = 'text-yellow-600';
                    break;
                case 4:
                    message = 'Strong';
                    color = 'text-blue-600';
                    break;
                case 5:
                    message = 'Very Strong';
                    color = 'text-green-600';
                    break;
            }
            
            let existingDiv = document.getElementById('password-strength');
            if (!existingDiv) {
                existingDiv = document.createElement('div');
                existingDiv.id = 'password-strength';
                existingDiv.className = 'text-xs mt-1';
                this.parentNode.appendChild(existingDiv);
            }
            
            existingDiv.innerHTML = `<span class="${color}">Password Strength: ${message}</span>`;
        });

        // Confirm password match
        document.getElementById('confirm_password').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            let existingDiv = document.getElementById('password-match');
            if (!existingDiv && confirmPassword.length > 0) {
                existingDiv = document.createElement('div');
                existingDiv.id = 'password-match';
                existingDiv.className = 'text-xs mt-1';
                this.parentNode.appendChild(existingDiv);
            }
            
            if (confirmPassword.length === 0) {
                if (existingDiv) existingDiv.remove();
                return;
            }
            
            if (password === confirmPassword) {
                existingDiv.innerHTML = '<span class="text-green-600"><i class="fas fa-check mr-1"></i>Passwords match</span>';
            } else {
                existingDiv.innerHTML = '<span class="text-red-600"><i class="fas fa-times mr-1"></i>Passwords do not match</span>';
            }
        });
    </script>
</body>
</html>