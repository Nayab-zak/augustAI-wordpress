<?php
/**
 * Privacy Policy Page
 * Standalone privacy policy page with full site styling
 */

// Load configuration
$content_config = require_once 'content-config.php';
$services = $content_config['services'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy — augustAI | AI Automation Solutions</title>
    <meta name="description" content="augustAI Privacy Policy - How we collect, use, and protect your personal information. Transparent data practices for our AI automation and dashboard services.">
    <meta name="keywords" content="privacy policy, data protection, augustAI, AI automation, data security">
    <meta name="author" content="augustAI">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://august.com.pk/privacy">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/augustai_logo_only.png">
    <link rel="shortcut icon" href="assets/augustai_logo_only.png">
    <link rel="apple-touch-icon" href="assets/augustai_logo_only.png">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"></noscript>
    
    <!-- Preload hero images -->
    <link rel="preload" href="assets/augustAI Logo Design on Purple Gradient.png" as="image" type="image/png">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://august.com.pk/privacy">
    <meta property="og:title" content="Privacy Policy — augustAI | AI Automation Solutions">
    <meta property="og:description" content="augustAI Privacy Policy - How we collect, use, and protect your personal information. Transparent data practices for our AI automation services.">
    <meta property="og:image" content="https://august.com.pk/assets/augustAI Logo Design on Purple Gradient.png">
    <meta property="og:site_name" content="augustAI">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://august.com.pk/privacy">
    <meta property="twitter:title" content="Privacy Policy — augustAI">
    <meta property="twitter:description" content="augustAI Privacy Policy - Transparent data practices for our AI automation and dashboard services.">
    <meta property="twitter:image" content="https://august.com.pk/assets/augustAI Logo Design on Purple Gradient.png">
    
    <!-- Fonts and Icons -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css"></noscript>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
        /* Import shared styles from main site */
        :root {
            --primary-gradient: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 50%, #4C1D95 100%);
            --secondary-gradient: linear-gradient(135deg, #A855F7 0%, #7C3AED 50%, #5B21B6 100%);
            --accent-gradient: linear-gradient(135deg, #C084FC 0%, #9333EA 50%, #6B21A8 100%);
            --dark-gradient: linear-gradient(135deg, #0F0A1A 0%, #1E1B3A 50%, #2D1B4E 100%);
            --card-gradient: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(109, 40, 217, 0.05) 100%);
            --glow-color: rgba(139, 92, 246, 0.4);
            --purple-primary: #8B5CF6;
            --purple-secondary: #6D28D9;
            --purple-accent: #A855F7;
            --purple-dark: #4C1D95;
            --purple-light: #C084FC;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--dark-gradient);
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
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.2);
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

        /* Navigation */
        .navbar {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
            transition: all 0.3s ease;
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
            box-shadow: 0 15px 30px rgba(139, 92, 246, 0.4);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gradient);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-gradient);
        }
    </style>
    
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "@id": "https://august.com.pk/privacy",
        "url": "https://august.com.pk/privacy",
        "name": "Privacy Policy - augustAI",
        "description": "augustAI Privacy Policy - How we collect, use, and protect your personal information.",
        "isPartOf": {
            "@id": "https://august.com.pk/#website"
        },
        "about": {
            "@type": "Organization",
            "@id": "https://august.com.pk/#organization"
        },
        "dateModified": "2025-08-03",
        "inLanguage": "en"
    }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <picture>
                            <source srcset="assets/augustAI Logo Design on Purple Gradient.webp" type="image/webp">
                            <img src="assets/augustAI Logo Design on Purple Gradient.png" alt="augustAI logo - AI automation solutions" class="h-12 md:h-16 object-contain" width="128" height="64" loading="eager">
                        </picture>
                    </a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">Home</a>
                    <a href="/#services" class="text-gray-300 hover:text-white transition-colors">Services</a>
                    <a href="/#about" class="text-gray-300 hover:text-white transition-colors">About</a>
                    <a href="/#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
                </div>
                <a href="/#contact" class="btn-primary">Get Started</a>
            </div>
        </div>
    </nav>

    <!-- Main content with top margin for fixed nav -->
    <main class="pt-20">
        <?php include 'components/privacy-policy.php'; ?>
    </main>

    <!-- Footer -->
    <footer class="py-12 px-4 bg-gray-900/50 border-t border-gray-800">
        <div class="max-w-7xl mx-auto text-center">
            <div class="mb-6">
                <picture>
                    <source srcset="assets/augustAI Logo Design on Purple Gradient.webp" type="image/webp">
                    <img src="assets/augustAI Logo Design on Purple Gradient.png" alt="augustAI logo" class="mx-auto h-12 object-contain opacity-70" width="96" height="48">
                </picture>
            </div>
            <div class="flex justify-center space-x-8 mb-6">
                <a href="/" class="text-gray-400 hover:text-white transition-colors">Home</a>
                <a href="/#services" class="text-gray-400 hover:text-white transition-colors">Services</a>
                <a href="/privacy" class="text-purple-400 font-semibold">Privacy Policy</a>
                <a href="/#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a>
            </div>
            <p class="text-gray-500 text-sm">
                © 2025 augustAI. All rights reserved. | 
                <span class="text-gray-400">Leading AI automation company in Pakistan & UAE</span>
            </p>
        </div>
    </footer>

    <script>
        // Fade in animation on scroll
        function handleScrollAnimations() {
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
        window.addEventListener('scroll', handleScrollAnimations);
        window.addEventListener('load', handleScrollAnimations);
        
        // Initial check
        handleScrollAnimations();

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
