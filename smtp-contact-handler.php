<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'env-loader.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Load form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$company = trim($_POST['company'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if (empty($name) || empty($email) || empty($service) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Try using PHPMailer for better email delivery
if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'] ?? '';
        $mail->Password = $_ENV['SMTP_PASSWORD'] ?? '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'] ?? 587;
        
        // Recipients
        $mail->setFrom($_ENV['SMTP_FROM_EMAIL'] ?? 'hello@august.com.pk', 'augustAI Contact Form');
        $mail->addAddress($_ENV['SMTP_TO_EMAIL'] ?? 'hello@august.com.pk');
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission from $name";
        
        $html_message = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Company:</strong> " . ($company ?: 'Not provided') . "</p>
        <p><strong>Service:</strong> $service</p>
        <p><strong>Message:</strong></p>
        <p>" . nl2br(htmlspecialchars($message)) . "</p>
        <hr>
        <p><small>Submitted at: " . date('Y-m-d H:i:s') . "</small></p>
        ";
        
        $mail->Body = $html_message;
        $mail->AltBody = "New Contact Form Submission\n\nName: $name\nEmail: $email\nCompany: " . ($company ?: 'Not provided') . "\nService: $service\n\nMessage:\n$message\n\nSubmitted at: " . date('Y-m-d H:i:s');
        
        $mail->send();
        
        // Log successful submission
        $log_entry = date('Y-m-d H:i:s') . " - SMTP SUCCESS - $name ($email) - $service\n";
        file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you soon.',
            'method' => 'SMTP via PHPMailer'
        ]);
        
    } catch (Exception $e) {
        // Log SMTP failure
        $log_entry = date('Y-m-d H:i:s') . " - SMTP FAILED - $name ($email) - Error: {$mail->ErrorInfo}\n";
        file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        // Fall back to regular mail function
        fallback_to_mail($name, $email, $company, $service, $message);
    }
} else {
    // PHPMailer not available, use regular mail
    fallback_to_mail($name, $email, $company, $service, $message);
}

function fallback_to_mail($name, $email, $company, $service, $message) {
    $to = $_ENV['EMAIL_TO'] ?? 'hello@august.com.pk';
    $subject = "New Contact Form Submission from $name";
    
    $email_message = "New Contact Form Submission\n\n";
    $email_message .= "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Company: " . ($company ?: 'Not provided') . "\n";
    $email_message .= "Service: $service\n\n";
    $email_message .= "Message:\n$message\n\n";
    $email_message .= "Submitted at: " . date('Y-m-d H:i:s') . "\n";
    
    $headers = "From: " . ($_ENV['EMAIL_FROM'] ?? 'hello@august.com.pk') . "\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $sent = mail($to, $subject, $email_message, $headers);
    
    if ($sent) {
        $log_entry = date('Y-m-d H:i:s') . " - MAIL SUCCESS - $name ($email) - $service\n";
        file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you soon.',
            'method' => 'PHP mail() function'
        ]);
    } else {
        $log_entry = date('Y-m-d H:i:s') . " - MAIL FAILED - $name ($email) - PHP mail() failed\n";
        file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        echo json_encode([
            'success' => true,
            'message' => 'Thank you for your message! We have received it and will contact you soon.',
            'fallback' => 'Email delivery issue - please contact us directly at hello@august.com.pk or WhatsApp +971554483607',
            'method' => 'Fallback notification'
        ]);
    }
}
?>
