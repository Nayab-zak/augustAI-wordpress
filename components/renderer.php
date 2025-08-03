<?php
/**
 * Component Template System
 * Provides methods to render different page components
 */

class ComponentRenderer {
    private $base_path;
    
    public function __construct($base_path = __DIR__) {
        $this->base_path = $base_path;
    }
    
    /**
     * Render a component with optional data
     */
    public function render($component, $data = []) {
        $component_file = $this->base_path . '/components/' . $component . '.php';
        
        if (!file_exists($component_file)) {
            throw new Exception("Component not found: {$component}");
        }
        
        // Extract data variables for use in component
        extract($data);
        
        // Include component file
        include $component_file;
    }
    
    /**
     * Render full page layout
     */
    public function renderPage($title, $components, $data = []) {
        $this->renderHeader($title);
        
        foreach ($components as $component => $component_data) {
            if (is_string($component_data)) {
                // Simple component name
                $this->render($component_data, $data);
            } else {
                // Component with specific data
                $this->render($component, array_merge($data, $component_data));
            }
        }
        
        $this->renderFooter();
    }
    
    /**
     * Render page header
     */
    private function renderHeader($title) {
        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"en\">\n";
        echo "<head>\n";
        echo "    <meta charset=\"UTF-8\">\n";
        echo "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
        echo "    <title>{$title} - augustAI</title>\n";
        echo "    <meta name=\"description\" content=\"Leading AI automation company in Pakistan & UAE. We build Python automations, 10-day dashboards & MVPs for SMEs.\">\n";
        echo "    \n";
        echo "    <!-- Fonts and Icons -->\n";
        echo "    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap\" rel=\"stylesheet\">\n";
        echo "    <link href=\"https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css\" rel=\"stylesheet\">\n";
        echo "    <link href=\"https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css\" rel=\"stylesheet\">\n";
        echo "    \n";
        echo "    <!-- Shared Styles -->\n";
        echo "    <style>\n";
        echo $this->getSharedStyles();
        echo "    </style>\n";
        echo "</head>\n";
        echo "<body>\n";
        echo "<div class=\"min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-blue-900\">\n";
        
        // Include navigation
        $this->render('navigation');
    }
    
    /**
     * Render page footer
     */
    private function renderFooter() {
        echo "    <script>\n";
        echo $this->getSharedJavaScript();
        echo "    </script>\n";
        echo "</div>\n";
        echo "</body>\n";
        echo "</html>\n";
    }
    
    /**
     * Get shared CSS styles
     */
    private function getSharedStyles() {
        return "
        :root {
            --primary-gradient: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 50%, #4C1D95 100%);
            --secondary-gradient: linear-gradient(135deg, #A855F7 0%, #7C3AED 50%, #5B21B6 100%);
            --glow-color: rgba(139, 92, 246, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #ffffff;
            overflow-x: hidden;
            line-height: 1.7;
        }

        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(103, 126, 234, 0.2);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            padding: 14px 32px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(103, 126, 234, 0.4);
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Intro pricing badge */
        .intro-pricing-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
            animation: subtle-pulse 2s infinite;
            white-space: nowrap;
        }
        
        @keyframes subtle-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        ";
    }
    
    /**
     * Get shared JavaScript functions
     */
    private function getSharedJavaScript() {
        return "
        // Animate elements on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        }

        // Initialize animations
        window.addEventListener('DOMContentLoaded', () => {
            animateOnScroll();
            window.addEventListener('scroll', animateOnScroll);
        });

        // Smooth scrolling function
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Calendly modal function
        function openCalendlyModal() {
            alert('Calendly integration would open here');
        }
        ";
    }
    
    /**
     * Standalone component page (for testing/development)
     */
    public function renderStandalone($component, $data = []) {
        // Load content config
        $content_config = require_once $this->base_path . '/content-config.php';
        $services = $content_config['services'] ?? [];
        
        // Merge with provided data
        $data = array_merge(['services' => $services], $data);
        
        $this->renderHeader(ucfirst($component));
        
        echo "<main id=\"main\" role=\"main\">\n";
        $this->render($component, $data);
        echo "</main>\n";
        
        $this->renderFooter();
    }
}

// Usage examples:
// $renderer = new ComponentRenderer();
// $renderer->render('services');
// $renderer->renderStandalone('roi-calculator');
?>
