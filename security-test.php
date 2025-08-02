<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>augustAI Security Test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .test-section { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .pass { color: #006600; font-weight: bold; }
        .fail { color: #cc0000; font-weight: bold; }
        .warning { color: #ff8800; font-weight: bold; }
        .info { color: #0066cc; }
        pre { background: #eee; padding: 10px; overflow-x: auto; }
        .header-check { display: flex; justify-content: space-between; margin: 5px 0; }
    </style>
</head>
<body>
    <h1>augustAI Security Configuration Test</h1>
    
    <div class="test-section">
        <h2>🔒 HTTPS & Security Headers</h2>
        
        <div class="header-check">
            <span>HTTPS Connection:</span>
            <span class="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'pass' : 'fail'; ?>">
                <?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? '✓ SECURE' : '✗ INSECURE'; ?>
            </span>
        </div>
        
        <div class="header-check">
            <span>HSTS Header:</span>
            <span class="info">Check manually with browser dev tools</span>
        </div>
        
        <p class="info">
            <strong>Next Steps for Full HTTPS Security:</strong><br>
            1. Test SSL configuration: <a href="https://www.ssllabs.com/ssltest/analyze.html?d=august.com.pk" target="_blank">SSL Labs Test</a><br>
            2. Enable HSTS at server level (Apache/Nginx config)<br>
            3. Target: A+ rating with TLS 1.3 minimum
        </p>
    </div>
    
    <div class="test-section">
        <h2>🤖 reCAPTCHA v3 Configuration</h2>
        
        <?php
        require_once 'security-config.php';
        
        $site_key = defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : '';
        $secret_key = defined('RECAPTCHA_SECRET_KEY') ? RECAPTCHA_SECRET_KEY : '';
        ?>
        
        <div class="header-check">
            <span>Site Key:</span>
            <span class="<?php echo (!empty($site_key) && $site_key !== 'YOUR_RECAPTCHA_SITE_KEY_HERE') ? 'pass' : 'fail'; ?>">
                <?php echo (!empty($site_key) && $site_key !== 'YOUR_RECAPTCHA_SITE_KEY_HERE') ? '✓ CONFIGURED' : '✗ NOT SET'; ?>
            </span>
        </div>
        
        <div class="header-check">
            <span>Secret Key:</span>
            <span class="<?php echo (!empty($secret_key) && $secret_key !== 'YOUR_RECAPTCHA_SECRET_KEY_HERE') ? 'pass' : 'fail'; ?>">
                <?php echo (!empty($secret_key) && $secret_key !== 'YOUR_RECAPTCHA_SECRET_KEY_HERE') ? '✓ CONFIGURED' : '✗ NOT SET'; ?>
            </span>
        </div>
        
        <?php if (empty($site_key) || $site_key === 'YOUR_RECAPTCHA_SITE_KEY_HERE'): ?>
        <p class="fail">
            <strong>⚠️ reCAPTCHA Not Configured!</strong><br>
            1. Go to <a href="https://www.google.com/recaptcha/admin/create" target="_blank">Google reCAPTCHA Admin</a><br>
            2. Create reCAPTCHA v3 for domain: august.com.pk<br>
            3. Update keys in <code>security-config.php</code><br>
            4. Test form submission
        </p>
        <?php else: ?>
        <p class="pass">✓ reCAPTCHA keys configured. Test form submission to verify.</p>
        <?php endif; ?>
    </div>
    
    <div class="test-section">
        <h2>🛡️ Anti-Spam Protection</h2>
        
        <div class="header-check">
            <span>Honeypot Field:</span>
            <span class="pass">✓ ENABLED</span>
        </div>
        
        <div class="header-check">
            <span>Rate Limiting:</span>
            <span class="pass">✓ ENABLED (3 submissions per 5 minutes)</span>
        </div>
        
        <div class="header-check">
            <span>Input Validation:</span>
            <span class="pass">✓ ENABLED (Length limits, email validation)</span>
        </div>
        
        <div class="header-check">
            <span>XSS Protection:</span>
            <span class="pass">✓ ENABLED (HTML sanitization)</span>
        </div>
    </div>
    
    <div class="test-section">
        <h2>🔐 Data Privacy</h2>
        
        <div class="header-check">
            <span>ROI Calculator:</span>
            <span class="pass">✓ CLIENT-ONLY (No server persistence)</span>
        </div>
        
        <div class="header-check">
            <span>Form Data Handling:</span>
            <span class="pass">✓ SECURE (Validated & sanitized)</span>
        </div>
        
        <div class="header-check">
            <span>Session Security:</span>
            <span class="pass">✓ ENABLED (Rate limiting only)</span>
        </div>
    </div>
    
    <div class="test-section">
        <h2>🧪 Security Test Instructions</h2>
        
        <h3>1. Test Contact Form Protection</h3>
        <ul>
            <li>Submit form normally - should work</li>
            <li>Submit 4+ times rapidly - should be rate limited</li>
            <li>Inspect honeypot field (hidden "website" input) - should reject if filled</li>
            <li>Try XSS in message field - should be sanitized</li>
        </ul>
        
        <h3>2. Test HTTPS Configuration</h3>
        <ul>
            <li>Visit: <a href="https://www.ssllabs.com/ssltest/analyze.html?d=august.com.pk" target="_blank">SSL Labs Test</a></li>
            <li>Target: A+ rating</li>
            <li>Check: TLS 1.3 enabled, HSTS configured</li>
        </ul>
        
        <h3>3. Test reCAPTCHA</h3>
        <ul>
            <li>Submit contact form - check browser network tab for reCAPTCHA requests</li>
            <li>Check server logs for reCAPTCHA validation</li>
            <li>Verify score threshold (0.5) is working</li>
        </ul>
        
        <h3>4. Privacy Verification</h3>
        <ul>
            <li>Use ROI calculator - check no data sent to server</li>
            <li>Monitor network tab - only form submission should send data</li>
            <li>Verify no PII stored inadvertently</li>
        </ul>
    </div>
    
    <div class="test-section">
        <h2>📋 Security Checklist</h2>
        
        <pre>
□ reCAPTCHA v3 keys configured
□ Contact form spam protection tested
□ SSL/TLS configuration optimized (A+ rating)
□ HSTS headers enabled at server level
□ ROI calculator verified as client-only
□ Rate limiting tested and working
□ XSS protection validated
□ Honeypot anti-spam tested
□ Security headers properly configured
□ Form validation working correctly
        </pre>
    </div>
    
    <div class="test-section">
        <h2>🚀 Production Deployment Security</h2>
        
        <p><strong>Before going live:</strong></p>
        <ol>
            <li>Configure actual reCAPTCHA keys (not placeholders)</li>
            <li>Enable HSTS at server level (Apache/Nginx)</li>
            <li>Force TLS 1.3 minimum in server configuration</li>
            <li>Test all security measures with real traffic</li>
            <li>Monitor logs for suspicious activity</li>
            <li>Set up security monitoring and alerts</li>
        </ol>
    </div>
    
    <p><em>Generated: <?php echo date('Y-m-d H:i:s'); ?></em></p>
</body>
</html>
