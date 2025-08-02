<?php
// Email delivery test script
// Usage: http://yoursite.com/test-email.php

$test_email = 'hello@august.com.pk'; // Change to your email
$test_subject = 'Email Test from augustAI Server';
$test_message = "This is a test email sent at " . date('Y-m-d H:i:s') . "\n\n";
$test_message .= "Server: " . $_SERVER['SERVER_NAME'] . "\n";
$test_message .= "PHP Version: " . phpversion() . "\n";
$test_message .= "User Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'Not available') . "\n";

echo "<h2>Email Delivery Test</h2>";
echo "<p>Testing email delivery from this server...</p>";

// Test 1: Basic PHP mail() function
echo "<h3>Test 1: Basic PHP mail() function</h3>";
$headers = "From: hello@august.com.pk\r\n";
$headers .= "Reply-To: hello@august.com.pk\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

$result1 = mail($test_email, $test_subject . ' - Basic', $test_message, $headers);
echo "Result: " . ($result1 ? "<span style='color: green;'>SUCCESS</span>" : "<span style='color: red;'>FAILED</span>") . "<br>";

// Test 2: Enhanced headers
echo "<h3>Test 2: Enhanced headers</h3>";
$enhanced_headers = $headers;
$enhanced_headers .= "MIME-Version: 1.0\r\n";
$enhanced_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$enhanced_headers .= "Return-Path: hello@august.com.pk\r\n";

$result2 = mail($test_email, $test_subject . ' - Enhanced', $test_message, $enhanced_headers);
echo "Result: " . ($result2 ? "<span style='color: green;'>SUCCESS</span>" : "<span style='color: red;'>FAILED</span>") . "<br>";

// Test 3: Server configuration check
echo "<h3>Test 3: Server Configuration</h3>";
echo "Sendmail path: " . (ini_get('sendmail_path') ?: 'Not set') . "<br>";
echo "SMTP server: " . (ini_get('SMTP') ?: 'Not set') . "<br>";
echo "SMTP port: " . (ini_get('smtp_port') ?: 'Not set') . "<br>";
echo "Mail function available: " . (function_exists('mail') ? "Yes" : "No") . "<br>";

// Test 4: Error logging
echo "<h3>Test 4: Error Information</h3>";
if (error_get_last()) {
    echo "Last PHP error: " . error_get_last()['message'] . "<br>";
} else {
    echo "No PHP errors detected<br>";
}

// Test 5: Alternative method with more verbose error reporting
echo "<h3>Test 5: Verbose Error Reporting</h3>";
ini_set('log_errors', 1);
ini_set('error_log', 'email_errors.log');

$result3 = @mail($test_email, $test_subject . ' - Verbose', $test_message, $enhanced_headers);
echo "Result: " . ($result3 ? "<span style='color: green;'>SUCCESS</span>" : "<span style='color: red;'>FAILED</span>") . "<br>";

if (file_exists('email_errors.log')) {
    echo "Error log contents: <pre>" . file_get_contents('email_errors.log') . "</pre>";
} else {
    echo "No error log file created<br>";
}

echo "<hr>";
echo "<p><strong>Instructions:</strong></p>";
echo "<ul>";
echo "<li>If all tests fail, your server might not have mail configured</li>";
echo "<li>Check with your hosting provider about SMTP settings</li>";
echo "<li>Consider using an external email service like SendGrid, Mailgun, or Gmail SMTP</li>";
echo "<li>Check spam/junk folders for test emails</li>";
echo "</ul>";

echo "<p><strong>Alternative contact methods (always working):</strong></p>";
echo "<ul>";
echo "<li><a href='https://wa.me/971554483607'>WhatsApp: +971 55 448 3607</a></li>";
echo "<li><a href='tel:+971583066201'>Phone: +971 58 306 6201</a></li>";
echo "<li><a href='mailto:hello@august.com.pk'>Email: hello@august.com.pk</a></li>";
echo "</ul>";
?>
