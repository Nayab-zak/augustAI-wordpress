<?php
/**
 * WordPress Contact Form Handler
 * Place this in your WordPress theme's functions.php file
 */

// Add AJAX handler for logged-in and non-logged-in users
add_action('wp_ajax_handle_contact_form', 'augustai_handle_contact_form');
add_action('wp_ajax_nopriv_handle_contact_form', 'augustai_handle_contact_form');

function augustai_handle_contact_form() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'augustai_contact_form')) {
        wp_send_json_error('Security check failed');
        return;
    }
    
    // Rate limiting
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'contact_form_' . md5($user_ip);
    $submissions = get_transient($transient_key) ?: 0;
    
    if ($submissions >= 3) {
        wp_send_json_error('Too many submissions. Please try again later.');
        return;
    }
    
    // Validate and sanitize input
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $company = sanitize_text_field($_POST['company']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Validation
    $errors = [];
    if (empty($name) || strlen($name) < 2) {
        $errors[] = 'Name is required and must be at least 2 characters';
    }
    if (empty($email) || !is_email($email)) {
        $errors[] = 'Valid email address is required';
    }
    if (empty($message) || strlen($message) < 10) {
        $errors[] = 'Message is required and must be at least 10 characters';
    }
    if (empty($service)) {
        $errors[] = 'Please select a service';
    }
    
    if (!empty($errors)) {
        wp_send_json_error(implode(', ', $errors));
        return;
    }
    
    // Prepare email
    $to = getenv('CONTACT_TO_EMAIL') ?: 'hello@august.com.pk';
    $subject = '[AugustAI] New Contact Form Submission';
    
    $email_message = "New contact form submission:\n\n";
    $email_message .= "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Company: $company\n";
    $email_message .= "Service: $service\n\n";
    $email_message .= "Message:\n$message\n\n";
    $email_message .= "---\n";
    $email_message .= "Submitted: " . current_time('mysql') . "\n";
    $email_message .= "IP Address: $user_ip\n";
    
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: AugustAI Contact Form <noreply@' . $_SERVER['HTTP_HOST'] . '>',
        'Reply-To: ' . $email
    ];
    
    // Send email using WordPress wp_mail function
    $sent = wp_mail($to, $subject, $email_message, $headers);
    
    if ($sent) {
        // Update rate limiting
        set_transient($transient_key, $submissions + 1, HOUR_IN_SECONDS);
        
        // Log submission (optional)
        error_log("Contact form submission: $name ($email) - $service");
        
        wp_send_json_success('Thank you for your message! We will get back to you soon.');
    } else {
        wp_send_json_error('Sorry, there was an error sending your message. Please try again.');
    }
}

// Add nonce to footer for AJAX security
add_action('wp_footer', 'augustai_add_contact_nonce');
function augustai_add_contact_nonce() {
    if (is_page() || is_front_page()) {
        echo '<script>window.augustai_nonce = "' . wp_create_nonce('augustai_contact_form') . '";</script>';
    }
}
?>
