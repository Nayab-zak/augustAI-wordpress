<?php
echo "<h1>PHP Test Page</h1>";
echo "<p>Current time: " . date('Y-m-d H:i:s') . "</p>";

// Test config loading
echo "<h2>Config Test:</h2>";
try {
    $content_config = require_once 'content-config.php';
    $services = $content_config['services'];
    echo "<p>✅ Config loaded successfully</p>";
    echo "<p>Services count: " . count($services) . "</p>";
    
    echo "<h3>Services List:</h3>";
    foreach ($services as $id => $service) {
        echo "<p>- " . $service['name'] . " ($" . number_format($service['price_from']) . ")</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Config error: " . $e->getMessage() . "</p>";
}

// Test privacy policy
echo "<h2>Privacy Policy Test:</h2>";
if (file_exists('privacy.php')) {
    echo "<p>✅ privacy.php exists</p>";
    echo "<p><a href='privacy.php'>Test Privacy Policy Direct Link</a></p>";
} else {
    echo "<p>❌ privacy.php missing</p>";
}

if (file_exists('components/privacy-policy.php')) {
    echo "<p>✅ components/privacy-policy.php exists</p>";
} else {
    echo "<p>❌ components/privacy-policy.php missing</p>";
}

// Test assets
echo "<h2>Assets Test:</h2>";
$assets = [
    'assets/augustai_logo_only.png',
    'assets/augustAI Logo Design on Purple Gradient.png'
];

foreach ($assets as $asset) {
    if (file_exists($asset)) {
        echo "<p>✅ $asset exists</p>";
    } else {
        echo "<p>❌ $asset missing</p>";
    }
}

echo "<h2>Current Files:</h2>";
$files = scandir('.');
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php' || pathinfo($file, PATHINFO_EXTENSION) === 'html') {
        echo "<p>$file</p>";
    }
}
?>
