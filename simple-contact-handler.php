<?php
/**
 * Simple Contact Form Handler
 * Works with both WordPress constants and .env files
 */

// Load WordPress-compatible configuration
require_once 'wp-config.php';

// Enable CORS for testing
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get POST data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$company = isset($_POST['company']) ? trim($_POST['company']) : '';
$service = isset($_POST['service']) ? trim($_POST['service']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate required fields
$errors = [];
if (empty($name) || strlen($name) < 2) {
    $errors[] = 'Name is required and must be at least 2 characters';
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email address is required';
}
if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Message is required and must be at least 10 characters';
}
if (empty($service)) {
    $errors[] = 'Please select a service';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Sanitize data
$name = htmlspecialchars($name);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$company = htmlspecialchars($company);
$service = htmlspecialchars($service);
$message = htmlspecialchars($message);

// Email configuration
// Email configuration - WordPress constants or fallback values
$to = defined('AUGUSTAI_CONTACT_TO_EMAIL') ? AUGUSTAI_CONTACT_TO_EMAIL : ($_ENV['CONTACT_TO_EMAIL'] ?? 'hello@august.com.pk');
$from_email = defined('AUGUSTAI_SMTP_FROM_EMAIL') ? AUGUSTAI_SMTP_FROM_EMAIL : ($_ENV['SMTP_FROM_EMAIL'] ?? 'noreply@august.com.pk');
$business_name = defined('AUGUSTAI_BUSINESS_NAME') ? AUGUSTAI_BUSINESS_NAME : ($_ENV['BUSINESS_NAME'] ?? 'AugustAI');
$whatsapp_number = defined('AUGUSTAI_WHATSAPP_NUMBER') ? AUGUSTAI_WHATSAPP_NUMBER : ($_ENV['WHATSAPP_NUMBER'] ?? '971554483607');

$subject = '[' . $business_name . '] New Contact Form Submission';

// Email content
$email_content = "New contact form submission:\n\n";
$email_content .= "Name: $name\n";
$email_content .= "Email: $email\n";
$email_content .= "Company: $company\n";
$email_content .= "Service: $service\n\n";
$email_content .= "Message:\n$message\n\n";
$email_content .= "---\n";
$email_content .= "Submitted: " . date('Y-m-d H:i:s') . "\n";
$email_content .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

// Email headers
$headers = [
    'From: ' . $business_name . ' Contact Form <' . $from_email . '>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8'
];

// Try to send email
$sent = false;
$email_error = '';

try {
    // Set additional headers for better deliverability
    $headers = [
        'From: AugustAI Contact Form <noreply@august.com.pk>',
        'Reply-To: ' . $email,
        'X-Mailer: PHP/' . phpversion(),
        'Content-Type: text/plain; charset=UTF-8',
        'MIME-Version: 1.0'
    ];
    
    // Log email attempt
    $log_entry = date('Y-m-d H:i:s') . " - ATTEMPTING - $name ($email) - $service\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    $sent = mail($to, $subject, $email_content, implode("\r\n", $headers));
    
    if (!$sent) {
        $email_error = error_get_last()['message'] ?? 'Unknown mail error';
    }
} catch (Exception $e) {
    $email_error = $e->getMessage();
    error_log('Email sending failed: ' . $e->getMessage());
}

if ($sent) {
    // Log successful submission
    $log_entry = date('Y-m-d H:i:s') . " - SUCCESS - $name ($email) - $service - Email sent successfully\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message! We will get back to you soon.',
        'debug' => 'Email sent successfully'
    ]);
} else {
    // Log failure with detailed error
    $log_entry = date('Y-m-d H:i:s') . " - FAILED - $name ($email) - Email error: $email_error\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    // Still show success to user but log the email issue
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message! We have received it and will contact you soon.',
        'debug' => 'Form received but email delivery issue: ' . $email_error,
        'fallback' => 'Please also reach us directly at ' . $_ENV['BUSINESS_EMAIL'] . ' or WhatsApp +' . substr($whatsapp_number, 0, 3) . ' ' . substr($whatsapp_number, 3, 2) . ' ' . substr($whatsapp_number, 5, 3) . ' ' . substr($whatsapp_number, 8)
    ]);
}
?>
