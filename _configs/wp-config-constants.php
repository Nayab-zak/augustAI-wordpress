<?php
/**
 * WordPress Configuration for AugustAI
 * Add these constants to your wp-config.php file
 */

// Contact Information Constants
if (!defined('AUGUSTAI_WHATSAPP_NUMBER')) {
    define('AUGUSTAI_WHATSAPP_NUMBER', '971554483607');
}

if (!defined('AUGUSTAI_PHONE_NUMBER')) {
    define('AUGUSTAI_PHONE_NUMBER', '971583066201');
}

if (!defined('AUGUSTAI_CALENDLY_URL')) {
    define('AUGUSTAI_CALENDLY_URL', 'https://calendly.com/admin-august/30min');
}

if (!defined('AUGUSTAI_BUSINESS_EMAIL')) {
    define('AUGUSTAI_BUSINESS_EMAIL', 'hello@august.com.pk');
}

if (!defined('AUGUSTAI_BUSINESS_NAME')) {
    define('AUGUSTAI_BUSINESS_NAME', 'augustAI');
}

// SMTP Configuration Constants (add to wp-config.php)
if (!defined('AUGUSTAI_SMTP_HOST')) {
    define('AUGUSTAI_SMTP_HOST', 'smtp.gmail.com');
}

if (!defined('AUGUSTAI_SMTP_PORT')) {
    define('AUGUSTAI_SMTP_PORT', 587);
}

if (!defined('AUGUSTAI_SMTP_USERNAME')) {
    define('AUGUSTAI_SMTP_USERNAME', 'hello@august.com.pk');
}

if (!defined('AUGUSTAI_SMTP_PASSWORD')) {
    define('AUGUSTAI_SMTP_PASSWORD', 'your-app-password-here');
}

if (!defined('AUGUSTAI_SMTP_FROM_EMAIL')) {
    define('AUGUSTAI_SMTP_FROM_EMAIL', 'noreply@august.com.pk');
}

if (!defined('AUGUSTAI_CONTACT_TO_EMAIL')) {
    define('AUGUSTAI_CONTACT_TO_EMAIL', 'hello@august.com.pk');
}
?>
