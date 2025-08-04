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

// NEW: Asset versioning function
function asset_version($file_path) {
    $full_path = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($file_path, '/');
    if (file_exists($full_path)) {
        // Use file modification time for automatic cache busting
        return filemtime($full_path);
    } else {
        // Fallback to current timestamp if file doesn't exist
        error_log("Asset not found: " . $full_path);
        return time();
    }
}

// NEW: Helper function for versioned asset URLs
function versioned_asset($file_path) {
    return $file_path . '?v=' . asset_version($file_path);
}

// NEW: Cache clearing helper (for manual cache invalidation)
function clear_asset_cache() {
    return time(); // Simple timestamp-based clearing
}

$contact_config_json = json_encode($contact_config);
?>
