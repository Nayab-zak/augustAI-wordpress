<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>augustAI - Status Dashboard</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: white;
            min-height: 100vh;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header h1 {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            margin: 0;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .card h3 {
            margin-top: 0;
            color: #a78bfa;
        }
        .status {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .status.working { background: #10b981; color: white; }
        .status.issue { background: #ef4444; color: white; }
        .status.needs-check { background: #f59e0b; color: white; }
        .link-test {
            margin: 10px 0;
        }
        .link-test a {
            color: #60a5fa;
            text-decoration: none;
            padding: 8px 12px;
            background: rgba(96, 165, 250, 0.2);
            border-radius: 6px;
            display: inline-block;
            margin: 5px;
        }
        .link-test a:hover {
            background: rgba(96, 165, 250, 0.3);
        }
        .services-list {
            list-style: none;
            padding: 0;
        }
        .services-list li {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .price {
            color: #34d399;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>augustAI Status Dashboard</h1>
            <p>Current state of the website and integrations</p>
        </div>

        <div class="grid">
            <!-- Services Status -->
            <div class="card">
                <h3>🛍️ Services Configuration</h3>
                <?php
                try {
                    $content_config = require_once 'content-config.php';
                    $services = $content_config['services'];
                    echo '<span class="status working">✓ WORKING</span>';
                    echo '<p><strong>' . count($services) . '</strong> services loaded successfully</p>';
                    
                    echo '<ul class="services-list">';
                    foreach ($services as $service_id => $service) {
                        $price_display = isset($service['price_to']) 
                            ? "$" . number_format($service['price_from']) . " - $" . number_format($service['price_to'])
                            : "From $" . number_format($service['price_from']);
                        echo '<li><strong>' . htmlspecialchars($service['name']) . '</strong> <span class="price">(' . $price_display . ')</span></li>';
                    }
                    echo '</ul>';
                } catch (Exception $e) {
                    echo '<span class="status issue">❌ ERROR</span>';
                    echo '<p>Error loading services: ' . htmlspecialchars($e->getMessage()) . '</p>';
                }
                ?>
            </div>

            <!-- Privacy Policy Status -->
            <div class="card">
                <h3>🔒 Privacy Policy</h3>
                <?php
                $privacy_files = [
                    'privacy.php' => file_exists('privacy.php'),
                    'components/privacy-policy.php' => file_exists('components/privacy-policy.php'),
                    '.htaccess' => file_exists('.htaccess')
                ];
                
                $all_exist = array_reduce($privacy_files, function($carry, $exists) {
                    return $carry && $exists;
                }, true);
                
                if ($all_exist) {
                    echo '<span class="status working">✓ WORKING</span>';
                    echo '<p>All privacy policy files are in place</p>';
                } else {
                    echo '<span class="status issue">❌ ISSUES</span>';
                    echo '<p>Some privacy policy files are missing</p>';
                }
                
                echo '<div class="link-test">';
                echo '<p><strong>Test Privacy Policy Access:</strong></p>';
                echo '<a href="privacy.php" target="_blank">Direct Link (privacy.php)</a>';
                echo '<a href="/privacy" target="_blank">Clean URL (/privacy)</a>';
                echo '</div>';
                
                echo '<ul>';
                foreach ($privacy_files as $file => $exists) {
                    $status = $exists ? '✓' : '❌';
                    echo "<li>$status $file</li>";
                }
                echo '</ul>';
                ?>
            </div>

            <!-- Main Site Status -->
            <div class="card">
                <h3>🏠 Main Site</h3>
                <?php
                $main_files = [
                    'index.php' => file_exists('index.php'),
                    'config-simple.php' => file_exists('config-simple.php'),
                    'content-config.php' => file_exists('content-config.php')
                ];
                
                $all_main_exist = array_reduce($main_files, function($carry, $exists) {
                    return $carry && $exists;
                }, true);
                
                if ($all_main_exist) {
                    echo '<span class="status working">✓ WORKING</span>';
                    echo '<p>All core files are present</p>';
                } else {
                    echo '<span class="status issue">❌ ISSUES</span>';
                    echo '<p>Some core files are missing</p>';
                }
                
                echo '<div class="link-test">';
                echo '<p><strong>Test Main Site:</strong></p>';
                echo '<a href="index.php" target="_blank">Main Site</a>';
                echo '<a href="index.php?debug=services" target="_blank">Services Debug</a>';
                echo '</div>';
                
                echo '<ul>';
                foreach ($main_files as $file => $exists) {
                    $status = $exists ? '✓' : '❌';
                    echo "<li>$status $file</li>";
                }
                echo '</ul>';
                ?>
            </div>

            <!-- Components Status -->
            <div class="card">
                <h3>🧩 Components</h3>
                <?php
                $components_dir = 'components';
                if (is_dir($components_dir)) {
                    $components = scandir($components_dir);
                    $php_components = array_filter($components, function($file) {
                        return pathinfo($file, PATHINFO_EXTENSION) === 'php';
                    });
                    
                    echo '<span class="status working">✓ WORKING</span>';
                    echo '<p><strong>' . count($php_components) . '</strong> components available</p>';
                    
                    echo '<ul>';
                    foreach ($php_components as $component) {
                        echo '<li>✓ ' . htmlspecialchars($component) . '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<span class="status issue">❌ MISSING</span>';
                    echo '<p>Components directory not found</p>';
                }
                ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <h3>🚀 Quick Actions</h3>
            <div class="link-test">
                <a href="index.php" target="_blank">View Main Site</a>
                <a href="privacy.php" target="_blank">View Privacy Policy</a>
                <a href="test-services.html" target="_blank">Test Services Config</a>
                <a href="debug-services.php" target="_blank">Debug Services</a>
                <a href="index.php?debug=services" target="_blank">Debug Services in Main Site</a>
            </div>
        </div>

        <!-- Recent Updates -->
        <div class="card">
            <h3>📋 Implementation Status</h3>
            <ul style="list-style: none; padding: 0;">
                <li>✅ <strong>5-Service Structure:</strong> LLM & Chatbots, Agentic Automation, Dashboards, MVP-in-30, Consulting</li>
                <li>✅ <strong>Component Architecture:</strong> Modular design with separated components</li>
                <li>✅ <strong>Privacy Policy:</strong> Fully integrated with augustAI branding</li>
                <li>✅ <strong>Clean URLs:</strong> august.com.pk/privacy routing configured</li>
                <li>✅ <strong>Navigation:</strong> Dropdown service navigation and privacy link added</li>
                <li>✅ <strong>UX Polish:</strong> 8-point spacing system and WCAG compliance</li>
            </ul>
        </div>
    </div>
</body>
</html>
