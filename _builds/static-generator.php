<?php
/**
 * Static Site Generator
 * Generates static HTML files for better performance and CDN caching
 */

class StaticSiteGenerator {
    private $config;
    private $output_dir;
    private $base_url;
    
    public function __construct() {
        $this->config = require_once 'content-config.php';
        $this->output_dir = $this->config['static_generation']['output_dir'];
        $this->base_url = 'https://august.com.pk';
        
        // Create output directory if it doesn't exist
        if (!is_dir($this->output_dir)) {
            mkdir($this->output_dir, 0755, true);
        }
    }
    
    /**
     * Generate all static pages
     */
    public function generateAll() {
        echo "🚀 Starting static site generation...\n";
        
        // Generate main pages
        $this->generateStaticRoutes();
        
        // Generate dynamic content pages (when CMS is implemented)
        $this->generateDynamicRoutes();
        
        // Copy assets
        $this->copyAssets();
        
        // Generate sitemap
        $this->generateSitemap();
        
        echo "✅ Static site generation complete!\n";
        echo "📁 Output directory: {$this->output_dir}\n";
    }
    
    /**
     * Generate static routes from config
     */
    private function generateStaticRoutes() {
        echo "📄 Generating static routes...\n";
        
        foreach ($this->config['static_generation']['routes'] as $route => $file) {
            $output_file = $this->getOutputPath($route);
            
            echo "  - Generating: {$route} -> {$output_file}\n";
            
            // Capture output from PHP file
            ob_start();
            
            if ($route === '/') {
                // Main index page
                include $file;
            } elseif ($route === '/privacy') {
                // Privacy policy page with full layout
                include 'privacy.php';
            } else {
                // Component pages - use standalone renderer
                require_once 'components/renderer.php';
                $renderer = new ComponentRenderer();
                $component_name = basename($file, '.php');
                $renderer->renderStandalone($component_name);
            }
            
            $content = ob_get_clean();
            
            // Create directory if needed
            $dir = dirname($output_file);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            
            // Write static HTML
            file_put_contents($output_file, $content);
        }
    }
    
    /**
     * Generate dynamic content routes (for future CMS integration)
     */
    private function generateDynamicRoutes() {
        echo "🔄 Preparing dynamic route generation...\n";
        
        // This will be populated when CMS is integrated
        $content_items = [
            // Example structure for when CMS is implemented:
            // 'blog_posts' => $this->fetchBlogPosts(),
            // 'case_studies' => $this->fetchCaseStudies(),
            // 'job_postings' => $this->fetchJobPostings()
        ];
        
        foreach ($content_items as $content_type => $items) {
            $route_pattern = $this->config['static_generation']['dynamic_routes'][$content_type];
            
            foreach ($items as $item) {
                $route = str_replace('{slug}', $item['slug'], $route_pattern);
                $output_file = $this->getOutputPath($route);
                
                echo "  - Generating: {$route} -> {$output_file}\n";
                
                // Generate content using template system
                $template = new PageTemplate();
                ob_start();
                
                switch ($content_type) {
                    case 'blog_posts':
                        $template->renderBlogPost($item);
                        break;
                    case 'case_studies':
                        $template->renderCaseStudy($item);
                        break;
                    // Add more content types as needed
                }
                
                $content = ob_get_clean();
                
                // Create directory and write file
                $dir = dirname($output_file);
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                
                file_put_contents($output_file, $content);
            }
        }
        
        echo "ℹ️  Dynamic routes will be populated when CMS is integrated\n";
    }
    
    /**
     * Copy static assets
     */
    private function copyAssets() {
        echo "📁 Copying assets...\n";
        
        $asset_dirs = ['assets', 'api'];
        
        foreach ($asset_dirs as $dir) {
            if (is_dir($dir)) {
                $this->copyDirectory($dir, $this->output_dir . '/' . $dir);
                echo "  - Copied: {$dir}\n";
            }
        }
    }
    
    /**
     * Generate XML sitemap
     */
    private function generateSitemap() {
        echo "🗺️  Generating sitemap...\n";
        
        $urls = [];
        
        // Add static routes
        foreach ($this->config['static_generation']['routes'] as $route => $file) {
            $urls[] = [
                'loc' => $this->base_url . $route,
                'lastmod' => date('Y-m-d'),
                'changefreq' => $route === '/' ? 'weekly' : 'monthly',
                'priority' => $route === '/' ? '1.0' : '0.8'
            ];
        }
        
        // Generate XML
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
        
        foreach ($urls as $url_data) {
            $url = $xml->addChild('url');
            $url->addChild('loc', htmlspecialchars($url_data['loc']));
            $url->addChild('lastmod', $url_data['lastmod']);
            $url->addChild('changefreq', $url_data['changefreq']);
            $url->addChild('priority', $url_data['priority']);
        }
        
        $sitemap_content = $xml->asXML();
        file_put_contents($this->output_dir . '/sitemap.xml', $sitemap_content);
        
        echo "  - Generated: sitemap.xml\n";
    }
    
    /**
     * Get output file path for a route
     */
    private function getOutputPath($route) {
        if ($route === '/') {
            return $this->output_dir . '/index.html';
        }
        
        // Remove leading slash and add .html
        $path = ltrim($route, '/');
        return $this->output_dir . '/' . $path . '/index.html';
    }
    
    /**
     * Copy directory recursively
     */
    private function copyDirectory($source, $destination) {
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }
        
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $item) {
            $target = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            
            if ($item->isDir()) {
                if (!is_dir($target)) {
                    mkdir($target, 0755, true);
                }
            } else {
                copy($item, $target);
            }
        }
    }
    
    /**
     * Deploy to CDN (future implementation)
     */
    public function deployToCDN() {
        echo "🌐 CDN deployment will be implemented based on hosting provider\n";
        echo "📋 Recommended CDN deployment steps:\n";
        echo "  1. Upload {$this->output_dir} to CDN origin\n";
        echo "  2. Purge CDN cache\n";
        echo "  3. Update DNS if needed\n";
        echo "  4. Test all routes\n";
    }
}

// CLI usage
if (php_sapi_name() === 'cli') {
    $generator = new StaticSiteGenerator();
    
    $command = $argv[1] ?? 'generate';
    
    switch ($command) {
        case 'generate':
            $generator->generateAll();
            break;
        case 'deploy':
            $generator->generateAll();
            $generator->deployToCDN();
            break;
        default:
            echo "Usage: php static-generator.php [generate|deploy]\n";
            break;
    }
}
?>
