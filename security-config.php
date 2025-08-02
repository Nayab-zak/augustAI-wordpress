<?php
/**
 * Security Configuration for augustAI
 * Add your reCAPTCHA keys and configure security headers
 */

// reCAPTCHA v3 Configuration
// Get your keys from: https://www.google.com/recaptcha/admin/create
if (!defined('RECAPTCHA_SITE_KEY')) {
    define('RECAPTCHA_SITE_KEY', 'YOUR_RECAPTCHA_SITE_KEY_HERE'); // Replace with your actual site key
}

if (!defined('RECAPTCHA_SECRET_KEY')) {
    define('RECAPTCHA_SECRET_KEY', 'YOUR_RECAPTCHA_SECRET_KEY_HERE'); // Replace with your actual secret key
}

// Security Headers for HTTPS/HSTS
function apply_security_headers() {
    // HSTS (HTTP Strict Transport Security) - Forces HTTPS for 1 year
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
    }
    
    // Content Security Policy
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://www.google.com https://www.gstatic.com https://assets.calendly.com https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net; img-src 'self' data: https:; connect-src 'self' https://www.google.com;");
    
    // Additional security headers
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
}

// Apply security headers
apply_security_headers();

/**
 * SSL/TLS Security Recommendations
 * 
 * FOR HOSTING PROVIDERS / SERVER ADMINISTRATORS:
 * 
 * 1. Enable HSTS at server level (Apache/Nginx):
 *    Apache: Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
 *    Nginx: add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;
 * 
 * 2. Force TLS 1.3 minimum:
 *    Apache: SSLProtocol -all +TLSv1.3
 *    Nginx: ssl_protocols TLSv1.3;
 * 
 * 3. Use strong cipher suites:
 *    Apache: SSLCipherSuite ECDHE+AESGCM:ECDHE+CHACHA20:DHE+AESGCM:DHE+CHACHA20:!aNULL:!MD5:!DSS
 *    Nginx: ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384;
 * 
 * 4. Enable OCSP stapling:
 *    Apache: SSLUseStapling On
 *    Nginx: ssl_stapling on;
 * 
 * 5. Test your SSL configuration:
 *    https://www.ssllabs.com/ssltest/analyze.html?d=august.com.pk
 * 
 * TARGET: A+ rating on SSL Labs with TLS 1.3 and HSTS preload
 */

/**
 * reCAPTCHA v3 Setup Instructions
 * 
 * 1. Go to https://www.google.com/recaptcha/admin/create
 * 2. Choose reCAPTCHA v3
 * 3. Add your domain: august.com.pk
 * 4. Get Site Key and Secret Key
 * 5. Replace the placeholder keys above with your actual keys
 * 6. Test the form submission to ensure it works
 * 
 * reCAPTCHA v3 provides a score (0.0 to 1.0):
 * - 1.0: Very likely a human
 * - 0.0: Very likely a bot
 * - We use 0.5 as threshold (adjustable in simple-contact-handler.php)
 */

// Rate limiting configuration
if (!defined('RATE_LIMIT_WINDOW')) {
    define('RATE_LIMIT_WINDOW', 300); // 5 minutes
}

if (!defined('RATE_LIMIT_MAX_REQUESTS')) {
    define('RATE_LIMIT_MAX_REQUESTS', 3); // 3 submissions per 5 minutes
}

?>
