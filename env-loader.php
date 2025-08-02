<?php
/**
 * Simple .env file loader for WordPress
 * Add this to your wp-config.php file before the WordPress constants
 */

if (!function_exists('load_env_file')) {
    function load_env_file($file_path) {
        if (!file_exists($file_path)) {
            return false;
        }
        
        $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            
            // Parse key=value pairs
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove quotes if present
                if (($value[0] === '"' && $value[-1] === '"') || 
                    ($value[0] === "'" && $value[-1] === "'")) {
                    $value = substr($value, 1, -1);
                }
                
                // Set environment variable if not already set
                if (!getenv($key) && !isset($_ENV[$key])) {
                    putenv("$key=$value");
                    $_ENV[$key] = $value;
                }
            }
        }
        
        return true;
    }
}

// Load .env file (adjust path as needed)
$env_file = __DIR__ . '/.env';
if (file_exists($env_file)) {
    load_env_file($env_file);
}
?>
