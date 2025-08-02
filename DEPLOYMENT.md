# augustAI WordPress Site - Deployment Instructions

## 🔐 Security Setup

### Environment Variables Configuration

1. **Copy the example file:**
   ```bash
   cp .env.example .env
   ```

2. **Edit `.env` with your actual credentials:**
   ```bash
   # WordPress SMTP Configuration
   SMTP_HOST=smtp.gmail.com
   SMTP_PORT=587
   SMTP_SECURE=tls
   SMTP_USERNAME=your-actual-email@domain.com
   SMTP_PASSWORD=your-actual-password
   SMTP_FROM_EMAIL=noreply@yourdomain.com
   SMTP_FROM_NAME=Your Site Contact Form

   # Contact form settings
   CONTACT_TO_EMAIL=your-actual-email@domain.com

   # Contact Information (WhatsApp, Phone, Calendly)
   WHATSAPP_NUMBER=your-actual-whatsapp-number
   PHONE_NUMBER=your-actual-phone-number
   CALENDLY_URL=https://calendly.com/your-actual-username/30min

   # Business Information
   BUSINESS_EMAIL=your-actual-email@domain.com
   BUSINESS_NAME=Your Business Name
   ```

3. **NEVER commit the `.env` file to Git!**
   - The `.gitignore` file already excludes it
   - Only commit `.env.example` as a template

## 📁 File Structure

- `index.php` - Main site (uses environment variables)
- `index.html` - Static backup (hardcoded values)
- `config.php` - Environment configuration loader
- `.env` - Your actual credentials (NEVER commit!)
- `.env.example` - Template for credentials (safe to commit)

## 🚀 Deployment Steps

1. **Upload files** (excluding `.env`)
2. **Create `.env` file** on server with your credentials
3. **Test email delivery** using `test-email.php`
4. **Use `index.php`** instead of `index.html` for dynamic configuration

## 🧪 Testing

- Visit `/test-email.php` to test email delivery
- Check `contact_log.txt` for form submission logs
- Form tries 3 handlers: simple → SMTP → WordPress

## 📞 Contact Methods

All contact information is now centralized in `.env`:
- WhatsApp, Phone, Calendly URLs
- Business email and name
- SMTP configuration

## ⚠️ Security Notes

- `.env` contains sensitive data - keep it secure
- Use app passwords for Gmail SMTP
- Regularly rotate passwords
- Monitor `contact_log.txt` for security issues
