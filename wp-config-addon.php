<?php
// Additional WordPress configuration for AugustAI
// Add this to your existing wp-config.php file

// Enable WordPress to serve static HTML files
define('WP_USE_THEMES', false);

// Allow custom file types
define('ALLOW_UNFILTERED_UPLOADS', true);

// Memory limit for WordPress
ini_set('memory_limit', '256M');

// Enable error logging
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

// Security enhancements
define('DISALLOW_FILE_EDIT', true);
define('FORCE_SSL_ADMIN', true);

// Custom upload directory
define('UPLOADS', 'wp-content/uploads');
?>