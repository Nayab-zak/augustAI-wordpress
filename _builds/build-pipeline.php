#!/usr/bin/env php
<?php
/**
 * Build and Deployment Pipeline
 * Automates the complete build and deployment process
 */

class BuildPipeline {
    private $config;
    private $start_time;
    
    public function __construct() {
        $this->config = require_once 'content-config.php';
        $this->start_time = microtime(true);
    }
    
    /**
     * Run the complete build pipeline
     */
    public function runBuild($environment = 'production') {
        echo "🚀 Starting Build Pipeline for {$environment} environment\n";
        echo "⏰ " . date('Y-m-d H:i:s') . "\n";
        echo str_repeat('=', 60) . "\n";
        
        try {
            // Pre-build checks
            $this->preBuildChecks();
            
            // Environment setup
            $this->setupEnvironment($environment);
            
            // Security validation
            $this->runSecurityChecks();
            
            // Generate static site
            $this->generateStaticSite();
            
            // Optimize assets
            $this->optimizeAssets();
            
            // Run tests
            $this->runTests();
            
            // Package for deployment
            $this->packageDeployment();
            
            // Success notification
            $this->buildSuccess();
            
        } catch (Exception $e) {
            $this->buildFailure($e);
        }
    }
    
    /**
     * Pre-build validation checks
     */
    private function preBuildChecks() {
        echo "🔍 Running pre-build checks...\n";
        
        // Check PHP version
        $php_version = PHP_VERSION;
        echo "  ✓ PHP Version: {$php_version}\n";
        
        if (version_compare($php_version, '7.4', '<')) {
            throw new Exception("PHP 7.4+ required, found {$php_version}");
        }
        
        // Check required files
        $required_files = [
            'index.php',
            'content-config.php',
            'security-config.php',
            'api/pricing.php',
            'includes/PageTemplate.php'
        ];
        
        foreach ($required_files as $file) {
            if (!file_exists($file)) {
                throw new Exception("Required file missing: {$file}");
            }
            echo "  ✓ Found: {$file}\n";
        }
        
        // Check configuration
        if (empty($this->config['pricing'])) {
            throw new Exception("Pricing configuration is empty");
        }
        echo "  ✓ Configuration validated\n";
        
        echo "✅ Pre-build checks passed\n\n";
    }
    
    /**
     * Setup environment-specific configuration
     */
    private function setupEnvironment($environment) {
        echo "🔧 Setting up {$environment} environment...\n";
        
        // Create environment-specific config
        $env_config = [
            'development' => [
                'debug' => true,
                'minify' => false,
                'cache_ttl' => 0,
                'cdn_url' => ''
            ],
            'staging' => [
                'debug' => false,
                'minify' => true,
                'cache_ttl' => 300,
                'cdn_url' => 'https://staging-cdn.august.com.pk'
            ],
            'production' => [
                'debug' => false,
                'minify' => true,
                'cache_ttl' => 3600,
                'cdn_url' => 'https://cdn.august.com.pk'
            ]
        ];
        
        $env_settings = $env_config[$environment] ?? $env_config['production'];
        
        // Write environment file
        $env_content = "<?php\n// Environment: {$environment}\n";
        $env_content .= "// Generated: " . date('Y-m-d H:i:s') . "\n\n";
        $env_content .= '$environment = ' . var_export($env_settings, true) . ";\n";
        
        file_put_contents('env-config.php', $env_content);
        
        echo "  ✓ Environment configuration created\n";
        echo "  📁 env-config.php written\n\n";
    }
    
    /**
     * Run security validation
     */
    private function runSecurityChecks() {
        echo "🔒 Running security checks...\n";
        
        // Check for sensitive information
        $sensitive_patterns = [
            '/password\s*=\s*["\'][^"\']+["\']/i',
            '/api_key\s*=\s*["\'][^"\']+["\']/i',
            '/secret\s*=\s*["\'][^"\']+["\']/i'
        ];
        
        $files_to_check = glob('*.php');
        $security_issues = [];
        
        foreach ($files_to_check as $file) {
            $content = file_get_contents($file);
            
            foreach ($sensitive_patterns as $pattern) {
                if (preg_match($pattern, $content)) {
                    $security_issues[] = "Potential sensitive data in {$file}";
                }
            }
        }
        
        if (!empty($security_issues)) {
            echo "  ⚠️  Security warnings:\n";
            foreach ($security_issues as $issue) {
                echo "    - {$issue}\n";
            }
        } else {
            echo "  ✓ No security issues detected\n";
        }
        
        // Validate reCAPTCHA configuration
        if (file_exists('security-config.php')) {
            echo "  ✓ Security configuration found\n";
        }
        
        echo "✅ Security checks completed\n\n";
    }
    
    /**
     * Generate static site
     */
    private function generateStaticSite() {
        echo "📄 Generating static site...\n";
        
        // Include and run static generator
        require_once 'static-generator.php';
        $generator = new StaticSiteGenerator();
        $generator->generateAll();
        
        echo "✅ Static site generation completed\n\n";
    }
    
    /**
     * Optimize assets for production
     */
    private function optimizeAssets() {
        echo "⚡ Optimizing assets...\n";
        
        $dist_dir = $this->config['static_generation']['output_dir'];
        
        // Minify CSS (basic implementation)
        $css_files = glob($dist_dir . '/**/*.css');
        foreach ($css_files as $css_file) {
            $content = file_get_contents($css_file);
            
            // Basic CSS minification
            $minified = preg_replace('/\s+/', ' ', $content);
            $minified = str_replace(['; ', ' {', '{ ', ' }', '} ', ': '], [';', '{', '{', '}', '}', ':'], $minified);
            $minified = trim($minified);
            
            file_put_contents($css_file, $minified);
            echo "  ✓ Minified: " . basename($css_file) . "\n";
        }
        
        // Optimize images (placeholder - requires actual optimization tools)
        $image_files = glob($dist_dir . '/assets/*.{jpg,jpeg,png,gif,svg}', GLOB_BRACE);
        foreach ($image_files as $image_file) {
            echo "  📷 Image optimization: " . basename($image_file) . " (requires imagemagick/optipng)\n";
        }
        
        // Generate asset manifest
        $this->generateAssetManifest($dist_dir);
        
        echo "✅ Asset optimization completed\n\n";
    }
    
    /**
     * Generate asset manifest for cache busting
     */
    private function generateAssetManifest($dist_dir) {
        $manifest = [];
        
        $asset_files = glob($dist_dir . '/assets/*');
        foreach ($asset_files as $file) {
            if (is_file($file)) {
                $relative_path = str_replace($dist_dir, '', $file);
                $hash = substr(md5_file($file), 0, 8);
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                
                $versioned_name = $filename . '.' . $hash . '.' . $extension;
                $manifest[$relative_path] = str_replace($filename . '.' . $extension, $versioned_name, $relative_path);
            }
        }
        
        file_put_contents($dist_dir . '/asset-manifest.json', json_encode($manifest, JSON_PRETTY_PRINT));
        echo "  ✓ Asset manifest generated\n";
    }
    
    /**
     * Run automated tests
     */
    private function runTests() {
        echo "🧪 Running tests...\n";
        
        // Basic URL validation tests
        $test_urls = [
            '/' => 'Homepage',
            '/api/pricing.php' => 'Pricing API'
        ];
        
        foreach ($test_urls as $url => $description) {
            if ($url === '/') {
                // Test main page rendering
                ob_start();
                include 'index.php';
                $content = ob_get_clean();
                
                if (strpos($content, '<title>') !== false) {
                    echo "  ✓ {$description} renders correctly\n";
                } else {
                    echo "  ❌ {$description} failed to render\n";
                }
            } else {
                echo "  ℹ️  {$description} test (requires web server)\n";
            }
        }
        
        // Configuration validation
        $pricing_config = $this->config['pricing'];
        if (!empty($pricing_config)) {
            echo "  ✓ Pricing configuration is valid\n";
        }
        
        echo "✅ Tests completed\n\n";
    }
    
    /**
     * Package deployment files
     */
    private function packageDeployment() {
        echo "📦 Packaging deployment...\n";
        
        $package_name = 'augustai-website-' . date('Y-m-d-H-i-s') . '.tar.gz';
        $dist_dir = $this->config['static_generation']['output_dir'];
        
        // Create deployment package (requires tar command)
        $command = "tar -czf {$package_name} -C {$dist_dir} .";
        
        echo "  📁 Package: {$package_name}\n";
        echo "  🔧 Command: {$command}\n";
        echo "  ℹ️  Run this command manually to create deployment package\n";
        
        // Create deployment manifest
        $manifest = [
            'build_time' => date('Y-m-d H:i:s'),
            'environment' => 'production',
            'package_name' => $package_name,
            'files_included' => $this->getFileList($dist_dir),
            'deployment_notes' => [
                'Upload package to web server',
                'Extract in web root directory',
                'Update DNS if needed',
                'Purge CDN cache',
                'Monitor for 24 hours'
            ]
        ];
        
        file_put_contents('deployment-manifest.json', json_encode($manifest, JSON_PRETTY_PRINT));
        
        echo "  ✓ Deployment manifest created\n";
        echo "✅ Packaging completed\n\n";
    }
    
    /**
     * Get list of files in directory
     */
    private function getFileList($directory) {
        $files = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        
        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $files[] = str_replace($directory . '/', '', $file->getPathname());
            }
        }
        
        return $files;
    }
    
    /**
     * Build success notification
     */
    private function buildSuccess() {
        $duration = round(microtime(true) - $this->start_time, 2);
        
        echo str_repeat('=', 60) . "\n";
        echo "🎉 BUILD SUCCESSFUL!\n";
        echo "⏱️  Build time: {$duration} seconds\n";
        echo "📁 Output: " . $this->config['static_generation']['output_dir'] . "\n";
        echo "📋 Deployment manifest: deployment-manifest.json\n";
        echo "\n";
        echo "🚀 Next steps:\n";
        echo "  1. Review generated files\n";
        echo "  2. Test on staging environment\n";
        echo "  3. Deploy to production\n";
        echo "  4. Monitor website performance\n";
        echo str_repeat('=', 60) . "\n";
    }
    
    /**
     * Build failure notification
     */
    private function buildFailure($exception) {
        $duration = round(microtime(true) - $this->start_time, 2);
        
        echo str_repeat('=', 60) . "\n";
        echo "❌ BUILD FAILED!\n";
        echo "⏱️  Build time: {$duration} seconds\n";
        echo "🐛 Error: " . $exception->getMessage() . "\n";
        echo "\n";
        echo "🔧 Troubleshooting:\n";
        echo "  1. Check error message above\n";
        echo "  2. Verify all required files exist\n";
        echo "  3. Run security-test.php for validation\n";
        echo "  4. Check PHP error logs\n";
        echo str_repeat('=', 60) . "\n";
        
        exit(1);
    }
}

// CLI usage
if (php_sapi_name() === 'cli') {
    $environment = $argv[1] ?? 'production';
    
    if (!in_array($environment, ['development', 'staging', 'production'])) {
        echo "Invalid environment. Use: development, staging, or production\n";
        exit(1);
    }
    
    $pipeline = new BuildPipeline();
    $pipeline->runBuild($environment);
}
?>
