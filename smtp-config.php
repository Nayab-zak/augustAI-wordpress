<?php
/**
 * WordPress SMTP Configuration
 * Add this to your WordPress theme's functions.php file
 * Make sure to include env-loader.php in your wp-config.php first
 */

// Configure WordPress to use SMTP for better email delivery
add_action('phpmailer_init', 'configure_smtp');
function configure_smtp($phpmailer) {
    // Only configure if we have SMTP credentials
    if (!getenv('SMTP_USERNAME') || !getenv('SMTP_PASSWORD')) {
        return; // Skip SMTP if credentials not available
    }
    
    $phpmailer->isSMTP();
    
    // SMTP Configuration from environment variables
    $phpmailer->Host       = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = getenv('SMTP_PORT') ?: 587;
    $phpmailer->SMTPSecure = getenv('SMTP_SECURE') ?: 'tls';
    
    // Email credentials from environment variables
    $phpmailer->Username   = getenv('SMTP_USERNAME');
    $phpmailer->Password   = getenv('SMTP_PASSWORD');
    
    // From address from environment variables
    $phpmailer->From       = getenv('SMTP_FROM_EMAIL') ?: 'noreply@august.com.pk';
    $phpmailer->FromName   = getenv('SMTP_FROM_NAME') ?: 'AugustAI Contact Form';
    
    // Additional settings
    $phpmailer->SMTPDebug  = 0; // Set to 2 for debugging
    
    // Enable verbose debug output (only for testing)
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $phpmailer->SMTPDebug = 1;
    }
}

// Test email function (remove after testing)
add_action('wp_footer', 'add_email_test_button');
function add_email_test_button() {
    if (current_user_can('administrator') && isset($_GET['test_email'])) {
        $test_result = wp_mail(
            getenv('CONTACT_TO_EMAIL') ?: 'hello@august.com.pk',
            'Test Email from AugustAI',
            'This is a test email to verify SMTP configuration is working.'
        );
        
        echo '<script>alert("Email test ' . ($test_result ? 'successful' : 'failed') . '!");</script>';
    }
    
    if (current_user_can('administrator')) {
        echo '<div style="position:fixed;bottom:20px;right:20px;z-index:9999;">
                <a href="?test_email=1" style="background:#0073aa;color:white;padding:10px;text-decoration:none;border-radius:3px;">
                    Test Email
                </a>
              </div>';
    }
}

// Alternative: Use a WordPress SMTP plugin instead
// Recommended plugins:
// - WP Mail SMTP by WPForms
// - Easy WP SMTP
// - Post SMTP Mailer
?>
