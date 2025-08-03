<?php
// Simple debug script to check what's wrong
// Usage: http://yoursite.com/debug.php

echo "<h2>🔍 Website Debug Information</h2>";

// Check 1: Basic PHP functionality
echo "<h3>1. PHP Basic Check</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "<br>";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "<br>";

// Check 2: File existence
echo "<h3>2. File Check</h3>";
$files_to_check = [
    'index.php',
    'index.html', 
    'wp-config.php',
    'config.php',
    'env-loader.php',
    '.env',
    'assets/augustai_logo_only.png',
    'assets/augustAI Logo Design on Purple Gradient.png'
];

foreach ($files_to_check as $file) {
    $status = file_exists($file) ? "✅ EXISTS" : "❌ MISSING";
    echo "$file: $status<br>";
}

// Check 3: Configuration loading
echo "<h3>3. Configuration Test</h3>";
try {
    if (file_exists('wp-config.php')) {
        require_once 'wp-config.php';
        echo "✅ wp-config.php loaded successfully<br>";
        
        if (function_exists('get_augustai_config')) {
            $config = get_augustai_config();
            echo "✅ Configuration function works<br>";
            echo "WhatsApp: " . ($config['whatsapp_number'] ?? 'Not set') . "<br>";
            echo "Business Email: " . ($config['business_email'] ?? 'Not set') . "<br>";
        } else {
            echo "❌ get_augustai_config function not found<br>";
        }
    } else {
        echo "❌ wp-config.php not found<br>";
    }
} catch (Exception $e) {
    echo "❌ Configuration error: " . $e->getMessage() . "<br>";
}

// Check 4: WordPress constants
echo "<h3>4. WordPress Constants Check</h3>";
$constants_to_check = [
    'AUGUSTAI_WHATSAPP_NUMBER',
    'AUGUSTAI_PHONE_NUMBER',
    'AUGUSTAI_BUSINESS_EMAIL',
    'AUGUSTAI_CALENDLY_URL'
];

foreach ($constants_to_check as $constant) {
    $status = defined($constant) ? "✅ DEFINED: " . constant($constant) : "❌ NOT DEFINED";
    echo "$constant: $status<br>";
}

// Check 5: Environment variables
echo "<h3>5. Environment Variables Check</h3>";
if (file_exists('.env')) {
    echo "✅ .env file exists<br>";
    if (file_exists('env-loader.php')) {
        try {
            require_once 'env-loader.php';
            load_env_file('.env');
            echo "✅ Environment loaded<br>";
            $env_vars = ['WHATSAPP_NUMBER', 'BUSINESS_EMAIL', 'CALENDLY_URL'];
            foreach ($env_vars as $var) {
                $value = $_ENV[$var] ?? 'Not set';
                echo "$var: $value<br>";
            }
        } catch (Exception $e) {
            echo "❌ Environment loading error: " . $e->getMessage() . "<br>";
        }
    } else {
        echo "❌ env-loader.php missing<br>";
    }
} else {
    echo "ℹ️ .env file not found (using WordPress constants)<br>";
}

// Check 6: Error log
echo "<h3>6. Error Information</h3>";
$error = error_get_last();
if ($error) {
    echo "Last PHP Error:<br>";
    echo "Type: " . $error['type'] . "<br>";
    echo "Message: " . $error['message'] . "<br>";
    echo "File: " . $error['file'] . "<br>";
    echo "Line: " . $error['line'] . "<br>";
} else {
    echo "No PHP errors detected<br>";
}

// Check 7: Simple test
echo "<h3>7. Simple Page Test</h3>";
echo "<a href='test-simple.php'>→ Test Simple Page</a><br>";
echo "<a href='index.html'>→ Test Static HTML</a><br>";
echo "<a href='index.php'>→ Test Dynamic PHP</a><br>";

echo "<hr>";
echo "<p><strong>If you see this page, PHP is working. The issue is likely in index.php configuration.</strong></p>";
?>
