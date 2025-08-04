<?php
// Server Deployment Diagnostic
echo "<h1>🔍 Deployment Diagnostic - " . date('Y-m-d H:i:s') . "</h1>";

echo "<h2>📁 Current Directory Structure:</h2>";
echo "<pre>";
function listDirectory($dir, $level = 0) {
    $indent = str_repeat("  ", $level);
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            echo $indent . $file;
            if (is_dir($dir . "/" . $file)) {
                echo "/\n";
                if ($level < 2) { // Limit depth
                    listDirectory($dir . "/" . $file, $level + 1);
                }
            } else {
                echo " (" . date('Y-m-d H:i:s', filemtime($dir . "/" . $file)) . ")\n";
            }
        }
    }
}
listDirectory(".");
echo "</pre>";

echo "<h2>🖼️ Assets Directory:</h2>";
if (is_dir('assets')) {
    echo "<pre>";
    listDirectory("assets");
    echo "</pre>";
} else {
    echo "<p>❌ Assets directory not found!</p>";
}

echo "<h2>⚙️ Config Files:</h2>";
if (is_dir('_configs')) {
    echo "<pre>";
    listDirectory("_configs");
    echo "</pre>";
} else {
    echo "<p>❌ _configs directory not found!</p>";
}

echo "<h2>📄 Main Files:</h2>";
$mainFiles = ['index.php', 'privacy.php', '.htaccess', 'content-config.php'];
foreach ($mainFiles as $file) {
    if (file_exists($file)) {
        echo "✅ $file - " . date('Y-m-d H:i:s', filemtime($file)) . "<br>";
    } else {
        echo "❌ $file - Missing!<br>";
    }
}

echo "<h2>🌐 Server Info:</h2>";
echo "Server Time: " . date('Y-m-d H:i:s') . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Current Path: " . __DIR__ . "<br>";
?>
