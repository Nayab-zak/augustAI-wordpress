<?php
/**
 * Page Template System
 * Prepares for headless CMS content rendering
 */

class PageTemplate {
    private $content_config;
    private $seo_defaults;
    
    public function __construct() {
        $this->content_config = require_once 'content-config.php';
        $this->seo_defaults = [
            'site_name' => 'augustAI',
            'base_url' => 'https://august.com.pk',
            'default_image' => 'assets/augustAI Logo Design on Purple Gradient.png'
        ];
    }
    
    /**
     * Render page header with SEO meta tags
     */
    public function renderHeader($page_data = []) {
        $title = isset($page_data['seo_title']) ? $page_data['seo_title'] : $page_data['title'] ?? 'augustAI — Automate Everything';
        $description = $page_data['seo_description'] ?? 'Leading AI automation company in Pakistan & UAE. We build Python automations, 10-day dashboards & MVPs for SMEs.';
        $canonical = $this->seo_defaults['base_url'] . ($page_data['canonical'] ?? '/');
        $image = $page_data['featured_image'] ?? $this->seo_defaults['default_image'];
        
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($title); ?></title>
            <meta name="description" content="<?php echo htmlspecialchars($description); ?>">
            <link rel="canonical" href="<?php echo $canonical; ?>">
            
            <!-- Open Graph -->
            <meta property="og:type" content="<?php echo $page_data['og_type'] ?? 'website'; ?>">
            <meta property="og:url" content="<?php echo $canonical; ?>">
            <meta property="og:title" content="<?php echo htmlspecialchars($title); ?>">
            <meta property="og:description" content="<?php echo htmlspecialchars($description); ?>">
            <meta property="og:image" content="<?php echo $this->seo_defaults['base_url'] . '/' . $image; ?>">
            <meta property="og:site_name" content="<?php echo $this->seo_defaults['site_name']; ?>">
            
            <!-- Twitter -->
            <meta name="twitter:card" content="summary_large_image">
            <meta name="twitter:title" content="<?php echo htmlspecialchars($title); ?>">
            <meta name="twitter:description" content="<?php echo htmlspecialchars($description); ?>">
            <meta name="twitter:image" content="<?php echo $this->seo_defaults['base_url'] . '/' . $image; ?>">
            
            <!-- Include common styles and scripts -->
            <?php $this->includeAssets(); ?>
        </head>
        <body>
            <?php $this->renderNavigation(); ?>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Include common CSS and JavaScript assets
     */
    private function includeAssets() {
        ?>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="assets/augustai_logo_only.png">
        
        <!-- Fonts -->
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"></noscript>
        
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/common-styles.css">
        
        <!-- Security headers -->
        <?php require_once 'security-config.php'; ?>
        <?php
    }
    
    /**
     * Render common navigation
     */
    private function renderNavigation() {
        ?>
        <nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center">
                        <a href="/">
                            <img src="assets/augustAI Logo Design on Purple Gradient.png" 
                                 alt="augustAI logo" class="h-12 md:h-16 object-contain" 
                                 width="128" height="64" loading="eager">
                        </a>
                    </div>
                    <div class="hidden md:flex space-x-8">
                        <a href="/#services" class="text-gray-300 hover:text-white transition-colors">Services</a>
                        <a href="/case-studies" class="text-gray-300 hover:text-white transition-colors">Case Studies</a>
                        <a href="/blog" class="text-gray-300 hover:text-white transition-colors">Blog</a>
                        <a href="/careers" class="text-gray-300 hover:text-white transition-colors">Careers</a>
                        <a href="/#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
                    </div>
                    <button onclick="openCalendlyModal()" class="btn-primary">Book 30-min Call</button>
                </div>
            </div>
        </nav>
        <?php
    }
    
    /**
     * Render blog post template
     */
    public function renderBlogPost($post_data) {
        echo $this->renderHeader($post_data);
        ?>
        <main class="pt-20">
            <article class="max-w-4xl mx-auto px-4 py-16">
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <a href="/blog" class="text-purple-400 hover:text-purple-300">← Back to Blog</a>
                </nav>
                
                <!-- Header -->
                <header class="mb-12">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
                        <?php echo htmlspecialchars($post_data['title']); ?>
                    </h1>
                    
                    <div class="flex items-center space-x-6 text-gray-400 mb-6">
                        <span><?php echo date('F j, Y', strtotime($post_data['published_date'])); ?></span>
                        <span>•</span>
                        <span><?php echo $post_data['category']; ?></span>
                        <span>•</span>
                        <span><?php echo $this->estimateReadTime($post_data['content']); ?> min read</span>
                    </div>
                    
                    <?php if (isset($post_data['featured_image'])): ?>
                    <img src="<?php echo $post_data['featured_image']; ?>" 
                         alt="<?php echo htmlspecialchars($post_data['title']); ?>"
                         class="w-full h-64 md:h-96 object-cover rounded-lg">
                    <?php endif; ?>
                </header>
                
                <!-- Content -->
                <div class="prose prose-lg prose-invert max-w-none">
                    <?php echo $this->renderContent($post_data['content']); ?>
                </div>
                
                <!-- Tags -->
                <?php if (isset($post_data['tags']) && !empty($post_data['tags'])): ?>
                <div class="mt-12 pt-8 border-t border-gray-700">
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($post_data['tags'] as $tag): ?>
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">
                            <?php echo htmlspecialchars($tag); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- CTA -->
                <div class="mt-16 text-center bg-gradient-to-r from-purple-900/20 to-pink-900/20 p-8 rounded-lg">
                    <h3 class="text-2xl font-bold mb-4">Ready to automate your business?</h3>
                    <p class="text-gray-300 mb-6">Let's discuss how our automation solutions can transform your workflows.</p>
                    <button onclick="openCalendlyModal()" class="btn-primary">Book Free Consultation</button>
                </div>
            </article>
        </main>
        <?php
        $this->renderFooter();
    }
    
    /**
     * Render case study template
     */
    public function renderCaseStudy($case_data) {
        echo $this->renderHeader($case_data);
        ?>
        <main class="pt-20">
            <article class="max-w-6xl mx-auto px-4 py-16">
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <a href="/case-studies" class="text-purple-400 hover:text-purple-300">← Back to Case Studies</a>
                </nav>
                
                <!-- Header -->
                <header class="mb-16">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
                                <?php echo htmlspecialchars($case_data['title']); ?>
                            </h1>
                            
                            <div class="space-y-4 text-lg">
                                <div><strong>Client:</strong> <?php echo htmlspecialchars($case_data['client_name']); ?></div>
                                <div><strong>Industry:</strong> <?php echo htmlspecialchars($case_data['client_industry']); ?></div>
                                <div><strong>Project Type:</strong> <?php echo htmlspecialchars($case_data['project_type']); ?></div>
                                <div><strong>Duration:</strong> <?php echo htmlspecialchars($case_data['project_duration']); ?></div>
                            </div>
                        </div>
                        
                        <?php if (isset($case_data['featured_image'])): ?>
                        <div>
                            <img src="<?php echo $case_data['featured_image']; ?>" 
                                 alt="<?php echo htmlspecialchars($case_data['title']); ?>"
                                 class="w-full h-64 md:h-80 object-cover rounded-lg">
                        </div>
                        <?php endif; ?>
                    </div>
                </header>
                
                <!-- Results Metrics -->
                <?php if (isset($case_data['metrics'])): ?>
                <section class="mb-16">
                    <h2 class="text-3xl font-bold mb-8 text-center gradient-text">Results Achieved</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        <?php foreach ($case_data['metrics'] as $metric): ?>
                        <div class="text-center glass-card p-6">
                            <div class="text-4xl font-bold gradient-text mb-2"><?php echo $metric['value']; ?></div>
                            <div class="text-gray-300"><?php echo $metric['label']; ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>
                
                <!-- Challenge, Solution, Results -->
                <div class="grid md:grid-cols-1 gap-16">
                    <section>
                        <h2 class="text-3xl font-bold mb-6 gradient-text">The Challenge</h2>
                        <div class="prose prose-lg prose-invert">
                            <?php echo $this->renderContent($case_data['challenge']); ?>
                        </div>
                    </section>
                    
                    <section>
                        <h2 class="text-3xl font-bold mb-6 gradient-text">Our Solution</h2>
                        <div class="prose prose-lg prose-invert">
                            <?php echo $this->renderContent($case_data['solution']); ?>
                        </div>
                    </section>
                    
                    <section>
                        <h2 class="text-3xl font-bold mb-6 gradient-text">Results & Impact</h2>
                        <div class="prose prose-lg prose-invert">
                            <?php echo $this->renderContent($case_data['results']); ?>
                        </div>
                    </section>
                </div>
                
                <!-- Testimonial -->
                <?php if (isset($case_data['testimonial'])): ?>
                <section class="mt-16">
                    <blockquote class="text-center bg-gradient-to-r from-purple-900/20 to-pink-900/20 p-8 rounded-lg">
                        <p class="text-xl italic mb-4">"<?php echo htmlspecialchars($case_data['testimonial']); ?>"</p>
                        <cite class="text-purple-300">— <?php echo htmlspecialchars($case_data['client_name']); ?></cite>
                    </blockquote>
                </section>
                <?php endif; ?>
                
                <!-- CTA -->
                <div class="mt-16 text-center">
                    <h3 class="text-2xl font-bold mb-4">Want similar results for your business?</h3>
                    <button onclick="openCalendlyModal()" class="btn-primary">Start Your Project</button>
                </div>
            </article>
        </main>
        <?php
        $this->renderFooter();
    }
    
    /**
     * Render common footer
     */
    private function renderFooter() {
        ?>
        <footer class="py-12 px-4 border-t border-gray-800" role="contentinfo">
            <div class="max-w-6xl mx-auto text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <img src="assets/augustai_logo_only.png" alt="augustAI" class="w-10 h-10" loading="lazy">
                    <span class="text-xl font-bold gradient-text">augustAI</span>
                </div>
                <p class="text-gray-400">© <?php echo date('Y'); ?> augustAI. Automate Everything.</p>
            </div>
        </footer>
        </body>
        </html>
        <?php
    }
    
    /**
     * Estimate reading time for content
     */
    private function estimateReadTime($content) {
        $word_count = str_word_count(strip_tags($content));
        return max(1, round($word_count / 200)); // Average reading speed: 200 words per minute
    }
    
    /**
     * Render rich text content (prepare for headless CMS)
     */
    private function renderContent($content) {
        // For now, simple HTML rendering
        // This will be replaced with proper rich text rendering from CMS
        return $content;
    }
}
?>
