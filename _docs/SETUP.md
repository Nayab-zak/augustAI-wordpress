# AugustAI WordPress Contact Form Setup

## 🔒 Security Setup (Environment Variables)

### 1. Environment Configuration

1. **Copy `.env` file** to your WordPress root directory
2. **Update the values** in `.env` with your actual credentials
3. **Never commit `.env`** to version control (already in .gitignore)

### 2. WordPress Integration

Add this to your `wp-config.php` file (before the WordPress constants):

```php
// Load environment variables
require_once(__DIR__ . '/env-loader.php');
```

Add this to your active theme's `functions.php` file:

```php
// Include SMTP configuration
require_once(get_template_directory() . '/smtp-config.php');

// Include contact form handler
require_once(get_template_directory() . '/wordpress-contact-handler.php');
```

### 3. Email Provider Setup

#### For Gmail:
1. Enable 2-Factor Authentication on your Google account
2. Generate an **App Password**:
   - Go to Google Account settings
   - Security → 2-Step Verification → App passwords
   - Generate password for "Mail"
   - Use this password in your `.env` file (not your regular password)

#### For Other Providers:
Update these values in `.env`:
- `SMTP_HOST` (e.g., smtp.outlook.com, smtp.yahoo.com)
- `SMTP_PORT` (usually 587 or 465)
- `SMTP_SECURE` (tls or ssl)

### 4. Testing

1. **Test Email Button**: If you're logged in as admin, you'll see a "Test Email" button
2. **Form Testing**: Submit the contact form to test the complete flow
3. **Debug Mode**: Set `WP_DEBUG = true` in wp-config.php to see SMTP debug info

### 5. Production Deployment

1. **Update .env** with production values
2. **Ensure .env is not publicly accessible**
3. **Set proper file permissions**: `chmod 600 .env`
4. **Monitor email delivery** in the first few days

## 🚨 Security Checklist

- [ ] `.env` file is not in version control
- [ ] App passwords used instead of regular passwords
- [ ] File permissions set correctly
- [ ] No credentials in source code
- [ ] Regular password rotation schedule

## 📧 Troubleshooting

### Email Not Sending:
1. Check SMTP credentials in `.env`
2. Verify app password (for Gmail)
3. Check server firewall (ports 587/465)
4. Enable debug mode and check logs

### Form Not Working:
1. Check browser console for JavaScript errors
2. Verify WordPress AJAX is working
3. Check contact form handler is loaded
4. Test with admin account first

## 🔄 Alternative: SMTP Plugin

For easier setup, consider using a WordPress SMTP plugin:
- **WP Mail SMTP by WPForms** (recommended)
- **Easy WP SMTP**
- **Post SMTP Mailer**

These plugins provide GUI configuration and better error handling.
