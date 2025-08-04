<?php
/**
 * Directory Cleanup Script
 * Removes temporary files and organizes the project structure
 */

class DirectoryCleanup {
    private $base_dir;
    private $archive_dir;
    
    public function __construct() {
        $this->base_dir = __DIR__;
        $this->archive_dir = $this->base_dir . '/_archive';
        
        // Create archive directory if it doesn't exist
        if (!is_dir($this->archive_dir)) {
            mkdir($this->archive_dir, 0755, true);
        }
    }
    
    /**
     * Run all cleanup operations
     */
    public function runCleanup() {
        echo "🧹 Starting directory cleanup...\n";
        
        $this->moveTestFiles();
        $this->moveSensitiveFiles();
        $this->organizeLogFiles();
        $this->cleanTempFiles();
        $this->updateGitignore();
        
        echo "✅ Cleanup complete!\n";
        $this->showDirectoryStructure();
    }
    
    /**
     * Move test and debug files to archive
     */
    private function moveTestFiles() {
        echo "📁 Moving test files...\n";
        
        $test_patterns = [
            'debug*',
            'test-*',
            'index_claude.*',
            'index_genspark.*',
            '*-test.php'
        ];
        
        foreach ($test_patterns as $pattern) {
            $files = glob($this->base_dir . '/' . $pattern);
            foreach ($files as $file) {
                if (is_file($file)) {
                    $filename = basename($file);
                    rename($file, $this->archive_dir . '/' . $filename);
                    echo "  - Moved: {$filename}\n";
                }
            }
        }
    }
    
    /**
     * Move sensitive files to archive
     */
    private function moveSensitiveFiles() {
        echo "🔒 Moving sensitive files...\n";
        
        $sensitive_files = [
            'id_rsa*',
            'ssh_key*',
            '*.pem',
            '*.key'
        ];
        
        foreach ($sensitive_files as $pattern) {
            $files = glob($this->base_dir . '/' . $pattern);
            foreach ($files as $file) {
                if (is_file($file)) {
                    $filename = basename($file);
                    rename($file, $this->archive_dir . '/' . $filename);
                    echo "  - Moved: {$filename}\n";
                }
            }
        }
    }
    
    /**
     * Organize log files
     */
    private function organizeLogFiles() {
        echo "📄 Organizing log files...\n";
        
        $log_dir = $this->base_dir . '/logs';
        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0755, true);
        }
        
        $log_files = glob($this->base_dir . '/*.log');
        foreach ($log_files as $file) {
            $filename = basename($file);
            rename($file, $log_dir . '/' . $filename);
            echo "  - Moved: {$filename} to logs/\n";
        }
    }
    
    /**
     * Clean temporary files
     */
    private function cleanTempFiles() {
        echo "🗑️  Cleaning temporary files...\n";
        
        $temp_patterns = [
            '*.tmp',
            '*.bak',
            '*~',
            '.DS_Store',
            'Thumbs.db'
        ];
        
        foreach ($temp_patterns as $pattern) {
            $files = glob($this->base_dir . '/' . $pattern);
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                    echo "  - Deleted: " . basename($file) . "\n";
                }
            }
        }
    }
    
    /**
     * Update .gitignore file
     */
    private function updateGitignore() {
        echo "📝 Updating .gitignore...\n";
        
        $gitignore_content = "# Dependencies
node_modules/
vendor/

# Environment files
.env
.env.local
.env.production

# Build outputs
dist/
build/

# Logs
logs/
*.log

# Archive
_archive/

# Temporary files
*.tmp
*.bak
*~
.DS_Store
Thumbs.db

# IDE files
.vscode/
.idea/
*.swp
*.swo

# OS files
.DS_Store
Thumbs.db

# Security
*.pem
*.key
id_rsa*
ssh_key*

# Test files
debug*
test-*
*-test.php

# Cache
.cache/
*.cache
";
        
        file_put_contents($this->base_dir . '/.gitignore', $gitignore_content);
        echo "  - Updated .gitignore\n";
    }
    
    /**
     * Show organized directory structure
     */
    private function showDirectoryStructure() {
        echo "\n📂 Current directory structure:\n";
        echo "┌── Core Files\n";
        echo "│   ├── index.php (main landing page)\n";
        echo "│   ├── content-config.php (centralized config)\n";
        echo "│   └── static-generator.php (build system)\n";
        echo "├── Components/\n";
        echo "│   ├── services.php\n";
        echo "│   ├── about-us.php\n";
        echo "│   ├── contact.php\n";
        echo "│   ├── portfolio.php\n";
        echo "│   ├── testimonials.php\n";
        echo "│   ├── roi-calculator.php\n";
        echo "│   ├── process.php\n";
        echo "│   └── renderer.php\n";
        echo "├── Configuration/\n";
        echo "│   ├── config.php\n";
        echo "│   ├── security-config.php\n";
        echo "│   └── smtp-config.php\n";
        echo "├── Handlers/\n";
        echo "│   ├── contact-handler.php\n";
        echo "│   └── security-check.php\n";
        echo "├── Static Assets/\n";
        echo "│   └── assets/ (images, logos)\n";
        echo "├── API/\n";
        echo "│   └── api/ (endpoint files)\n";
        echo "├── Build System/\n";
        echo "│   ├── build-pipeline.php\n";
        echo "│   └── cleanup.php\n";
        echo "├── Documentation/\n";
        echo "│   ├── DEPLOYMENT.md\n";
        echo "│   ├── SETUP.md\n";
        echo "│   └── UX-POLISH-SUMMARY.md\n";
        echo "└── Archive/\n";
        echo "    └── _archive/ (old/test files)\n";
    }
}

// CLI usage
if (php_sapi_name() === 'cli') {
    $cleanup = new DirectoryCleanup();
    $cleanup->runCleanup();
} else {
    echo "This script should be run from the command line.\n";
    echo "Usage: php cleanup.php\n";
}
?>
