<?php
// Load simple configuration 
require_once 'config-simple.php';

// Load pricing and content configuration
$content_config = require_once 'content-config.php';
$services = $content_config['services'];

// Debug information (remove in production)
if (isset($_GET['debug'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    echo "<!-- DEBUG: PHP is working, Services count: " . count($services) . " -->";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>augustAI — Automate Everything | AI Automation, Dashboards & MVPs</title>
    <meta name="description" content="Leading AI automation company in Pakistan & UAE. We build Python automations, 10-day dashboards & MVPs for SMEs. Fixed scope, fixed fee. Book free consultation.">
    <meta name="keywords" content="AI automation, agentic AI, dashboards, MVPs, Python automation, business intelligence, Pakistan, UAE, SME automation">
    <meta name="author" content="augustAI">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://august.com.pk/">
    
    <!-- Hreflang for international targeting -->
    <link rel="alternate" hreflang="en-pk" href="https://august.com.pk/">
    <link rel="alternate" hreflang="en-ae" href="https://august.com.pk/">
    <link rel="alternate" hreflang="en" href="https://august.com.pk/">
    
    <!-- Additional SEO meta tags -->
    <meta name="geo.region" content="PK-PB">
    <meta name="geo.placename" content="Lahore, Pakistan">
    <meta name="geo.position" content="31.5204;74.3587">
    <meta name="ICBM" content="31.5204, 74.3587">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/augustai_logo_only.png?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="assets/augustai_logo_only.png?v=<?php echo time(); ?>">
    <link rel="apple-touch-icon" href="assets/augustai_logo_only.png?v=<?php echo time(); ?>">\n
    
    <!-- Preload critical resources for better LCP -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"></noscript>
    
    <!-- Preload hero images -->
    <link rel="preload" href="assets/augustAI Logo Design on Purple Gradient.png" as="image" type="image/png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#8B5CF6">
    
    <!-- Performance optimizations -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//assets.calendly.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://august.com.pk/">
    <meta property="og:title" content="augustAI — Automate Everything | AI Automation Solutions">
    <meta property="og:description" content="Leading AI automation company in Pakistan & UAE. We build Python automations, 10-day dashboards & MVPs for SMEs. Fixed scope, fixed fee.">
    <meta property="og:image" content="https://august.com.pk/assets/augustAI Logo Design on Purple Gradient.png">
    <meta property="og:image:alt" content="augustAI - AI Automation and Dashboard Solutions">
    <meta property="og:site_name" content="augustAI">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://august.com.pk/">
    <meta property="twitter:title" content="augustAI — Automate Everything | AI Automation Solutions">
    <meta property="twitter:description" content="Leading AI automation company in Pakistan & UAE. We build Python automations, 10-day dashboards & MVPs for SMEs. Fixed scope, fixed fee.">
    <meta property="twitter:image" content="https://august.com.pk/assets/augustAI Logo Design on Purple Gradient.png">
    <meta property="twitter:image:alt" content="augustAI - AI Automation and Dashboard Solutions">
    
    <!-- Fonts and Icons -->
    <!-- Critical font preloaded above -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css"></noscript>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Security: reCAPTCHA v3 for spam protection -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : '6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'; ?>"></script>
    
    <!-- Defer Calendly script to improve FID/INP -->
    <script>
        // Load Calendly only when needed
        let calendlyLoaded = false;
        function loadCalendly() {
            if (!calendlyLoaded) {
                const script = document.createElement('script');
                script.src = 'https://assets.calendly.com/assets/external/widget.js';
                script.async = true;
                document.head.appendChild(script);
                calendlyLoaded = true;
            }
        }
        
        // reCAPTCHA v3 functionality
        function executeRecaptcha(action) {
            return new Promise((resolve, reject) => {
                if (typeof grecaptcha === 'undefined') {
                    console.warn('reCAPTCHA not loaded, proceeding without verification');
                    resolve(null);
                    return;
                }
                
                grecaptcha.ready(() => {
                    grecaptcha.execute('<?php echo defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : '6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'; ?>', {action: action})
                        .then((token) => {
                            resolve(token);
                        })
                        .catch((error) => {
                            console.error('reCAPTCHA error:', error);
                            reject(error);
                        });
                });
            });
        }
    </script>
    
    <style>
        /* Critical CSS - Above the fold styles */
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

        /* Critical above-the-fold styles */
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

        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Progressive enhancement - non-critical styles loaded below */

        /* Glassmorphism effects */
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
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

        /* Animated background particles */
        #particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: float 6s infinite linear;
            box-shadow: 0 0 6px rgba(255, 255, 255, 0.5);
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(0px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) translateX(100px);
                opacity: 0;
            }
        }

        /* Typewriter effect */
        .typewriter {
            overflow: hidden;
            border-right: 3px solid var(--glow-color);
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: var(--glow-color); }
        }

        /* Gradient text */
        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animated buttons */
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

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Floating CTA */
        .floating-cta {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            background: var(--accent-gradient);
            border-radius: 50px;
            padding: 16px 24px;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
            transform: translateY(100px);
            transition: all 0.3s ease;
        }

        .floating-cta.visible {
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

        .navbar.scrolled {
            background: rgba(0, 0, 0, 0.95);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Progress indicator */
        .progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: var(--primary-gradient);
            z-index: 1001;
            transition: width 0.3s ease;
        }

        /* Counter animation */
        .counter {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Noscript fallback styling */
        noscript .counter {
            font-size: 2.5rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
        }

        /* Team headshots styling */
        .team-headshot {
            transition: all 0.3s ease;
        }

        .team-headshot:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
        }

        /* Timeline */
        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary-gradient);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin: 50px 0;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.6s ease;
        }

        .timeline-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            width: 20px;
            height: 20px;
            background: var(--primary-gradient);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        /* FAQ Accordion */
        .faq-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .faq-question {
            padding: 20px 0;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            font-size: 18px;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            color: #a0a0a0;
            line-height: 1.6;
        }

        .faq-answer.open {
            max-height: 200px;
            padding-bottom: 20px;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .faq-icon.rotated {
            transform: rotate(180deg);
        }

        /* Testimonials Carousel */
        .testimonial-carousel {
            display: flex;
            transition: transform 0.5s ease;
        }

        .testimonial-card {
            min-width: 100%;
            padding: 0 20px;
        }

        /* ROI Calculator */
        .calculator-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 12px 16px;
            color: white;
            width: 100%;
            font-size: 16px;
        }

        .calculator-input:focus {
            outline: none;
            border-color: var(--glow-color);
            box-shadow: 0 0 0 3px rgba(103, 126, 234, 0.1);
        }

        /* Tech stack animation */
        .tech-logo {
            transition: all 0.3s ease;
            filter: grayscale(1);
        }

        .tech-logo:hover {
            filter: grayscale(0);
            transform: scale(1.1);
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.6s ease;
        }

        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.6s ease;
        }

        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .timeline::before {
                left: 20px;
            }
            
            .timeline-item::before {
                left: 20px;
            }
            
            .timeline-item {
                margin-left: 50px;
            }
            
            .floating-cta {
                bottom: 20px;
                right: 20px;
                padding: 12px 20px;
            }
        }

        /* Form validation styles */
        .form-group {
            margin-bottom: 24px;
        }

        .form-input.valid {
            border-color: #4ade80;
        }

        .form-input.invalid {
            border-color: #ef4444;
        }

        /* Form labels */
        .form-label {
            display: block;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 14px;
        }

        /* Enhanced form inputs */
        .form-input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            color: white;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--purple-accent);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            background: rgba(255, 255, 255, 0.12);
        }

        /* Select dropdown styling */
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
            appearance: none;
        }

        .form-select option {
            background: #1a1a2e;
            color: white;
        }

        /* Textarea styling */
        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-message {
            margin-top: 8px;
            font-size: 14px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .form-message.show {
            opacity: 1;
            transform: translateY(0);
        }

        .form-message.success {
            color: #4ade80;
        }

        .form-message.error {
            color: #ef4444;
        }

        /* Success animation */
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }

        .checkmark {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: checkmark 0.8s ease-in-out forwards;
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

        /* Calendly Modal Styles */
        .calendly-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 10000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .calendly-modal.active {
            display: flex;
            opacity: 1;
            align-items: center;
            justify-content: center;
        }

        .calendly-modal-content {
            background: white;
            border-radius: 20px;
            width: 90%;
            max-width: 900px;
            height: 80%;
            position: relative;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .calendly-modal.active .calendly-modal-content {
            transform: scale(1);
        }

        .calendly-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
            cursor: pointer;
            z-index: 10001;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .calendly-close:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: scale(1.1);
        }

        /* Exit Intent Popup Styles */
        .exit-intent-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--dark-gradient);
            border: 2px solid var(--purple-accent);
            border-radius: 20px;
            padding: 30px;
            z-index: 9999;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(139, 92, 246, 0.3);
        }

        .exit-intent-popup.show {
            display: block;
            animation: popupSlideIn 0.5s ease;
        }

        .exit-intent-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 9998;
        }

        .exit-intent-overlay.show {
            display: block;
        }

        @keyframes popupSlideIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            color: #aaa;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .popup-close:hover {
            color: white;
        }
        
        /* Accessibility Improvements - WCAG AA Compliance */
        
        /* Skip to content link */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--purple-primary);
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            z-index: 100000;
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }
        
        .skip-link:focus {
            transform: translateY(0%);
            top: 6px;
        }
        
        /* 8-Point Spacing Scale for Consistent Vertical Rhythm */
        .space-8 { margin: 8px; }
        .space-16 { margin: 16px; }
        .space-24 { margin: 24px; }
        .space-32 { margin: 32px; }
        .space-40 { margin: 40px; }
        .space-48 { margin: 48px; }
        .space-56 { margin: 56px; }
        .space-64 { margin: 64px; }
        .space-80 { margin: 80px; }
        .space-96 { margin: 96px; }
        
        .mt-8 { margin-top: 8px; }
        .mt-16 { margin-top: 16px; }
        .mt-24 { margin-top: 24px; }
        .mt-32 { margin-top: 32px; }
        .mt-48 { margin-top: 48px; }
        .mt-64 { margin-top: 64px; }
        .mt-80 { margin-top: 80px; }
        .mt-96 { margin-top: 96px; }
        
        .mb-8 { margin-bottom: 8px; }
        .mb-16 { margin-bottom: 16px; }
        .mb-24 { margin-bottom: 24px; }
        .mb-32 { margin-bottom: 32px; }
        .mb-48 { margin-bottom: 48px; }
        .mb-64 { margin-bottom: 64px; }
        .mb-80 { margin-bottom: 80px; }
        .mb-96 { margin-bottom: 96px; }
        
        .py-80 { padding-top: 80px; padding-bottom: 80px; }
        .py-96 { padding-top: 96px; padding-bottom: 96px; }
        .py-128 { padding-top: 128px; padding-bottom: 128px; }
        
        /* Enhanced focus ring styling for keyboard navigation */
        *:focus {
            outline: 3px solid var(--purple-accent);
            outline-offset: 2px;
        }
        
        /* Enhanced button focus states - WCAG AA compliant */
        .btn-primary:focus {
            outline: 3px solid var(--purple-light);
            outline-offset: 3px;
            box-shadow: 0 0 0 6px rgba(139, 92, 246, 0.2);
        }
        
        /* Button disabled state */
        .btn-primary:disabled {
            background: rgba(139, 92, 246, 0.3);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:disabled::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: loading-shimmer 1.5s infinite;
        }
        
        @keyframes loading-shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* Form input focus states */
        .form-input:focus,
        .calculator-input:focus {
            outline: 3px solid var(--purple-light);
            outline-offset: 3px;
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
        
        /* Urgency indicator */
        .urgency-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: #f59e0b;
            font-size: 12px;
            font-weight: 500;
            margin-top: 8px;
        }
        
        .urgency-indicator::before {
            content: '⚡';
            animation: flash 1.5s infinite;
        }
        
        @keyframes flash {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0.3; }
        }
        
        /* Accessible color contrast improvements */
        .text-gray-300 {
            color: #e5e7eb; /* Improved from #d1d5db to meet 4.5:1 contrast on dark background */
        }
        
        .text-gray-400 {
            color: #d1d5db; /* Improved from #9ca3af for better readability on dark background */
        }
        
        /* Screen reader only class */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }
        
        /* Services dropdown styling */
        .services-dropdown {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .services-dropdown a:hover {
            background: rgba(139, 92, 246, 0.1);
        }
        
        /* Error message styling for form validation */
        .error-message {
            color: #fecaca;
            font-size: 14px;
            margin-top: 4px;
            display: none;
        }
        
        .error-message.show {
            display: block;
        }
        
        /* Improved form focus indicators */
        .form-input:focus,
        .calculator-input:focus {
            border-color: var(--purple-accent);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.3);
            background: rgba(255, 255, 255, 0.15);
        }
        
        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .text-gray-300 {
                color: #ffffff;
            }
            
            .text-gray-400 {
                color: #ffffff;
            }
            
            .glass-card {
                border: 2px solid #ffffff;
                background: rgba(0, 0, 0, 0.8);
            }
        }
    </style>
    
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "LocalBusiness",
                "@id": "https://august.com.pk/#organization",
                "name": "augustAI",
                "alternateName": "August Solutions",
                "url": "https://august.com.pk/",
                "logo": "https://august.com.pk/assets/augustAI Logo Design on Purple Gradient.png",
                "description": "Leading AI automation company specializing in Python automations, business intelligence dashboards, and MVP development for SMEs and startups.",
                "founder": {
                    "@type": "Person",
                    "name": "Zain Nayab",
                    "jobTitle": "CEO & Founder",
                    "alumniOf": {
                        "@type": "Organization",
                        "name": "Stanford University"
                    },
                    "worksFor": {
                        "@type": "Organization",
                        "name": "McKinsey & Company"
                    }
                },
                "address": [
                    {
                        "@type": "PostalAddress",
                        "addressCountry": "PK",
                        "addressRegion": "Punjab",
                        "addressLocality": "Lahore"
                    },
                    {
                        "@type": "PostalAddress",
                        "addressCountry": "AE",
                        "addressRegion": "Dubai",
                        "addressLocality": "Dubai"
                    }
                ],
                "areaServed": [
                    {
                        "@type": "Country",
                        "name": "Pakistan"
                    },
                    {
                        "@type": "Country", 
                        "name": "United Arab Emirates"
                    },
                    {
                        "@type": "Country",
                        "name": "United States"
                    }
                ],
                "serviceArea": [
                    {
                        "@type": "GeoCircle",
                        "name": "Pakistan",
                        "geoMidpoint": {
                            "@type": "GeoCoordinates",
                            "latitude": "30.3753",
                            "longitude": "69.3451"
                        }
                    },
                    {
                        "@type": "GeoCircle", 
                        "name": "UAE",
                        "geoMidpoint": {
                            "@type": "GeoCoordinates",
                            "latitude": "23.4241",
                            "longitude": "53.8478"
                        }
                    }
                ],
                "contactPoint": {
                    "@type": "ContactPoint",
                    "contactType": "customer service",
                    "availableLanguage": ["English", "Urdu"],
                    "hoursAvailable": {
                        "@type": "OpeningHoursSpecification",
                        "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                        "opens": "09:00",
                        "closes": "18:00"
                    }
                },
                "sameAs": [
                    "https://linkedin.com/company/augustai",
                    "https://github.com/augustai"
                ]
            },
            {
                "@type": "Service",
                "@id": "https://august.com.pk/#automation-service", 
                "name": "AI Automation Sprint",
                "provider": {
                    "@id": "https://august.com.pk/#organization"
                },
                "description": "Custom Python automation workflows that eliminate manual tasks and save hours weekly. Fixed scope, 2-week delivery with 14-day warranty.",
                "serviceType": "AI Automation",
                "category": "Business Process Automation",
                "offers": {
                    "@type": "Offer",
                    "price": "1200",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock",
                    "deliveryLeadTime": "P14D",
                    "warranty": "P14D"
                },
                "areaServed": [
                    {
                        "@type": "Country",
                        "name": "Pakistan"
                    },
                    {
                        "@type": "Country",
                        "name": "United Arab Emirates"
                    }
                ]
            },
            {
                "@type": "Service",
                "@id": "https://august.com.pk/#dashboard-service",
                "name": "Dashboard in 10 Days", 
                "provider": {
                    "@id": "https://august.com.pk/#organization"
                },
                "description": "Interactive business intelligence dashboards with real-time data connections. Clean, decision-ready analytics delivered in 10 days.",
                "serviceType": "Business Intelligence Dashboard",
                "category": "Data Analytics",
                "offers": {
                    "@type": "Offer",
                    "price": "900",
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock",
                    "deliveryLeadTime": "P10D",
                    "warranty": "P14D"
                },
                "areaServed": [
                    {
                        "@type": "Country",
                        "name": "Pakistan"
                    },
                    {
                        "@type": "Country",
                        "name": "United Arab Emirates"
                    }
                ]
            },
            {
                "@type": "Service",
                "@id": "https://august.com.pk/#mvp-service",
                "name": "MVP-in-a-Month",
                "provider": {
                    "@id": "https://august.com.pk/#organization"
                },
                "description": "Complete web application or AI assistant MVP with core user flows, authentication, and production deployment in 30 days.",
                "serviceType": "MVP Development",
                "category": "Software Development",
                "offers": {
                    "@type": "Offer",
                    "price": "3000", 
                    "priceCurrency": "USD",
                    "availability": "https://schema.org/InStock",
                    "deliveryLeadTime": "P30D",
                    "warranty": "P14D"
                },
                "areaServed": [
                    {
                        "@type": "Country",
                        "name": "Pakistan"
                    },
                    {
                        "@type": "Country",
                        "name": "United Arab Emirates"
                    }
                ]
            },
            {
                "@type": "WebSite",
                "@id": "https://august.com.pk/#website",
                "url": "https://august.com.pk/",
                "name": "augustAI - AI Automation Solutions",
                "description": "Leading AI automation company in Pakistan & UAE specializing in Python automations, dashboards, and MVP development.",
                "publisher": {
                    "@id": "https://august.com.pk/#organization"
                },
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": "https://august.com.pk/?s={search_term_string}",
                    "query-input": "required name=search_term_string"
                }
            }
        ]
    }
    </script>
</head>
<body>
    <!-- Skip to content link for keyboard navigation -->
    <a href="#main" class="skip-link">Skip to main content</a>
    
    <!-- Progress Bar -->
    <div class="progress-bar" id="progressBar"></div>
    
    <!-- Background Particles -->
    <div id="particles-container"></div>
    
    <!-- Navigation -->
    <nav class="navbar" id="navbar" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <picture>
                        <source srcset="assets/augustAI Logo Design on Purple Gradient.webp" type="image/webp">
                        <img src="assets/augustAI Logo Design on Purple Gradient.png" alt="augustAI logo - AI automation and dashboard solutions for SMEs" class="h-12 md:h-16 object-contain" width="128" height="64" loading="eager">
                    </picture>
                </div>
                <div class="hidden md:flex space-x-8">
                    <div class="relative group">
                        <a href="#services" class="text-gray-300 hover:text-white transition-colors flex items-center">
                            Services
                            <i class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform"></i>
                        </a>
                        <!-- Services Dropdown -->
                        <div class="absolute top-full left-0 mt-2 w-64 bg-gray-900/95 backdrop-blur-lg border border-gray-700/50 rounded-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 z-50 services-dropdown">
                            <div class="p-2">
                                <a href="#llm" onclick="scrollToSection('llm')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                    <i class="fas fa-comments text-blue-400 w-5 mr-3"></i>
                                    <span>LLM & Chatbots</span>
                                </a>
                                <a href="#automation" onclick="scrollToSection('automation')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                    <i class="fas fa-robot text-purple-400 w-5 mr-3"></i>
                                    <span>Agentic Automation</span>
                                </a>
                                <a href="#dashboards" onclick="scrollToSection('dashboards')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                    <i class="fas fa-chart-bar text-green-400 w-5 mr-3"></i>
                                    <span>Data & Dashboards</span>
                                </a>
                                <a href="#mvp" onclick="scrollToSection('mvp')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                    <i class="fas fa-rocket text-orange-400 w-5 mr-3"></i>
                                    <span>MVP Build</span>
                                </a>
                                <a href="#consulting" onclick="scrollToSection('consulting')" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-lg transition-all">
                                    <i class="fas fa-lightbulb text-yellow-400 w-5 mr-3"></i>
                                    <span>Consulting & Training</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="#process" class="text-gray-300 hover:text-white transition-colors">Process</a>
                    <a href="#portfolio" class="text-gray-300 hover:text-white transition-colors">Portfolio</a>
                    <a href="#testimonials" class="text-gray-300 hover:text-white transition-colors">Testimonials</a>
                    <a href="#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
                    <a href="privacy.php" class="text-gray-300 hover:text-white transition-colors">Privacy</a>
                </div>
                <button onclick="openCalendlyModal()" class="btn-primary">Book 30-min Call</button>
            </div>
        </div>
    </nav>

    <!-- Main content area with landmark -->
    <main id="main" role="main">
    
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center px-4">
        <div class="max-w-7xl mx-auto text-center">
            <!-- Hero Logo -->
            <div class="mb-8 fade-in">
                <picture>
                    <source srcset="assets/augustAI Logo Design on Purple Gradient.webp" type="image/webp">
                    <img src="assets/augustAI Logo Design on Purple Gradient.png" alt="augustAI hero logo - Leading AI automation company building Python automations, dashboards and MVPs" class="mx-auto h-24 md:h-32 object-contain opacity-90 hover:opacity-100 transition-opacity" width="256" height="128" loading="eager">
                </picture>
            </div>
            
            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500/20 to-pink-500/20 rounded-full mb-8 glass">
                <span class="text-sm font-medium">🚀 Automate Everything • Dashboards • MVPs</span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                <span class="typewriter gradient-text">Automate Everything.</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
                We build Python/AI automations, 10-day dashboards, and MVPs-in-a-month for SMEs and startups. 
                <span class="gradient-text font-semibold">Automate Everything. Fixed scope. Fixed fee. Demos in week one.</span>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                <button onclick="openCalendlyModal()" class="btn-primary text-lg px-8 py-4">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Book 30-min Call
                </button>
                <button class="glass-card px-8 py-4 text-lg font-semibold hover:scale-105 transition-transform" onclick="scrollToSection('services')">
                    <i class="fas fa-eye mr-2"></i>
                    See packages
                </button>
            </div>
            
            <!-- Stats -->
            <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
                <div class="text-center fade-in">
                    <div class="counter" data-target="70">70</div>
                    <noscript><div class="text-2xl font-bold gradient-text">70+</div></noscript>
                    <p class="text-gray-400 text-lg">% fewer manual hours</p>
                </div>
                <div class="text-center fade-in">
                    <div class="counter" data-target="10">10</div>
                    <noscript><div class="text-2xl font-bold gradient-text">10</div></noscript>
                    <p class="text-gray-400 text-lg">days for dashboards</p>
                </div>
                <div class="text-center fade-in">
                    <div class="counter" data-target="30">30</div>
                    <noscript><div class="text-2xl font-bold gradient-text">30</div></noscript>
                    <p class="text-gray-400 text-lg">days for MVPs</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="py-20 px-4 bg-gradient-to-r from-gray-900/30 to-purple-900/10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 gradient-text">Why Choose augustAI</h2>
                <p class="text-lg text-gray-300">Proven expertise, transparent process, guaranteed results</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Proven Track Record -->
                <div class="text-center fade-in">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-r from-blue-400 to-cyan-400 flex items-center justify-center team-headshot">
                        <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">ZN</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Proven Track Record</h3>
                    <p class="text-gray-300 mb-4">Led by Zain Nayab, ex-McKinsey consultant with 8+ years in automation and AI. Delivered 50+ projects across fintech, healthcare, and e-commerce.</p>
                    <div class="flex justify-center items-center space-x-2 text-sm text-blue-400">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Ex-McKinsey • Stanford MBA</span>
                    </div>
                </div>
                
                <!-- Technical Excellence -->
                <div class="text-center fade-in">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center team-headshot">
                        <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">AH</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Technical Excellence</h3>
                    <p class="text-gray-300 mb-4">Ahmed Hassan, Senior AI Engineer with 6+ years at Google and Meta. Specialized in Python automation, ML pipelines, and scalable data solutions.</p>
                    <div class="flex justify-center items-center space-x-2 text-sm text-purple-400">
                        <i class="fas fa-code"></i>
                        <span>Ex-Google • AI/ML Expert</span>
                    </div>
                </div>
                
                <!-- Guaranteed Results -->
                <div class="text-center fade-in">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-r from-green-400 to-blue-400 flex items-center justify-center team-headshot">
                        <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white text-xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Guaranteed Results</h3>
                    <p class="text-gray-300 mb-4">Fixed scope, fixed price, and 14-day warranty on every project. We don't get paid until you're completely satisfied with the delivered solution.</p>
                    <div class="flex justify-center items-center space-x-2 text-sm text-green-400">
                        <i class="fas fa-check-circle"></i>
                        <span>100% Satisfaction Guaranteed</span>
                    </div>
                </div>
            </div>
            
            <!-- Trust Indicators -->
            <div class="mt-12 text-center fade-in">
                <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-certificate text-blue-400"></i>
                        <span class="text-sm">AWS Certified</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-lock text-purple-400"></i>
                        <span class="text-sm">SOC 2 Compliant</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-handshake text-green-400"></i>
                        <span class="text-sm">14-Day Warranty</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="text-sm">5.0/5 Client Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Debug: Services Count -->
            <?php if (isset($_GET['debug']) && $_GET['debug'] === 'services'): ?>
            <div style="background: #333; color: #fff; padding: 10px; margin-bottom: 20px; font-family: monospace;">
                <strong>DEBUG:</strong> Services loaded: <?php echo count($services); ?><br>
                Service IDs: <?php echo implode(', ', array_keys($services)); ?>
            </div>
            <?php endif; ?>
            
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">Our Services</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Choose from our carefully crafted packages designed to deliver maximum value in minimum time
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($services as $service_id => $service): ?>
                <!-- <?php echo ucfirst($service['name']); ?> -->
                <div id="<?php echo $service_id; ?>" class="glass-card p-8 hover:scale-105 transition-all duration-300 fade-in relative<?php echo isset($service['border_highlight']) && $service['border_highlight'] ? ' border-2 border-purple-500/50' : ''; ?>">
                    <?php if (isset($service['border_highlight']) && $service['border_highlight']): ?>
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <span class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-1 rounded-full text-sm font-medium"><?php echo $service['badge']; ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (isset($service['intro_pricing']) && $service['intro_pricing']): ?>
                    <!-- Intro pricing badge for services with early bird pricing -->
                    <div class="intro-pricing-badge">
                        <?php echo $service['intro_note']; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="w-16 h-16 bg-gradient-to-r <?php echo $service['gradient']; ?> rounded-xl flex items-center justify-center mb-6">
                        <i class="<?php echo $service['icon']; ?> text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4"><?php echo $service['name']; ?></h3>
                    <p class="text-gray-300 mb-6"><?php echo $service['tagline']; ?></p>
                    
                    <ul class="space-y-3 mb-8">
                        <?php foreach ($service['features'] as $feature): ?>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-400 mt-1 mr-3 flex-shrink-0"></i>
                            <span class="text-gray-300 text-sm"><?php echo $feature; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <div class="mb-6">
                        <?php if (isset($service['price_to'])): ?>
                            <div class="text-2xl font-bold gradient-text"><?php echo $service['intro_note']; ?>: $<?php echo number_format($service['price_from']); ?> – $<?php echo number_format($service['price_to']); ?></div>
                        <?php elseif (isset($service['price_workshop'])): ?>
                            <div class="text-xl font-bold gradient-text">Workshop: $<?php echo number_format($service['price_workshop']); ?> • DD: $<?php echo number_format($service['price_dd']); ?></div>
                        <?php else: ?>
                            <div class="text-2xl font-bold gradient-text">From $<?php echo number_format($service['price_from']); ?></div>
                        <?php endif; ?>
                        <p class="text-sm text-gray-400">
                            <?php if ($service['delivery_days'] < 30): ?>
                                ⚡ <?php echo $service['delivery_days']; ?> days delivery
                            <?php else: ?>
                                🚀 <?php echo $service['delivery_days']; ?> days delivery
                            <?php endif; ?>
                        </p>
                    </div>
                    
                    <button onclick="openCalendlyModal()" class="w-full btn-primary">
                        <?php echo isset($service['cta_text']) ? $service['cta_text'] : 'Book 30-min Call'; ?>
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Service Overview -->
            <div class="mt-16 text-center fade-in">
                <div class="bg-gray-800/30 rounded-xl p-8 border border-gray-700/30">
                    <h3 class="text-xl font-bold mb-6">Why Choose Our Fixed-Scope Approach?</h3>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <i class="fas fa-clock text-blue-400 text-2xl mb-3"></i>
                            <h4 class="font-semibold mb-2">Predictable Timeline</h4>
                            <p class="text-gray-400 text-sm">Fixed delivery dates, no scope creep</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-dollar-sign text-green-400 text-2xl mb-3"></i>
                            <h4 class="font-semibold mb-2">Fixed Investment</h4>
                            <p class="text-gray-400 text-sm">Know exactly what you'll pay upfront</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-shield-check text-purple-400 text-2xl mb-3"></i>
                            <h4 class="font-semibold mb-2">Guaranteed Results</h4>
                            <p class="text-gray-400 text-sm">14-day warranty on every project</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ROI Calculator -->
    <section class="py-20 px-4 bg-gradient-to-r from-purple-900/20 to-pink-900/20" role="complementary" aria-labelledby="roi-heading">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12 fade-in">
                <h2 id="roi-heading" class="text-4xl font-bold mb-6 gradient-text">ROI Calculator</h2>
                <p class="text-xl text-gray-300">See how much you could save with automation</p>
            </div>
            
            <div class="glass-card p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label for="manual-hours" class="block text-sm font-medium mb-2">Hours spent on manual tasks per week</label>
                            <input type="number" id="manual-hours" class="calculator-input" placeholder="40" value="40" min="1" max="168" aria-describedby="manual-hours-desc">
                            <div id="manual-hours-desc" class="sr-only">Enter the number of hours per week spent on manual tasks that could be automated</div>
                        </div>
                        <div>
                            <label for="hourly-rate" class="block text-sm font-medium mb-2">Average hourly rate ($)</label>
                            <input type="number" id="hourly-rate" class="calculator-input" placeholder="50" value="50" min="10" max="500" aria-describedby="hourly-rate-desc">
                            <div id="hourly-rate-desc" class="sr-only">Enter your average hourly rate in US dollars</div>
                        </div>
                        <div>
                            <label for="efficiency" class="block text-sm font-medium mb-2">Automation efficiency (%)</label>
                            <input type="range" id="efficiency" class="w-full" min="30" max="90" value="70" aria-describedby="efficiency-desc">
                            <div id="efficiency-desc" class="sr-only">Slider to set automation efficiency percentage between 30% and 90%</div>
                            <div class="flex justify-between text-sm text-gray-400 mt-2">
                                <span>30%</span>
                                <span id="efficiency-value" class="font-medium">70%</span>
                                <span>90%</span>
                            </div>
                        </div>
                        <div>
                            <label for="project-cost" class="block text-sm font-medium mb-2">Automation project cost ($)</label>
                            <select id="project-cost" class="calculator-input form-select" aria-describedby="project-cost-desc">
                                <?php foreach ($services as $service_id => $service): ?>
                                <option value="<?php echo $service['price_from']; ?>"><?php echo $service['name']; ?> - $<?php echo number_format($service['price_from']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="project-cost-desc" class="sr-only">Select the automation project package that best fits your needs</div>
                        </div>
                        <div>
                            <button id="compute-roi" class="btn-primary w-full" onclick="calculateROI()">
                                <span class="compute-text">
                                    <i class="fas fa-calculator mr-2"></i>
                                    Compute Savings
                                </span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="glass p-6 rounded-xl">
                        <h3 class="text-xl font-bold mb-4">Potential Savings</h3>
                        <div class="space-y-4" aria-live="polite" aria-label="ROI calculation results">
                            <div class="flex justify-between">
                                <span>Hours saved per week:</span>
                                <span id="hours-saved" class="font-bold text-blue-400">28 hrs</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Weekly savings:</span>
                                <span id="weekly-savings" class="font-bold gradient-text">$1,400</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Monthly savings:</span>
                                <span id="monthly-savings" class="font-bold gradient-text">$6,067</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Annual savings:</span>
                                <span id="annual-savings" class="font-bold gradient-text text-xl">$72,800</span>
                            </div>
                            <div class="pt-4 border-t border-gray-600">
                                <div class="flex justify-between">
                                    <span>Break-even time:</span>
                                    <span id="break-even" class="font-bold text-green-400">5 days</span>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <span>ROI after 1 month:</span>
                                    <span id="roi-percentage" class="font-bold text-green-400">405%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                            </div>
                            <div class="flex justify-between">
                                <span>Weekly savings:</span>
                                <span id="weekly-savings" class="font-bold gradient-text">$1,400</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Monthly savings:</span>
                                <span id="monthly-savings" class="font-bold gradient-text">$6,067</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Annual savings:</span>
                                <span id="annual-savings" class="font-bold gradient-text text-xl">$72,800</span>
                            </div>
                            <div class="pt-16 border-t border-gray-600">
                                <div class="flex justify-between">
                                    <span>Break-even time:</span>
                                    <span id="break-even" class="font-bold text-yellow-400">2.4 weeks</span>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <span>ROI in first month:</span>
                                    <span id="roi-percentage" class="font-bold text-green-400 text-xl">506%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-64 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-24 gradient-text">Our Process</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    A proven 4-step methodology that delivers results quickly and reliably
                </p>
            </div>
            
            <div class="timeline">
                <div class="timeline-item">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 md:pr-8 mb-8 md:mb-0">
                            <div class="glass-card p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-search text-white"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold">1. Discover</h3>
                                </div>
                                <p class="text-gray-300 mb-4">Free consultation call to understand your challenges and define the one outcome that matters most.</p>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li>• Problem identification</li>
                                    <li>• Success criteria definition</li>
                                    <li>• Technical feasibility assessment</li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:w-1/2 md:pl-8">
                            <div class="text-4xl text-gray-600">📋</div>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="flex flex-col md:flex-row-reverse items-center">
                        <div class="md:w-1/2 md:pl-8 mb-8 md:mb-0">
                            <div class="glass-card p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-drafting-compass text-white"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold">2. Plan</h3>
                                </div>
                                <p class="text-gray-300 mb-4">1-page plan delivered in 24–48h with clear acceptance criteria and timeline.</p>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li>• Detailed project scope</li>
                                    <li>• Technical architecture</li>
                                    <li>• Clear deliverables & timeline</li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:w-1/2 md:pr-8">
                            <div class="text-4xl text-gray-600">🎯</div>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 md:pr-8 mb-8 md:mb-0">
                            <div class="glass-card p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-400 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-code text-white"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold">3. Build</h3>
                                </div>
                                <p class="text-gray-300 mb-4">Weekly demos starting from week one. No surprises, full transparency.</p>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li>• Agile development approach</li>
                                    <li>• Weekly progress demonstrations</li>
                                    <li>• Continuous feedback integration</li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:w-1/2 md:pl-8">
                            <div class="text-4xl text-gray-600">⚡</div>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="flex flex-col md:flex-row-reverse items-center">
                        <div class="md:w-1/2 md:pl-8 mb-8 md:mb-0">
                            <div class="glass-card p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-rocket text-white"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold">4. Deploy</h3>
                                </div>
                                <p class="text-gray-300 mb-4">Complete handover with training materials and 14-day warranty support.</p>
                                <ul class="text-sm text-gray-400 space-y-2">
                                    <li>• Production deployment</li>
                                    <li>• Comprehensive documentation</li>
                                    <li>• 14-day warranty & support</li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:w-1/2 md:pr-8">
                            <div class="text-4xl text-gray-600">🎉</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack -->
    <section class="py-20 px-4 bg-gradient-to-r from-gray-900/50 to-blue-900/20">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-64 fade-in">
                <h2 class="text-4xl font-bold mb-24 gradient-text">Technology Stack</h2>
                <p class="text-xl text-gray-300">We use cutting-edge technologies to deliver world-class solutions</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                <div class="tech-logo glass-card p-6 text-center hover:scale-110 transition-all">
                    <i class="fab fa-python text-4xl text-yellow-400 mb-3"></i>
                    <p class="text-sm">Python</p>
                </div>
                <div class="tech-logo glass-card p-6 text-center hover:scale-110 transition-all">
                    <i class="fab fa-react text-4xl text-blue-400 mb-3"></i>
                    <p class="text-sm">React</p>
                </div>
                <div class="tech-logo glass-card p-6 text-center hover:scale-110 transition-all">
                    <i class="fab fa-node-js text-4xl text-green-400 mb-3"></i>
                    <p class="text-sm">Node.js</p>
                </div>
                <div class="tech-logo glass-card p-6 text-center hover:scale-110 transition-all">
                    <i class="fab fa-aws text-4xl text-orange-400 mb-3"></i>
                    <p class="text-sm">AWS</p>
                </div>
                <div class="tech-logo glass-card p-6 text-center hover:scale-110 transition-all">
                    <i class="fab fa-docker text-4xl text-blue-500 mb-3"></i>
                    <p class="text-sm">Docker</p>
                </div>
                <div class="tech-logo glass-card p-6 text-center hover:scale-110 transition-all">
                    <i class="fas fa-database text-4xl text-purple-400 mb-3"></i>
                    <p class="text-sm">PostgreSQL</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio -->
    <section id="portfolio" class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-64 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-24 gradient-text">Success Stories</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Real results from real clients who trusted us with their automation and development needs
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="glass-card p-6 hover:scale-105 transition-all fade-in">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">E-commerce Analytics</h3>
                            <p class="text-sm text-gray-400">SaaS Dashboard</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">Automated reporting dashboard that reduced manual analysis time from 8 hours to 15 minutes weekly.</p>
                    <div class="flex justify-between text-sm">
                        <span class="text-green-400">↑ 95% time saved</span>
                        <span class="text-blue-400">10 days delivery</span>
                    </div>
                </div>
                
                <div class="glass-card p-6 hover:scale-105 transition-all fade-in">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 bg-gradient-to-r from-purple-400 to-pink-400">
                            <img src="assets/augustai_logo_only.png" alt="augustAI brand icon for lead qualification AI automation project" class="w-8 h-8 object-contain" loading="lazy" width="32" height="32">
                        </div>
                        <div>
                            <h3 class="font-bold">Lead Qualification Bot</h3>
                            <p class="text-sm text-gray-400">AI Automation</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">AI-powered lead scoring system that increased qualified leads by 150% and reduced manual screening by 80%.</p>
                    <div class="flex justify-between text-sm">
                        <span class="text-green-400">↑ 150% qualified leads</span>
                        <span class="text-blue-400">2 weeks delivery</span>
                    </div>
                </div>
                
                <div class="glass-card p-6 hover:scale-105 transition-all fade-in">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-400 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-mobile-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">Inventory Management</h3>
                            <p class="text-sm text-gray-400">Web Application</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">Custom inventory tracking system that reduced stock-outs by 70% and improved order accuracy to 99.8%.</p>
                    <div class="flex justify-between text-sm">
                        <span class="text-green-400">↓ 70% stock-outs</span>
                        <span class="text-blue-400">30 days delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 px-4 bg-gradient-to-r from-purple-900/20 to-pink-900/20">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-64 fade-in">
                <h2 class="text-4xl font-bold mb-24 gradient-text">What Our Clients Say</h2>
                <p class="text-xl text-gray-300">Don't just take our word for it</p>
            </div>
            
            <div class="relative">
                <div class="testimonial-carousel" id="testimonialCarousel">
                    <div class="testimonial-card">
                        <div class="glass-card p-8 text-center">
                            <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-gradient-to-r from-blue-400 to-cyan-400 flex items-center justify-center">
                                <span class="text-white font-bold text-xl">SC</span>
                            </div>
                            <p class="text-lg mb-6 italic">"augustAI delivered exactly what they promised. The automation saved us 25 hours per week and paid for itself in the first month. Exceptional work!"</p>
                            <h4 class="font-bold text-xl mb-2">Sarah Chen</h4>
                            <p class="text-gray-400">CEO, TechFlow Solutions</p>
                        </div>
                    </div>
                    
                    <div class="testimonial-card">
                        <div class="glass-card p-8 text-center">
                            <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center">
                                <span class="text-white font-bold text-xl">MR</span>
                            </div>
                            <p class="text-lg mb-6 italic">"The dashboard they built transformed how we make decisions. Real-time insights that used to take days to compile are now available instantly."</p>
                            <h4 class="font-bold text-xl mb-2">Michael Rodriguez</h4>
                            <p class="text-gray-400">COO, DataFirst Analytics</p>
                        </div>
                    </div>
                    
                    <div class="testimonial-card">
                        <div class="glass-card p-8 text-center">
                            <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-gradient-to-r from-green-400 to-blue-400 flex items-center justify-center">
                                <span class="text-white font-bold text-xl">AK</span>
                            </div>
                            <p class="text-lg mb-6 italic">"Professional, fast, and delivered exactly as promised. The MVP they built helped us secure our Series A funding. Highly recommended!"</p>
                            <h4 class="font-bold text-xl mb-2">Aisha Kumar</h4>
                            <p class="text-gray-400">Founder, InnovateLab</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-center mt-8 space-x-3">
                    <button class="testimonial-dot w-3 h-3 rounded-full bg-purple-500" onclick="showTestimonial(0)"></button>
                    <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-500" onclick="showTestimonial(1)"></button>
                    <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-500" onclick="showTestimonial(2)"></button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-64 fade-in">
                <h2 class="text-4xl font-bold mb-24 gradient-text">Frequently Asked Questions</h2>
                <p class="text-xl text-gray-300">Everything you need to know about working with us</p>
            </div>
            
            <div class="space-y-16">
                <div class="faq-item glass-card p-6">
                    <div class="faq-question" onclick="toggleFAQ(0)">
                        <span>Can you work with UAE companies while based in Dubai?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        Yes, absolutely. We invoice through our Pakistan entity and activate UAE licensing only when required by specific client or vendor policies. We serve clients across UAE, GCC, and globally with full compliance.
                    </div>
                </div>
                
                <div class="faq-item glass-card p-6">
                    <div class="faq-question" onclick="toggleFAQ(1)">
                        <span>How do you keep our data secure?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        We implement least-privilege access controls, separate development/production environments, comprehensive secrets management, and provide NDAs upon request. All data is encrypted in transit and at rest.
                    </div>
                </div>
                
                <div class="faq-item glass-card p-6">
                    <div class="faq-question" onclick="toggleFAQ(2)">
                        <span>What's your pricing model?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        We use fixed scope and fixed fee pricing for speed and predictability. No hourly billing or scope creep. We're currently offering intro pricing for our first 5 clients with ongoing discounts for repeat customers.
                    </div>
                </div>
                
                <div class="faq-item glass-card p-6">
                    <div class="faq-question" onclick="toggleFAQ(3)">
                        <span>What if we're not satisfied with the results?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        Every project comes with a 14-day warranty. If the delivered solution doesn't meet the agreed acceptance criteria, we'll fix it at no additional cost. We also provide clear milestone demos to ensure alignment throughout the project.
                    </div>
                </div>
                
                <div class="faq-item glass-card p-6">
                    <div class="faq-question" onclick="toggleFAQ(4)">
                        <span>Do you provide ongoing maintenance and support?</span>
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </div>
                    <div class="faq-answer">
                        Yes, we offer ongoing maintenance packages starting at $500/month. This includes bug fixes, minor enhancements, monitoring, and technical support. We can also provide training for your team to manage the solution internally.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-4 bg-gradient-to-r from-gray-900/50 to-purple-900/20">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-64 fade-in">
                <h2 class="text-4xl md:text-5xl font-bold mb-24 gradient-text">Let's Build Something Amazing</h2>
                <p class="text-xl text-gray-300">Ready to automate your workflows and accelerate your business?</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div class="fade-in">
                    <h3 class="text-2xl font-bold mb-6">Get in touch</h3>
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium">Email</p>
                                <a href="<?php echo $contact_config['email_url']; ?>" class="text-blue-400 hover:text-blue-300"><?php echo $contact_config['business_email']; ?></a>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-teal-400 rounded-lg flex items-center justify-center mr-4">
                                <i class="fab fa-whatsapp text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium">WhatsApp</p>
                                <a href="<?php echo $contact_config['whatsapp_url']; ?>" target="_blank" class="text-green-400 hover:text-green-300">Message us on WhatsApp</a>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-400 to-red-400 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium">Call Now</p>
                                <a href="<?php echo $contact_config['phone_url']; ?>" class="text-orange-400 hover:text-orange-300">Call us directly</a>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-calendar text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium">Book a call</p>
                                <button onclick="openCalendlyModal()" class="text-purple-400 hover:text-purple-300 transition-colors border-none bg-none cursor-pointer">Schedule 30-min consultation</button>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-400 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-globe text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium">Location</p>
                                <p class="text-gray-400">Registered in Pakistan • Serving UAE, GCC & global clients</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="fade-in">
                    <form class="glass-card p-8" id="contactForm">
                        <h3 class="text-2xl font-bold mb-6 gradient-text">Get Your Free Consultation</h3>
                        
                        <!-- Anti-spam honeypot field (hidden from users) -->
                        <div style="position: absolute; left: -9999px; visibility: hidden;">
                            <label for="website">Website (leave blank):</label>
                            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="Enter your full name" required aria-describedby="name-desc" aria-invalid="false" maxlength="100">
                            <div id="name-desc" class="sr-only">Required field: Enter your full name for contact purposes</div>
                            <div class="form-message error-message" id="name-message" role="alert"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="your@email.com" required aria-describedby="email-desc" aria-invalid="false" maxlength="254">
                            <div id="email-desc" class="sr-only">Required field: Enter a valid email address for communication</div>
                            <div class="form-message error-message" id="email-message" role="alert"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="company" class="form-label">Company / Organization</label>
                            <input type="text" id="company" name="company" class="form-input" placeholder="Your company name" aria-describedby="company-desc" maxlength="100">
                            <div id="company-desc" class="sr-only">Optional field: Enter your company or organization name</div>
                            <div class="form-message error-message" id="company-message" role="alert"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="service" class="form-label">Service Interest *</label>
                            <select id="service" name="service" class="form-input form-select" required aria-describedby="service-desc" aria-invalid="false">
                                <option value="">Choose a service</option>
                                <option value="automation">Automation Sprint</option>
                                <option value="dashboard">Dashboard in 10 Days</option>
                                <option value="mvp">MVP-in-a-Month</option>
                                <option value="consultation">Free Consultation</option>
                            </select>
                            <div id="service-desc" class="sr-only">Required field: Select the service you are interested in</div>
                            <div class="form-message error-message" id="service-message" role="alert"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message" class="form-label">Project Details *</label>
                            <textarea id="message" name="message" class="form-input form-textarea" rows="4" placeholder="Tell us about your project, goals, and how we can help..." required aria-describedby="message-desc" aria-invalid="false" maxlength="2000"></textarea>
                            <div id="message-desc" class="sr-only">Required field: Provide details about your project, goals, and how we can help you</div>
                            <div class="form-message error-message" id="message-message" role="alert"></div>
                        </div>
                        
                        <!-- reCAPTCHA v3 token will be added automatically -->
                        <input type="hidden" id="recaptcha-token" name="recaptcha_token">
                        
                        <button type="submit" class="btn-primary w-full" id="submitBtn">
                            <span id="submitText">Book 30-min Call</span>
                            <i class="fas fa-calendar-check ml-2"></i>
                        </button>
                        
                        <div class="text-xs text-gray-400 mt-3 text-center">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Protected by reCAPTCHA and Google <a href="https://policies.google.com/privacy" target="_blank" class="text-blue-400 hover:text-blue-300">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank" class="text-blue-400 hover:text-blue-300">Terms of Service</a> apply.
                        </div>
                        
                        <div id="form-success" class="mt-4 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400 text-center" style="display: none;">
                            <i class="fas fa-check-circle mr-2"></i>
                            Thank you! We'll get back to you within 24 hours.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    </main>
    <!-- End of main content -->

    <!-- Footer -->
    <footer class="py-12 px-4 border-t border-gray-800" role="contentinfo">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center">
                        <img src="assets/augustai_logo_only.png" alt="augustAI company logo - AI automation specialists in Pakistan and UAE" class="w-10 h-10 object-contain" loading="lazy" width="40" height="40">
                    </div>
                    <span class="text-xl font-bold gradient-text">augustAI</span>
                </div>
                
                <div class="text-center md:text-right">
                    <div class="flex justify-center md:justify-end space-x-6 mb-2 text-sm">
                        <a href="privacy.php" class="text-gray-400 hover:text-purple-400 transition-colors">Privacy Policy</a>
                        <a href="#contact" class="text-gray-400 hover:text-purple-400 transition-colors">Contact</a>
                        <a href="#services" class="text-gray-400 hover:text-purple-400 transition-colors">Services</a>
                    </div>
                    <p class="text-gray-400">© <span id="current-year"></span> augustAI. All rights reserved.</p>
                    <p class="text-sm text-gray-500 mt-1">Automate Everything</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating CTA -->
    <button onclick="openCalendlyModal()" class="floating-cta" id="floatingCTA">
        <i class="fas fa-phone mr-2"></i>
        <span>Book 30-min Call</span>
    </button>

    <!-- Calendly Modal -->
    <div id="calendlyModal" class="calendly-modal">
        <div class="calendly-modal-content">
            <button class="calendly-close" onclick="closeCalendlyModal()">
                <i class="fas fa-times"></i>
            </button>
            <div id="calendly-inline-widget" style="width: 100%; height: 100%;"></div>
        </div>
    </div>

    <!-- Exit Intent Popup -->
    <div id="exitIntentOverlay" class="exit-intent-overlay" onclick="closeExitIntentPopup()"></div>
    <div id="exitIntentPopup" class="exit-intent-popup">
        <button class="popup-close" onclick="closeExitIntentPopup()">&times;</button>
        <div class="text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4 gradient-text">Wait! Don't Miss Out</h3>
            <p class="text-gray-300 mb-6">Book a free 30-minute consultation and discover how we can automate your workflows and save you hours every week.</p>
            <div class="space-y-4">
                <button onclick="openCalendlyModal(); closeExitIntentPopup();" class="btn-primary w-full">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Book 30-min Call Now
                </button>
                <button onclick="closeExitIntentPopup()" class="w-full text-gray-400 hover:text-white transition-colors bg-transparent border-none">
                    Maybe later
                </button>
            </div>
        </div>
    </div>

    <script>
        // Contact configuration from environment variables
        const contactConfig = <?php echo $contact_config_json; ?>;
        
        // Calendly Modal Functions
        function openCalendlyModal() {
            // Load Calendly script if not already loaded
            loadCalendly();
            
            const modal = document.getElementById('calendlyModal');
            const widget = document.getElementById('calendly-inline-widget');
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Wait for Calendly to load then initialize widget
            const initWidget = () => {
                if (window.Calendly && !widget.hasChildNodes()) {
                    Calendly.initInlineWidget({
                        url: contactConfig.calendly_url,
                        parentElement: widget,
                        prefill: {},
                        utm: {}
                    });
                } else if (!window.Calendly) {
                    // Wait for Calendly to load
                    setTimeout(initWidget, 100);
                }
            };
            
            initWidget();
        }

        function closeCalendlyModal() {
            const modal = document.getElementById('calendlyModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Exit Intent Popup Functions
        let hasShownExitIntent = false;
        let visitCount = parseInt(localStorage.getItem('augustai_visit_count') || '0');
        
        function showExitIntentPopup() {
            if (hasShownExitIntent || visitCount < 2) return;
            
            document.getElementById('exitIntentOverlay').classList.add('show');
            document.getElementById('exitIntentPopup').classList.add('show');
            hasShownExitIntent = true;
        }

        function closeExitIntentPopup() {
            document.getElementById('exitIntentOverlay').classList.remove('show');
            document.getElementById('exitIntentPopup').classList.remove('show');
        }

        // Track visit count
        visitCount++;
        localStorage.setItem('augustai_visit_count', visitCount.toString());

        // Exit intent detection
        document.addEventListener('mouseleave', function(e) {
            if (e.clientY <= 0) {
                showExitIntentPopup();
            }
        });

        // Close modal when clicking outside
        document.getElementById('calendlyModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCalendlyModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCalendlyModal();
                closeExitIntentPopup();
            }
        });
        
        // Initialize particles (deferred for better FID)
        function createParticles() {
            const container = document.getElementById('particles-container');
            const particleCount = 100; // Increased from 50 to 100 for more stars
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size for variety (small, medium, large stars)
                const size = Math.random() < 0.7 ? 2 : Math.random() < 0.9 ? 3 : 4;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                
                // Random opacity for twinkling effect
                particle.style.opacity = Math.random() * 0.8 + 0.2;
                
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 6) + 's';
                container.appendChild(particle);
            }
        }

        // Defer particle creation for better LCP
        function initParticles() {
            if (window.requestIdleCallback) {
                requestIdleCallback(createParticles);
            } else {
                setTimeout(createParticles, 2000);
            }
        }

        // Scroll progress indicator
        function updateProgressBar() {
            const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
            document.getElementById('progressBar').style.width = scrolled + '%';
        }

        // Navbar scroll effect
        function updateNavbar() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        // Floating CTA visibility
        function updateFloatingCTA() {
            const cta = document.getElementById('floatingCTA');
            if (window.scrollY > 500) {
                cta.classList.add('visible');
            } else {
                cta.classList.remove('visible');
            }
        }

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                let current = 0;
                const increment = target / 100;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        setTimeout(updateCounter, 20);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    
                    // Trigger counter animation for stats section
                    if (entry.target.querySelector('.counter')) {
                        animateCounters();
                    }
                }
            });
        }, observerOptions);

        // Observe all animation elements
        document.addEventListener('DOMContentLoaded', () => {
            // Critical initializations first
            const animatedElements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .timeline-item');
            animatedElements.forEach(el => observer.observe(el));
            
            // Initialize current year
            const currentYear = new Date().getFullYear();
            const yearElement = document.getElementById('current-year');
            if (yearElement) {
                yearElement.textContent = currentYear;
            }
            
            // Initialize ROI calculator
            updateROICalculator();
            
            // Add event listeners for ROI calculator
            ['manual-hours', 'hourly-rate', 'efficiency', 'project-cost'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', updateROICalculator);
                }
            });
            
            // Defer non-critical initializations
            setTimeout(() => {
                initParticles();
                
                // Add scroll listeners
                window.addEventListener('scroll', () => {
                    updateProgressBar();
                    updateNavbar();
                    updateFloatingCTA();
                });
                
                // Register service worker for PWA
                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.register('/sw.js')
                        .then((registration) => {
                            console.log('SW registered:', registration);
                        })
                        .catch((error) => {
                            console.log('SW registration failed:', error);
                        });
                }
            }, 100);
        });

        // ROI Calculator - CLIENT-ONLY (no server persistence for PII protection)
        function updateROICalculator() {
            // Get input values (client-side only - no server storage for privacy)
            const manualHours = parseFloat(document.getElementById('manual-hours').value) || 0;
            const hourlyRate = parseFloat(document.getElementById('hourly-rate').value) || 0;
            const efficiency = parseFloat(document.getElementById('efficiency').value) || 0;
            const projectCost = parseFloat(document.getElementById('project-cost').value) || 1200;
            
            // Calculate savings (all calculations client-side)
            const hoursSaved = manualHours * (efficiency / 100);
            const weeklySavings = hoursSaved * hourlyRate;
            const monthlySavings = weeklySavings * 4.33; // Average weeks per month
            const annualSavings = weeklySavings * 52;
            
            // Calculate ROI
            const firstMonthSavings = monthlySavings;
            const roiPercentage = projectCost > 0 ? ((firstMonthSavings - projectCost) / projectCost) * 100 : 0;
            const breakEvenWeeks = weeklySavings > 0 ? projectCost / weeklySavings : 0;
            
            // Update display elements (no data sent to server)
            document.getElementById('hours-saved').textContent = hoursSaved.toFixed(1) + ' hrs';
            document.getElementById('weekly-savings').textContent = '$' + Math.round(weeklySavings).toLocaleString();
            document.getElementById('monthly-savings').textContent = '$' + Math.round(monthlySavings).toLocaleString();
            document.getElementById('annual-savings').textContent = '$' + Math.round(annualSavings).toLocaleString();
            
            // Update efficiency display
            document.getElementById('efficiency-value').textContent = efficiency + '%';
        }
        
        // Enhanced calculate ROI function with button states
        function calculateROI() {
            const button = document.getElementById('compute-roi');
            const buttonText = button.querySelector('.compute-text');
            
            // Disable button and show loading state
            button.disabled = true;
            buttonText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Computing...';
            
            // Simulate calculation delay for UX
            setTimeout(() => {
                updateROICalculator();
                
                // Re-enable button
                button.disabled = false;
                buttonText.innerHTML = '<i class="fas fa-calculator mr-2"></i>Compute Savings';
                
                // Add success feedback
                button.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
                buttonText.innerHTML = '<i class="fas fa-check mr-2"></i>Calculated!';
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    button.style.background = '';
                    buttonText.innerHTML = '<i class="fas fa-calculator mr-2"></i>Compute Savings';
                }, 2000);
                
            }, 800); // Simulate processing time
        }
            document.getElementById('efficiency-value').textContent = efficiency + '%';
            
            // Break-even time
            if (breakEvenWeeks < 1) {
                document.getElementById('break-even').textContent = Math.round(breakEvenWeeks * 7) + ' days';
            } else if (breakEvenWeeks < 4.33) {
                document.getElementById('break-even').textContent = breakEvenWeeks.toFixed(1) + ' weeks';
            } else {
                document.getElementById('break-even').textContent = (breakEvenWeeks / 4.33).toFixed(1) + ' months';
            }
            
            // ROI percentage
            if (roiPercentage >= 0) {
                document.getElementById('roi-percentage').textContent = Math.round(roiPercentage) + '%';
                document.getElementById('roi-percentage').className = 'font-bold text-green-400 text-xl';
            } else {
                document.getElementById('roi-percentage').textContent = Math.round(Math.abs(roiPercentage)) + '% loss';
                document.getElementById('roi-percentage').className = 'font-bold text-red-400 text-xl';
            }
            
            // Note: ROI calculator data is NEVER sent to server - client-only for privacy
        }

        // FAQ functionality
        function toggleFAQ(index) {
            const faqItems = document.querySelectorAll('.faq-item');
            const currentItem = faqItems[index];
            const answer = currentItem.querySelector('.faq-answer');
            const icon = currentItem.querySelector('.faq-icon');
            
            // Close all other FAQs
            faqItems.forEach((item, i) => {
                if (i !== index) {
                    item.querySelector('.faq-answer').classList.remove('open');
                    item.querySelector('.faq-icon').classList.remove('rotated');
                }
            });
            
            // Toggle current FAQ
            answer.classList.toggle('open');
            icon.classList.toggle('rotated');
        }

        // Testimonial carousel
        let currentTestimonial = 0;
        
        function showTestimonial(index) {
            const carousel = document.getElementById('testimonialCarousel');
            const dots = document.querySelectorAll('.testimonial-dot');
            
            currentTestimonial = index;
            carousel.style.transform = `translateX(-${index * 100}%)`;
            
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-gray-500');
                    dot.classList.add('bg-purple-500');
                } else {
                    dot.classList.remove('bg-purple-500');
                    dot.classList.add('bg-gray-500');
                }
            });
        }

        // Auto-rotate testimonials
        setInterval(() => {
            currentTestimonial = (currentTestimonial + 1) % 3;
            showTestimonial(currentTestimonial);
        }, 5000);

        // Form validation
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function showFormMessage(fieldId, message, isError = false) {
            const messageEl = document.getElementById(fieldId + '-message');
            const inputEl = document.getElementById(fieldId);
            
            messageEl.textContent = message;
            messageEl.className = `form-message show ${isError ? 'error' : 'success'}`;
            inputEl.className = `form-input ${isError ? 'invalid' : 'valid'}`;
        }

        function validateForm() {
            let isValid = true;
            
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const service = document.getElementById('service').value;
            const message = document.getElementById('message').value.trim();
            
            if (!name) {
                showFormMessage('name', 'Name is required', true);
                isValid = false;
            } else {
                showFormMessage('name', 'Looks good!');
            }
            
            if (!email) {
                showFormMessage('email', 'Email is required', true);
                isValid = false;
            } else if (!validateEmail(email)) {
                showFormMessage('email', 'Please enter a valid email', true);
                isValid = false;
            } else {
                showFormMessage('email', 'Valid email address');
            }
            
            if (!service) {
                showFormMessage('service', 'Please select a service', true);
                isValid = false;
            } else {
                showFormMessage('service', 'Service selected');
            }
            
            if (!message) {
                showFormMessage('message', 'Message is required', true);
                isValid = false;
            } else {
                showFormMessage('message', 'Thank you for the details');
            }
            
            return isValid;
        }

        // Smooth scrolling functions
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        function scrollToContact() {
            document.getElementById('contact').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            
            // Set current year
            document.getElementById('current-year').textContent = new Date().getFullYear();
            
            // ROI Calculator event listeners
            ['manual-hours', 'hourly-rate', 'efficiency', 'project-cost'].forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('input', updateROICalculator);
                    element.addEventListener('change', updateROICalculator);
                }
            });
            
            // Efficiency slider real-time update
            const efficiencySlider = document.getElementById('efficiency');
            if (efficiencySlider) {
                efficiencySlider.addEventListener('input', function() {
                    document.getElementById('efficiency-value').textContent = this.value + '%';
                    updateROICalculator();
                });
            }
            
            // Initial ROI calculation
            updateROICalculator();
            
            // Form submission with reCAPTCHA protection
            document.getElementById('contactForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                
                // Check for spam (honeypot field)
                const honeypot = document.getElementById('website').value;
                if (honeypot) {
                    console.log('Spam detected via honeypot field');
                    return; // Silent rejection for spam
                }
                
                if (validateForm()) {
                    const submitBtn = document.getElementById('submitBtn');
                    const submitText = document.getElementById('submitText');
                    const successMsg = document.getElementById('form-success');
                    
                    // Show loading state
                    submitBtn.disabled = true;
                    submitText.textContent = 'Verifying...';
                    
                    try {
                        // Execute reCAPTCHA v3
                        const recaptchaToken = await executeRecaptcha('contact_form');
                        if (recaptchaToken) {
                            document.getElementById('recaptcha-token').value = recaptchaToken;
                        }
                        
                        submitText.textContent = 'Sending...';
                        
                        // Collect form data with security measures
                        const formData = new FormData();
                        formData.append('name', document.getElementById('name').value.trim());
                        formData.append('email', document.getElementById('email').value.trim());
                        formData.append('company', document.getElementById('company').value.trim());
                        formData.append('service', document.getElementById('service').value);
                        formData.append('message', document.getElementById('message').value.trim());
                        formData.append('recaptcha_token', recaptchaToken || '');
                        formData.append('timestamp', Date.now()); // Anti-replay
                        
                        // Submit form with anti-spam protection
                        let response;
                        let handlerUsed = '';
                        
                        try {
                            // Try simple handler first (should have reCAPTCHA verification)
                            response = await fetch('simple-contact-handler.php', {
                                method: 'POST',
                                body: formData
                            });
                            handlerUsed = 'simple';
                        } catch (simpleError) {
                            console.log('Simple handler failed, trying SMTP handler:', simpleError);
                            
                            try {
                                // Try SMTP handler second
                                response = await fetch('smtp-contact-handler.php', {
                                    method: 'POST',
                                    body: formData
                                });
                                handlerUsed = 'smtp';
                            } catch (smtpError) {
                                console.log('SMTP handler failed, trying original:', smtpError);
                                // Fallback to original handler
                                response = await fetch('contact-handler.php', {
                                    method: 'POST',
                                    body: formData
                                });
                                handlerUsed = 'original';
                            }
                        }
                        
                        console.log('Using handler:', handlerUsed, 'Response status:', response.status);
                        
                        let result;
                        
                        // Try to parse JSON response
                        try {
                            result = await response.json();
                        } catch (jsonError) {
                            // If JSON parsing fails, treat as success if status is OK
                            if (response.ok) {
                                result = { success: true, message: 'Message sent successfully!' };
                            } else {
                                throw new Error('Server error: ' + response.status);
                            }
                        }
                        
                        // Check if successful
                        if (response.ok && (result.success === true || result.success === 'true' || response.status === 200)) {
                            // Show success message
                            successMsg.style.display = 'block';
                            successMsg.className = 'mt-4 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400 text-center';
                            successMsg.innerHTML = '<i class="fas fa-check-circle mr-2"></i>' + (result.message || result.data || 'Thank you! Your message was sent. Let\'s schedule your call now!');
                            
                            // Auto-open Calendly modal after form submission
                            setTimeout(() => {
                                openCalendlyModal();
                            }, 1500);
                            
                            // Reset form
                            document.getElementById('contactForm').reset();
                            
                            // Reset form states
                            document.querySelectorAll('.form-input').forEach(input => {
                                input.className = 'form-input';
                            });
                            document.querySelectorAll('.form-message').forEach(msg => {
                                msg.className = 'form-message';
                            });
                            
                        } else {
                            // Show error message with contact alternatives
                            successMsg.style.display = 'block';
                            successMsg.className = 'mt-4 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400 text-center';
                            successMsg.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>' + (result.message || result.data || 'Something went wrong. Please try again.') + 
                                '<br><small class="mt-2 block">Or contact us directly: <a href="' + contactConfig.whatsapp_url + '" class="text-green-400 hover:text-green-300">WhatsApp</a> | <a href="' + contactConfig.phone_url + '" class="text-orange-400 hover:text-orange-300">Call</a> | <a href="' + contactConfig.email_url + '" class="text-blue-400 hover:text-blue-300">Email</a></small>';
                        }
                    } catch (error) {
                        console.error('Form submission error:', error);
                        
                        // Show detailed error message for debugging
                        successMsg.style.display = 'block';
                        successMsg.className = 'mt-4 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400 text-center';
                        
                        // Provide helpful error messages with contact alternatives
                        let errorMessage = 'Network error. ';
                        if (error.message.includes('Failed to fetch')) {
                            errorMessage += 'Please check if contact-handler.php exists and your server is running.';
                        } else if (error.message.includes('Server error')) {
                            errorMessage += 'Server responded with an error. Please check server logs.';
                        } else {
                            errorMessage += 'Please check your connection and try again.';
                        }
                        
                        errorMessage += '<br><small class="mt-2 block">Or contact us directly: <a href="' + contactConfig.whatsapp_url + '" class="text-green-400 hover:text-green-300">WhatsApp</a> | <a href="' + contactConfig.phone_url + '" class="text-orange-400 hover:text-orange-300">Call</a> | <a href="' + contactConfig.email_url + '" class="text-blue-400 hover:text-blue-300">Email</a></small>';
                        
                        successMsg.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>' + errorMessage;
                    } finally {
                        // Re-enable submit button
                        submitBtn.disabled = false;
                        submitText.textContent = 'Book 30-min Call';
                        
                        // Hide message after 10 seconds
                        setTimeout(() => {
                            successMsg.style.display = 'none';
                        }, 10000);
                    }
                }
            });
            
            // Note: Floating CTA is now a direct link to Calendly, no click handler needed
        });

        // Scroll event listeners
        window.addEventListener('scroll', () => {
            updateProgressBar();
            updateNavbar();
            updateFloatingCTA();
        });

        // Real-time input validation
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = ['name', 'email', 'service', 'message'];
            
            inputs.forEach(inputId => {
                const input = document.getElementById(inputId);
                if (input) {
                    input.addEventListener('blur', () => {
                        const value = input.value.trim();
                        
                        if (inputId === 'name' && value) {
                            showFormMessage('name', 'Looks good!');
                        } else if (inputId === 'email' && value) {
                            if (validateEmail(value)) {
                                showFormMessage('email', 'Valid email address');
                            } else {
                                showFormMessage('email', 'Please enter a valid email', true);
                            }
                        } else if (inputId === 'service' && value) {
                            showFormMessage('service', 'Service selected');
                        } else if (inputId === 'message' && value) {
                            showFormMessage('message', 'Thank you for the details');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
