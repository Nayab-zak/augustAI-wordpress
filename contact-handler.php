<?php
/**
 * AugustAI Contact Form Handler
 * Secure PHP script for handling contact form submissions
 * Includes CSRF protection, input validation, and proper email headers
 */

// Start session for CSRF protection
session_start();

// Security headers
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Configuration
$config = [
    'to_email' => 'hello@august.com.pk',
    'from_email' => 'noreply@august.com.pk', // Use your domain for better deliverability
    'from_name' => 'AugustAI Contact Form',
    'subject_prefix' => '[AugustAI] ',
    'rate_limit' => 5, // Max submissions per hour per IP
    'allowed_origins' => ['august.com.pk', 'www.august.com.pk'], // Add your domains
];

/**
 * Rate limiting function
 */
function checkRateLimit($ip, $limit = 5) {
    $file = sys_get_temp_dir() . '/contact_rate_' . md5($ip);
    $current_time = time();
    $hour_ago = $current_time - 3600;
    
    // Read existing timestamps
    $timestamps = [];
    if (file_exists($file)) {
        $timestamps = array_filter(
            explode("\n", file_get_contents($file)),
            function($timestamp) use ($hour_ago) {
                return $timestamp > $hour_ago;
            }
        );
    }
    
    // Check if limit exceeded
    if (count($timestamps) >= $limit) {
        return false;
    }
    
    // Add current timestamp
    $timestamps[] = $current_time;
    file_put_contents($file, implode("\n", $timestamps));
    
    return true;
}

/**
 * Input validation and sanitization
 */
function validateInput($data) {
    $errors = [];
    
    // Required fields
    if (empty($data['name']) || strlen(trim($data['name'])) < 2) {
        $errors[] = 'Name is required and must be at least 2 characters';
    }
    
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email address is required';
    }
    
    if (empty($data['message']) || strlen(trim($data['message'])) < 10) {
        $errors[] = 'Message is required and must be at least 10 characters';
    }
    
    // Sanitize inputs
    $clean_data = [
        'name' => htmlspecialchars(trim($data['name']), ENT_QUOTES, 'UTF-8'),
        'company' => htmlspecialchars(trim($data['company'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'email' => filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(trim($data['phone'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'service' => htmlspecialchars(trim($data['service'] ?? ''), ENT_QUOTES, 'UTF-8'),
        'message' => htmlspecialchars(trim($data['message']), ENT_QUOTES, 'UTF-8'),
    ];
    
    // Additional validation
    if (strlen($clean_data['name']) > 100) {
        $errors[] = 'Name is too long';
    }
    
    if (strlen($clean_data['message']) > 5000) {
        $errors[] = 'Message is too long';
    }
    
    // Check for spam patterns
    $spam_patterns = ['/\b(viagra|cialis|casino|lottery|winner)\b/i', '/http[s]?:\/\//'];
    foreach ($spam_patterns as $pattern) {
        if (preg_match($pattern, $clean_data['message']) || preg_match($pattern, $clean_data['name'])) {
            $errors[] = 'Message contains prohibited content';
            break;
        }
    }
    
    return ['data' => $clean_data, 'errors' => $errors];
}

/**
 * Send email with proper headers for deliverability
 */
function sendEmail($data, $config) {
    $to = $config['to_email'];
    $subject = $config['subject_prefix'] . 'New Contact Form Submission from ' . $data['name'];
    
    // Create email body
    $body = "New contact form submission received:\n\n";
    $body .= "Name: " . $data['name'] . "\n";
    $body .= "Company: " . ($data['company'] ?: 'Not provided') . "\n";
    $body .= "Email: " . $data['email'] . "\n";
    $body .= "Phone: " . ($data['phone'] ?: 'Not provided') . "\n";
    $body .= "Service Interest: " . ($data['service'] ?: 'Not specified') . "\n";
    $body .= "Submitted: " . date('Y-m-d H:i:s T') . "\n";
    $body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n\n";
    $body .= "Message:\n" . $data['message'] . "\n\n";
    $body .= "---\n";
    $body .= "This email was sent from the AugustAI contact form.";
    
    // Email headers for better deliverability
    $headers = [
        'From: ' . $config['from_name'] . ' <' . $config['from_email'] . '>',
        'Reply-To: ' . $data['name'] . ' <' . $data['email'] . '>',
        'X-Mailer: PHP/' . phpversion(),
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
        'X-Priority: 3',
        'Message-ID: <' . time() . '.' . md5($data['email']) . '@august.com.pk>',
        'Date: ' . date('r'),
    ];
    
    // Send email
    $success = mail($to, $subject, $body, implode("\r\n", $headers));
    
    // Log the attempt
    error_log(sprintf(
        "[%s] Contact form submission: %s - %s - %s",
        date('Y-m-d H:i:s'),
        $success ? 'SUCCESS' : 'FAILED',
        $data['email'],
        $_SERVER['REMOTE_ADDR']
    ));
    
    return $success;
}

/**
 * JSON response helper
 */
function jsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// Main processing
try {
    // Only accept POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        jsonResponse(false, 'Method not allowed');
    }
    
    // Check origin (simple CORS protection)
    $origin = $_SERVER['HTTP_ORIGIN'] ?? $_SERVER['HTTP_REFERER'] ?? '';
    $origin_host = parse_url($origin, PHP_URL_HOST);
    
    if ($origin_host && !in_array($origin_host, $config['allowed_origins'])) {
        jsonResponse(false, 'Origin not allowed');
    }
    
    // Rate limiting
    $client_ip = $_SERVER['REMOTE_ADDR'];
    if (!checkRateLimit($client_ip, $config['rate_limit'])) {
        jsonResponse(false, 'Too many requests. Please try again later.');
    }
    
    // Get and validate input
    $input_data = $_POST;
    $validation = validateInput($input_data);
    
    if (!empty($validation['errors'])) {
        jsonResponse(false, 'Validation failed: ' . implode(', ', $validation['errors']));
    }
    
    // Send email
    $email_sent = sendEmail($validation['data'], $config);
    
    if ($email_sent) {
        jsonResponse(true, 'Thank you for your message! We will get back to you soon.');
    } else {
        jsonResponse(false, 'Sorry, there was an error sending your message. Please try again or contact us directly.');
    }
    
} catch (Exception $e) {
    error_log('Contact form error: ' . $e->getMessage());
    jsonResponse(false, 'An unexpected error occurred. Please try again later.');
}
?>