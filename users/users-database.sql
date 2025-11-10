-- ================================================================
-- Exchange Bridge User System Database Migration
-- Add these tables to your existing database
-- ================================================================

-- --------------------------------------------------------
-- Table structure for table `site_users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `site_users`;
CREATE TABLE `site_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verification_token` varchar(255) DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `login_type` enum('email','google') NOT NULL DEFAULT 'email',
  `status` enum('active','blocked','suspended') NOT NULL DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `google_id` (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `user_exchanges`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `user_exchanges`;
CREATE TABLE `user_exchanges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `exchange_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `exchange_id` (`exchange_id`),
  FOREIGN KEY (`exchange_id`) REFERENCES `exchanges` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `email_templates`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_key` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `variables` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `template_key` (`template_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Insert default email templates
-- --------------------------------------------------------

INSERT INTO `email_templates` (`template_key`, `subject`, `body`, `variables`) VALUES
('email_verification', 'Verify Your Email - {site_name}', 
'<h2>Welcome to {site_name}!</h2>
<p>Hi {name},</p>
<p>Thank you for signing up! Please verify your email address by clicking the link below:</p>
<p><a href="{verification_link}" style="background-color: #5D5CDE; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;">Verify Email</a></p>
<p>Or copy and paste this link in your browser:</p>
<p>{verification_link}</p>
<p>Your verification code is: <strong>{verification_code}</strong></p>
<p>This link will expire in 24 hours.</p>
<p>If you didn\'t create an account, please ignore this email.</p>
<p>Best regards,<br>{site_name} Team</p>', 
'name,site_name,verification_link,verification_code'),

('password_reset', 'Password Reset - {site_name}', 
'<h2>Password Reset Request</h2>
<p>Hi {name},</p>
<p>We received a request to reset your password for your {site_name} account.</p>
<p>Click the link below to reset your password:</p>
<p><a href="{reset_link}" style="background-color: #5D5CDE; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;">Reset Password</a></p>
<p>Or copy and paste this link in your browser:</p>
<p>{reset_link}</p>
<p>This link will expire in 1 hour.</p>
<p>If you didn\'t request this password reset, please ignore this email.</p>
<p>Best regards,<br>{site_name} Team</p>', 
'name,site_name,reset_link'),

('welcome_email', 'Welcome to {site_name}!', 
'<h2>Welcome to {site_name}!</h2>
<p>Hi {name},</p>
<p>Your account has been successfully created! Your User ID is: <strong>{user_id}</strong></p>
<p>You can now:</p>
<ul>
<li>Exchange currencies with auto-filled forms</li>
<li>View your transaction history</li>
<li>Manage your profile</li>
</ul>
<p><a href="{dashboard_link}" style="background-color: #5D5CDE; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; display: inline-block;">Go to Dashboard</a></p>
<p>Best regards,<br>{site_name} Team</p>', 
'name,site_name,user_id,dashboard_link');

-- --------------------------------------------------------
-- Add PHPMailer settings to settings table
-- --------------------------------------------------------

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('smtp_enabled', 'yes'),
('smtp_host', 'smtp.gmail.com'),
('smtp_port', '587'),
('smtp_secure', 'tls'),
('smtp_username', ''),
('smtp_password', ''),
('smtp_from_email', ''),
('smtp_from_name', ''),
('google_oauth_enabled', 'no'),
('google_client_id', ''),
('google_client_secret', ''),
('user_system_enabled', 'yes'),
('require_email_verification', 'yes'),
('allow_google_signup', 'yes');

-- --------------------------------------------------------
-- Create auto-increment function for user_id
-- --------------------------------------------------------

-- Insert a trigger to auto-generate user_id starting from 100001
DELIMITER $$

CREATE TRIGGER `generate_user_id` BEFORE INSERT ON `site_users`
FOR EACH ROW
BEGIN
    DECLARE next_id INT;
    
    SELECT COALESCE(MAX(CAST(SUBSTRING(user_id, 1) AS UNSIGNED)), 100000) + 1 
    INTO next_id 
    FROM site_users 
    WHERE user_id REGEXP '^[0-9]+$';
    
    SET NEW.user_id = CAST(next_id AS CHAR);
END$$

DELIMITER ;