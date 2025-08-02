<?php
/**
 * Simple Contact Form Test
 * This is a basic version that should work without WordPress
 */

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
$to = 'hello@august.com.pk'; // Your email
$subject = '[AugustAI] New Contact Form Submission';

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
    'From: AugustAI Contact Form <noreply@august.com.pk>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8'
];

// Try to send email
$sent = false;
try {
    $sent = mail($to, $subject, $email_content, implode("\r\n", $headers));
} catch (Exception $e) {
    error_log('Email sending failed: ' . $e->getMessage());
}

if ($sent) {
    // Log submission
    $log_entry = date('Y-m-d H:i:s') . " - SUCCESS - $name ($email) - $service\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message! We will get back to you soon.'
    ]);
} else {
    // Log failure
    $log_entry = date('Y-m-d H:i:s') . " - FAILED - $name ($email) - Email sending failed\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => false,
        'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly at hello@august.com.pk'
    ]);
}
?>
