<?php
// users/includes/EmailService.php
<?php
// Prevent direct access
if (!defined('ALLOW_ACCESS')) {
    header("HTTP/1.1 403 Forbidden");
    exit("Direct access forbidden");
}

require_once __DIR__ . '/../PhpMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PhpMailer/src/SMTP.php';
require_once __DIR__ . '/../PhpMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $db;
    private $mailer;
    
    public function __construct() {
        $this->db = Database::getInstance();
        $this->initializeMailer();
    }
    
    /**
     * Initialize PHPMailer
     */
    private function initializeMailer() {
        $this->mailer = new PHPMailer(true);
        
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host       = getSetting('smtp_host', 'smtp.gmail.com');
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = getSetting('smtp_username', '');
            $this->mailer->Password   = getSetting('smtp_password', '');
            
            $smtpSecure = getSetting('smtp_secure', 'tls');
            if ($smtpSecure === 'ssl') {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
            
            $this->mailer->Port       = (int) getSetting('smtp_port', 587);
            $this->mailer->CharSet    = 'UTF-8';
            
            // Default sender
            $fromEmail = getSetting('smtp_from_email', getSetting('smtp_username', ''));
            $fromName = getSetting('smtp_from_name', getSetting('site_name', 'Exchange Bridge'));
            
            if ($fromEmail) {
                $this->mailer->setFrom($fromEmail, $fromName);
                $this->mailer->addReplyTo($fromEmail, $fromName);
            }
            
        } catch (Exception $e) {
            error_log("EmailService initialization error: " . $e->getMessage());
        }
    }
    
    /**
     * Send email using template
     */
    public function sendTemplateEmail($to, $templateKey, $variables = []) {
        try {
            // Get template
            $template = $this->getEmailTemplate($templateKey);
            if (!$template) {
                throw new Exception("Email template not found: $templateKey");
            }
            
            // Process template variables
            $subject = $this->processTemplate($template['subject'], $variables);
            $body = $this->processTemplate($template['body'], $variables);
            
            return $this->sendEmail($to, $subject, $body);
            
        } catch (Exception $e) {
            error_log("EmailService::sendTemplateEmail error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send basic email
     */
    public function sendEmail($to, $subject, $body, $isHTML = true) {
        try {
            if (getSetting('smtp_enabled', 'yes') !== 'yes') {
                error_log("SMTP is disabled");
                return false;
            }
            
            // Reset recipients
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            
            // Recipients
            $this->mailer->addAddress($to);
            
            // Content
            $this->mailer->isHTML($isHTML);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            
            if ($isHTML) {
                $this->mailer->AltBody = strip_tags($body);
            }
            
            $result = $this->mailer->send();
            
            if ($result) {
                error_log("Email sent successfully to: $to");
            }
            
            return $result;
            
        } catch (Exception $e) {
            error_log("EmailService::sendEmail error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Get email template
     */
    private function getEmailTemplate($templateKey) {
        return $this->db->getRow(
            "SELECT * FROM email_templates WHERE template_key = ? AND status = 'active'",
            [$templateKey]
        );
    }
    
    /**
     * Process template with variables
     */
    private function processTemplate($template, $variables) {
        foreach ($variables as $key => $value) {
            $template = str_replace('{' . $key . '}', $value, $template);
        }
        return $template;
    }
    
    /**
     * Test email configuration
     */
    public function testConfiguration() {
        try {
            $testEmail = getSetting('smtp_from_email', '');
            if (!$testEmail) {
                return ['success' => false, 'message' => 'No sender email configured'];
            }
            
            $result = $this->sendEmail(
                $testEmail,
                'Test Email - ' . getSetting('site_name', 'Exchange Bridge'),
                '<h2>Test Email</h2><p>This is a test email to verify your SMTP configuration.</p><p>If you receive this email, your configuration is working correctly.</p>'
            );
            
            if ($result) {
                return ['success' => true, 'message' => 'Test email sent successfully'];
            } else {
                return ['success' => false, 'message' => 'Failed to send test email'];
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Test failed: ' . $e->getMessage()];
        }
    }
}
?>