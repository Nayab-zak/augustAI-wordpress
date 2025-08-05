# AugustAI Website Deployment Guide

## WordPress cPanel Deployment

This repository is configured for automatic deployment to WordPress hosting via cPanel Git integration.

### Prerequisites

1. **Domain**: august.com.pk (already purchased)
2. **WordPress hosting** with cPanel access
3. **Git integration** enabled in cPanel
4. **Node.js support** (optional, for server-side features)

### Deployment Steps

1. **Push to GitHub**:
   ```bash
   git add .
   git commit -m "Initial AugustAI website"
   git push origin main
   ```

2. **cPanel Git Setup**:
   - Go to cPanel → Git Version Control
   - Click "Create" to add new repository
   - Repository URL: `https://github.com/yourusername/augustai-website.git`
   - Repository Path: `/public_html/`
   - Branch: `main`

3. **Auto-Deployment**:
   - The `.cpanel.yml` file will automatically:
     - Copy all files to your domain root
     - Set proper file permissions
     - Install Node.js dependencies (if available)
     - Configure WordPress integration

### File Structure After Deployment

```
/public_html/
├── index.html          # Main website
├── index.php           # WordPress integration
├── styles.css          # All styling
├── script.js           # Frontend JavaScript
├── server.js           # Backend API (if Node.js available)
├── privacy.html        # Privacy policy
├── functions.php       # WordPress functions
├── .htaccess          # Server configuration
└── .env               # Environment variables (secure)
```

### WordPress Integration

The site works in **hybrid mode**:

- **Static HTML** for main content (fast loading)
- **WordPress backend** for content management
- **PHP integration** for dynamic features
- **Custom functions** for contact forms and SEO

### Environment Variables

Update `.env` file with your actual credentials:

```env
SMTP_HOST=smtp.gmail.com
SMTP_USERNAME=hello@august.com.pk
SMTP_PASSWORD=your_actual_password
WHATSAPP_NUMBER=971554483607
PHONE_NUMBER=971583066201
CALENDLY_URL=https://calendly.com/admin-august/30min
```

### Contact Form Options

**Option 1: Node.js Server** (if supported by hosting)
- Full JavaScript form handling
- Automatic email responses
- Real-time validation

**Option 2: WordPress Integration** (fallback)
- PHP-based form processing
- WordPress admin integration
- Built-in security features

### Security Features

- **Environment file protection** (.env secured)
- **WordPress security headers**
- **File permission management**
- **XSS and CSRF protection**
- **Input sanitization**

### Testing

After deployment, test:

1. **Main website**: https://august.com.pk
2. **Privacy policy**: https://august.com.pk/privacy.html
3. **Contact forms**: Submit test message
4. **WhatsApp**: Click WhatsApp links
5. **Calendly**: Test booking integration
6. **Email**: Verify auto-responses

### Maintenance

- **Updates**: Push to GitHub, cPanel auto-deploys
- **Monitoring**: Check email delivery
- **Analytics**: Add Google Analytics if needed
- **Backups**: cPanel automatic backups
- **SSL**: Ensure SSL certificate is active

### Support

For deployment issues:
- **Email**: hello@august.com.pk
- **Phone**: +971 58 306 6201
- **WhatsApp**: +971 55 448 3607

### Performance

- **Static HTML**: Ultra-fast loading
- **CSS/JS minification**: Automated via .htaccess
- **Image optimization**: Use Unsplash CDN
- **Caching**: Browser and server-level
- **Mobile-first**: Responsive design

The website is production-ready and optimized for UAE/GCC market with proper Arabic RTL support if needed in future updates.