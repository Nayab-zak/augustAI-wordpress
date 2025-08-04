<?php
// config.php - Load environment variables for use in HTML
require_once 'env-loader.php';

// Load .env file
load_env_file(__DIR__ . '/.env');

// Define contact configuration from environment variables
$contact_config = [
    'whatsapp_number' => $_ENV['WHATSAPP_NUMBER'] ?? '971554483607',
    'phone_number' => $_ENV['PHONE_NUMBER'] ?? '971583066201',
    'calendly_url' => $_ENV['CALENDLY_URL'] ?? 'https://calendly.com/admin-august/30min',
    'business_email' => $_ENV['BUSINESS_EMAIL'] ?? 'hello@august.com.pk',
    'business_name' => $_ENV['BUSINESS_NAME'] ?? 'augustAI',
    'whatsapp_url' => 'https://wa.me/' . ($_ENV['WHATSAPP_NUMBER'] ?? '971554483607'),
    'phone_url' => 'tel:+' . ($_ENV['PHONE_NUMBER'] ?? '971583066201'),
    'email_url' => 'mailto:' . ($_ENV['BUSINESS_EMAIL'] ?? 'hello@august.com.pk')
];

// Convert to JSON for JavaScript use
$contact_config_json = json_encode($contact_config);
?>
