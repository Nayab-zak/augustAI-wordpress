# 🚀 WordPress Deployment Guide - Secure Credential Management

## ⚠️ **NEVER Push Credentials to Git!**

Even with private repos, credentials should NEVER be in version control because:
- Git history is permanent
- Team members get all credentials
- CI/CD tools access the repo
- Risk of accidental exposure

## ✅ **Proper WordPress Deployment Process**

### **Step 1: Push Code (without credentials)**
These files are safe to commit:
```bash
git add .env.example
git add wp-config-constants.php
git add wp-config.php
git add index.php
git add DEPLOYMENT.md
git commit -m "Deploy WordPress-compatible configuration"
git push origin main
```

### Step 2: WordPress Constants Setup
After Git deployment, add these to your **live WordPress wp-config.php** file:

```php
// === AugustAI Configuration ===
// Add these BEFORE the "That's all, stop editing!" line

// Contact Information
define('AUGUSTAI_WHATSAPP_NUMBER', '971554483607');
define('AUGUSTAI_PHONE_NUMBER', '971583066201');
define('AUGUSTAI_CALENDLY_URL', 'https://calendly.com/admin-august/30min');
define('AUGUSTAI_BUSINESS_EMAIL', 'hello@august.com.pk');
define('AUGUSTAI_BUSINESS_NAME', 'augustAI');

// SMTP Configuration (CHANGE THESE!)
define('AUGUSTAI_SMTP_HOST', 'smtp.gmail.com');
define('AUGUSTAI_SMTP_PORT', 587);
define('AUGUSTAI_SMTP_USERNAME', 'hello@august.com.pk');
define('AUGUSTAI_SMTP_PASSWORD', 'your-actual-app-password');
define('AUGUSTAI_SMTP_FROM_EMAIL', 'noreply@august.com.pk');
define('AUGUSTAI_CONTACT_TO_EMAIL', 'hello@august.com.pk');
```

### Step 3: File Access
- **Main site**: Use `index.php` (dynamic configuration)
- **Backup**: `index.html` still works with hardcoded values

## 🔐 Security Benefits

✅ **What's Safe in Git:**
- `.env.example` (template only)
- `wp-config-constants.php` (example constants)
- `wp-config.php` (loads config safely)
- All PHP handlers
- Documentation

❌ **What's NEVER in Git:**
- `.env` (blocked by .gitignore)
- Actual passwords
- Real phone numbers
- Live credentials

## 📁 WordPress File Structure

```
your-wordpress-site/
├── wp-config.php (your live WordPress config + constants)
├── index.php (dynamic site using constants)
├── index.html (static backup)
├── contact handlers (simple-contact-handler.php, etc.)
└── assets/
```

## 🧪 Testing After Deployment

1. **Visit your site** - should work with constants
2. **Test contact form** - check if submissions work
3. **Check email delivery** - visit `/test-email.php`
4. **Monitor logs** - check `contact_log.txt`

### 🚨 Troubleshooting HTTP 500 Errors

If you get "HTTP ERROR 500":

1. **Test basic functionality**:
   ```
   http://yoursite.com/test-simple.php
   http://yoursite.com/debug.php
   ```

2. **Check file permissions**:
   ```bash
   chmod 644 *.php
   chmod 644 *.html
   chmod 755 assets/
   ```

3. **Common fixes**:
   - **Missing WordPress constants**: Add constants to wp-config.php
   - **File path issues**: Ensure all files uploaded correctly
   - **PHP version**: Requires PHP 7.4+ 
   - **Missing files**: Check if logo files uploaded to /assets/

4. **Fallback options**:
   - Use `index.html` instead of `index.php` (static version)
   - Check server error logs in cPanel/hosting panel
   - Contact hosting provider if PHP errors persist

## 🔄 Alternative Methods

### Method 1: WordPress Constants (Recommended)
- Add constants to wp-config.php manually
- Most secure for WordPress

### Method 2: WordPress Environment Variables
- Use WordPress environment variable plugins
- Good for team collaboration

### Method 3: Manual File Upload
- Upload `.env` separately via FTP/cPanel
- Not recommended for Git workflows

## ⚠️ Important Notes

1. **Never commit real credentials to Git**
2. **Always add sensitive constants directly to live wp-config.php**
3. **Use app passwords for Gmail SMTP**
4. **Test email delivery after deployment**
5. **Keep constants above "stop editing" line in wp-config.php**

## 📞 Fallback Contact Methods

If email fails, these always work:
- WhatsApp: Defined in constants
- Phone: Direct tel: links
- Calendly: Direct booking link
