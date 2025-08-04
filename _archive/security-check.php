<?php
// Security check script
// Usage: http://yoursite.com/security-check.php

echo "<h2>🔐 Security Check</h2>";

// Check 1: .env file accessibility
echo "<h3>1. Environment File Protection</h3>";
if (file_exists('.env')) {
    echo "✅ .env file exists<br>";
    
    // Try to access .env via HTTP
    $env_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/.env';
    $context = stream_context_create([
        'http' => [
            'timeout' => 5,
            'ignore_errors' => true
        ]
    ]);
    
    $env_content = @file_get_contents($env_url, false, $context);
    
    if ($env_content === false || empty($env_content)) {
        echo "✅ .env file is NOT accessible via HTTP (GOOD!)<br>";
    } else {
        echo "⚠️ <strong>WARNING:</strong> .env file is accessible via HTTP! Configure your server to block access.<br>";
        echo "Content preview: " . htmlspecialchars(substr($env_content, 0, 100)) . "...<br>";
    }
} else {
    echo "❌ .env file not found<br>";
}

// Check 2: Git status
echo "<h3>2. Git Configuration</h3>";
if (file_exists('.gitignore')) {
    $gitignore = file_get_contents('.gitignore');
    if (strpos($gitignore, '.env') !== false) {
        echo "✅ .gitignore contains .env exclusion<br>";
    } else {
        echo "⚠️ .env not found in .gitignore - add it!<br>";
    }
} else {
    echo "❌ .gitignore file not found<br>";
}

// Check 3: Environment variables loading
echo "<h3>3. Environment Variables</h3>";
if (function_exists('load_env_file')) {
    echo "✅ env-loader.php is available<br>";
    
    // Try loading environment
    if (file_exists('.env')) {
        load_env_file('.env');
        
        $env_vars = [
            'SMTP_USERNAME',
            'CONTACT_TO_EMAIL',
            'WHATSAPP_NUMBER',
            'PHONE_NUMBER',
            'CALENDLY_URL',
            'BUSINESS_EMAIL'
        ];
        
        $loaded_count = 0;
        foreach ($env_vars as $var) {
            if (isset($_ENV[$var]) && !empty($_ENV[$var])) {
                $loaded_count++;
                echo "✅ $var: " . (strlen($_ENV[$var]) > 20 ? substr($_ENV[$var], 0, 20) . '...' : $_ENV[$var]) . "<br>";
            } else {
                echo "❌ $var: Not set<br>";
            }
        }
        
        echo "<p><strong>Loaded $loaded_count out of " . count($env_vars) . " environment variables</strong></p>";
    }
} else {
    echo "❌ env-loader.php not loaded<br>";
}

// Check 4: File permissions (if on Unix/Linux)
echo "<h3>4. File Permissions</h3>";
if (function_exists('fileperms') && file_exists('.env')) {
    $perms = fileperms('.env');
    $octal = substr(sprintf('%o', $perms), -4);
    echo ".env permissions: $octal<br>";
    
    if ($octal === '0600' || $octal === '0644') {
        echo "✅ File permissions look good<br>";
    } else {
        echo "⚠️ Consider setting .env permissions to 600 (owner read/write only)<br>";
    }
} else {
    echo "ℹ️ File permission check not available on this system<br>";
}

// Check 5: Server configuration
echo "<h3>5. Server Configuration</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "<br>";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "<br>";

// Check 6: Contact handlers
echo "<h3>6. Contact Handlers</h3>";
$handlers = [
    'simple-contact-handler.php',
    'smtp-contact-handler.php',
    'contact-handler.php'
];

foreach ($handlers as $handler) {
    if (file_exists($handler)) {
        echo "✅ $handler exists<br>";
    } else {
        echo "❌ $handler missing<br>";
    }
}

echo "<hr>";
echo "<h3>🛡️ Security Recommendations</h3>";
echo "<ul>";
echo "<li><strong>Never commit .env to Git</strong> - Use .env.example instead</li>";
echo "<li><strong>Set restrictive file permissions</strong> - chmod 600 .env on Unix/Linux</li>";
echo "<li><strong>Configure web server</strong> - Block access to .env files</li>";
echo "<li><strong>Use strong passwords</strong> - Especially for SMTP</li>";
echo "<li><strong>Enable 2FA</strong> - On email accounts used for SMTP</li>";
echo "<li><strong>Regular updates</strong> - Keep WordPress and PHP updated</li>";
echo "<li><strong>Monitor logs</strong> - Check contact_log.txt regularly</li>";
echo "</ul>";

echo "<p><a href='test-email.php'>→ Test Email Delivery</a> | <a href='index.php'>→ Back to Site</a></p>";
?>
