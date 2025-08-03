<?php
// Debug script to test services loading
echo "Testing services configuration...\n\n";

// Load configuration
$content_config = require_once 'content-config.php';
$services = $content_config['services'];

echo "Number of services loaded: " . count($services) . "\n\n";

foreach ($services as $service_id => $service) {
    echo "Service ID: $service_id\n";
    echo "Service Name: " . $service['name'] . "\n";
    echo "Tagline: " . $service['tagline'] . "\n";
    echo "Price: $" . number_format($service['price_from']) . "\n";
    echo "Features: " . count($service['features']) . " items\n";
    echo "---\n";
}
?>
