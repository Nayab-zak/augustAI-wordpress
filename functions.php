<?php
// AugustAI WordPress Theme Functions
// Add this to your active theme's functions.php or create a custom plugin

// Enqueue AugustAI styles and scripts
function augustai_enqueue_assets() {
    wp_enqueue_style('augustai-styles', get_template_directory_uri() . '/styles.css', array(), '1.0.0');
    wp_enqueue_script('augustai-scripts', get_template_directory_uri() . '/script.js', array(), '1.0.0', true);
    
    // Enqueue Calendly script
    wp_enqueue_script('calendly-widget', 'https://assets.calendly.com/assets/external/widget.js', array(), null, true);
    wp_enqueue_style('calendly-widget-css', 'https://assets.calendly.com/assets/external/widget.css');
}
add_action('wp_enqueue_scripts', 'augustai_enqueue_assets');

// Add custom post type for case studies
function augustai_create_case_studies_post_type() {
    register_post_type('case_study',
        array(
            'labels' => array(
                'name' => 'Case Studies',
                'singular_name' => 'Case Study'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-chart-line'
        )
    );
}
add_action('init', 'augustai_create_case_studies_post_type');

// Handle contact form submissions
function augustai_handle_contact_form() {
    if ($_POST['action'] === 'augustai_contact') {
        
        // Verify nonce for security
        if (!wp_verify_nonce($_POST['nonce'], 'augustai_contact_nonce')) {
            wp_die('Security check failed');
        }
        
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $service = sanitize_text_field($_POST['service']);
        $message = sanitize_textarea_field($_POST['message']);
        
        // Send email
        $to = 'hello@august.com.pk';
        $subject = 'New Contact Form Submission - ' . $service;
        $body = "Name: $name\nEmail: $email\nPhone: $phone\nService: $service\nMessage: $message";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        $sent = wp_mail($to, $subject, $body, $headers);
        
        if ($sent) {
            wp_send_json_success('Message sent successfully');
        } else {
            wp_send_json_error('Failed to send message');
        }
    }
}
add_action('wp_ajax_augustai_contact', 'augustai_handle_contact_form');
add_action('wp_ajax_nopriv_augustai_contact', 'augustai_handle_contact_form');

// Add custom meta tags for SEO
function augustai_add_meta_tags() {
    if (is_front_page()) {
        echo '<meta name="description" content="AI agents that automate workflows in 14 days. Dashboards in 10 days, MVPs in 30. Serving UAE/GCC SMEs and US/UK startups.">';
        echo '<meta name="keywords" content="AI automation Dubai, agentic AI UAE, business intelligence Dubai, process automation GCC, AI agents UAE">';
        echo '<meta property="og:title" content="AugustAI - Agentic AI That Gets Work Done">';
        echo '<meta property="og:description" content="AI agents that log in, fetch, decide, and update systems end-to-end. 30-70% fewer manual hours, dashboards in 10 days.">';
        echo '<meta property="og:url" content="https://august.com.pk">';
        echo '<meta property="og:type" content="website">';
    }
}
add_action('wp_head', 'augustai_add_meta_tags');

// Disable WordPress comments (not needed for business site)
function augustai_disable_comments() {
    return false;
}
add_filter('comments_open', 'augustai_disable_comments');
add_filter('pings_open', 'augustai_disable_comments');

// Remove WordPress version from head (security)
remove_action('wp_head', 'wp_generator');

// Add custom admin footer
function augustai_admin_footer() {
    echo '<span id="footer-thankyou">AugustAI Website - Powered by <a href="https://august.com.pk">agentic AI</a></span>';
}
add_filter('admin_footer_text', 'augustai_admin_footer');

// Custom WordPress login logo
function augustai_login_logo() {
    echo '<style type="text/css">
        #login h1 a {
            background-image: none;
            text-indent: 0;
            font-size: 24px;
            font-weight: bold;
            color: #3182ce;
            width: auto;
            height: auto;
        }
        #login h1 a:before {
            content: "august";
        }
        #login h1 a:after {
            content: "AI";
            color: #38a169;
        }
    </style>';
}
add_action('login_enqueue_scripts', 'augustai_login_logo');

// Add shortcodes for easy content management
function augustai_contact_form_shortcode() {
    ob_start();
    include 'contact-form-template.php';
    return ob_get_clean();
}
add_shortcode('augustai_contact_form', 'augustai_contact_form_shortcode');

function augustai_calendly_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text' => 'Book a 20-min call',
        'class' => 'btn-primary'
    ), $atts);
    
    return '<button class="' . esc_attr($atts['class']) . '" onclick="openCalendly()">' . esc_html($atts['text']) . '</button>';
}
add_shortcode('augustai_calendly', 'augustai_calendly_shortcode');

// Security enhancements
function augustai_security_enhancements() {
    // Remove WordPress version from scripts and styles
    add_filter('style_loader_src', 'augustai_remove_version', 9999);
    add_filter('script_loader_src', 'augustai_remove_version', 9999);
}

function augustai_remove_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

add_action('init', 'augustai_security_enhancements');

// Custom error page
function augustai_custom_404() {
    if (is_404()) {
        include(get_template_directory() . '/404-custom.php');
        exit();
    }
}
add_action('wp', 'augustai_custom_404');
?>