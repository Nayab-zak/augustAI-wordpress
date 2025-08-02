<?php
// Quick fix config - no WordPress constants needed
// This replaces wp-config.php with a simple version

$contact_config = [
    'whatsapp_number' => '971554483607',
    'phone_number' => '971583066201',
    'calendly_url' => 'https://calendly.com/admin-august/30min',
    'business_email' => 'hello@august.com.pk',
    'business_name' => 'augustAI',
    'whatsapp_url' => 'https://wa.me/971554483607',
    'phone_url' => 'tel:+971583066201',
    'email_url' => 'mailto:hello@august.com.pk',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_username' => 'hello@august.com.pk',
    'smtp_password' => 'mohidhussainjannatzeenatzak',
    'smtp_from_email' => 'noreply@august.com.pk',
    'smtp_from_name' => 'AugustAI Contact Form',
    'contact_to_email' => 'hello@august.com.pk'
];

$contact_config_json = json_encode($contact_config);
?>
