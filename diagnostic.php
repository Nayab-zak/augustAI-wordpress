<?php
echo "<h1>augustAI - Quick Diagnostic</h1>";
echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";

// Test 1: Config Loading
echo "<h2>1. Configuration Test</h2>";
try {
    require_once '_configs/config-simple.php';
    echo "✅ Config loaded successfully<br>";
    echo "Business name: " . $contact_config['business_name'] . "<br>";
} catch (Exception $e) {
    echo "❌ Config error: " . $e->getMessage() . "<br>";
}

// Test 2: Services Loading  
echo "<h2>2. Services Test</h2>";
try {
    $content_config = require_once 'content-config.php';
    $services = $content_config['services'];
    echo "✅ Services loaded: " . count($services) . " services<br>";
    
    foreach ($services as $id => $service) {
        echo "- " . $service['name'] . " ($" . number_format($service['price_from']) . ")<br>";
    }
} catch (Exception $e) {
    echo "❌ Services error: " . $e->getMessage() . "<br>";
}

// Test 3: Files Check
echo "<h2>3. Core Files Test</h2>";
$files = [
    'index.php' => 'Main website',
    'privacy.php' => 'Privacy policy',
    'content-config.php' => 'Services config',
    '.htaccess' => 'Server config'
];

foreach ($files as $file => $desc) {
    if (file_exists($file)) {
        echo "✅ $file ($desc)<br>";
    } else {
        echo "❌ $file missing<br>";
    }
}

// Test 4: Assets Check
echo "<h2>4. Assets Test</h2>";
$assets = [
    'assets/augustai_logo_only.png' => 'Logo',
    'assets/augustAI Logo Design on Purple Gradient.png' => 'Hero logo'
];

foreach ($assets as $asset => $desc) {
    if (file_exists($asset)) {
        echo "✅ $asset ($desc)<br>";
    } else {
        echo "❌ $asset missing<br>";
    }
}

echo "<h2>✨ Quick Links</h2>";
echo '<a href="index.php">Main Site</a> | ';
echo '<a href="privacy.php">Privacy Policy</a> | ';
echo '<a href="index.php?debug=1">Debug Mode</a>';
?>
