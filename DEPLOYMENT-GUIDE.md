# Production Deployment Guide

## Overview
This guide covers the complete deployment process for the augustAI website with static site generation, security hardening, and performance optimization.

## Quick Start
```bash
# Generate static site
php static-generator.php generate

# Run full build pipeline
php build-pipeline.php production

# Test security configuration
php security-test.php
```

## Pre-Deployment Checklist

### 1. Environment Validation
- [ ] PHP 7.4+ installed
- [ ] All configuration files present
- [ ] reCAPTCHA keys configured
- [ ] SSL certificate ready
- [ ] DNS configuration prepared

### 2. Security Requirements
- [ ] reCAPTCHA v3 keys configured in `security-config.php`
- [ ] HSTS headers enabled
- [ ] Content Security Policy configured
- [ ] Rate limiting implemented
- [ ] Honeypot fields active

### 3. Performance Requirements
- [ ] Static files generated
- [ ] Assets optimized
- [ ] CDN configured (optional)
- [ ] Caching headers set
- [ ] Gzip compression enabled

## Deployment Methods

### Method 1: Static Site Generation (Recommended)

#### Step 1: Generate Static Files
```bash
php static-generator.php generate
```

This creates optimized static HTML files in the `dist/` directory.

#### Step 2: Upload to Web Server
```bash
# Upload dist/ contents to web root
rsync -avz dist/ user@server:/var/www/html/

# Or using FTP/SFTP
# Upload all files from dist/ to public_html/
```

#### Step 3: Configure Web Server

**Apache (.htaccess)**
```apache
# Security Headers
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
Header always set X-Content-Type-Options "nosniff"
Header always set X-Frame-Options "DENY"
Header always set X-XSS-Protection "1; mode=block"

# Caching
<FilesMatch "\.(css|js|png|jpg|jpeg|gif|svg|ico)$">
    ExpiresActive On
    ExpiresDefault "access plus 1 year"
</FilesMatch>

# Gzip Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
</IfModule>

# Redirect HTTP to HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

**Nginx**
```nginx
server {
    listen 80;
    server_name august.com.pk www.august.com.pk;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    server_name august.com.pk www.august.com.pk;
    
    root /var/www/html;
    index index.html;
    
    # SSL Configuration
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-RSA-AES128-GCM-SHA256:ECDHE-RSA-AES256-GCM-SHA384;
    
    # Security Headers
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains; preload" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-Frame-Options "DENY" always;
    add_header X-XSS-Protection "1; mode=block" always;
    
    # Caching
    location ~* \.(css|js|png|jpg|jpeg|gif|svg|ico)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
    
    # Gzip
    gzip on;
    gzip_vary on;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml;
}
```

### Method 2: Dynamic PHP Deployment

#### Step 1: Upload PHP Files
```bash
# Upload all PHP files
rsync -avz --exclude='dist/' . user@server:/var/www/html/
```

#### Step 2: Configure Environment
```bash
# Copy production configuration
cp env-config.php.production env-config.php

# Set file permissions
chmod 644 *.php
chmod 755 api/
chmod 755 includes/
```

#### Step 3: Database Setup (if needed)
Currently no database required, but for future CMS integration:
```sql
-- Future database setup for CMS
CREATE DATABASE augustai_cms;
GRANT ALL PRIVILEGES ON augustai_cms.* TO 'augustus'@'localhost';
```

## CDN Setup (Optional but Recommended)

### Cloudflare Configuration
1. **DNS Settings**
   - A record: `august.com.pk` → Server IP
   - CNAME: `www` → `august.com.pk`
   - CNAME: `cdn` → `august.com.pk`

2. **Performance Settings**
   - Auto Minify: CSS, JavaScript, HTML
   - Brotli Compression: Enabled
   - Rocket Loader: Enabled
   - Polish: Lossless

3. **Security Settings**
   - Security Level: Medium
   - Bot Fight Mode: Enabled
   - Always Use HTTPS: Enabled

### AWS CloudFront (Alternative)
```json
{
  "CallerReference": "augustai-distribution",
  "Origins": {
    "DomainName": "august.com.pk",
    "Id": "august-origin",
    "CustomOriginConfig": {
      "HTTPPort": 80,
      "HTTPSPort": 443,
      "OriginProtocolPolicy": "https-only"
    }
  },
  "DefaultCacheBehavior": {
    "TargetOriginId": "august-origin",
    "ViewerProtocolPolicy": "redirect-to-https",
    "CachePolicyId": "managed-caching-optimized"
  }
}
```

## Monitoring and Maintenance

### 1. Performance Monitoring
```bash
# Add to crontab for daily performance checks
0 2 * * * curl -w "@curl-format.txt" -o /dev/null -s "https://august.com.pk"
```

### 2. Security Monitoring
```bash
# Weekly security scan
0 0 * * 0 php security-test.php > /var/log/security-audit.log
```

### 3. Backup Strategy
```bash
#!/bin/bash
# Daily backup script
DATE=$(date +%Y%m%d)
tar -czf "/backups/augustai-$DATE.tar.gz" /var/www/html/
find /backups/ -name "augustai-*.tar.gz" -mtime +30 -delete
```

### 4. Update Process
```bash
# Update deployment script
#!/bin/bash
cd /tmp
wget https://github.com/augustus/website/archive/main.zip
unzip main.zip
php website-main/build-pipeline.php production
rsync -avz website-main/dist/ /var/www/html/
```

## Troubleshooting

### Common Issues

#### 1. Contact Form Not Working
- **Check**: reCAPTCHA keys in `security-config.php`
- **Verify**: SMTP configuration in `smtp-config.php`
- **Test**: `php test-email.php`

#### 2. Static Files Not Loading
- **Check**: File permissions (644 for files, 755 for directories)
- **Verify**: Web server configuration
- **Test**: Direct file access in browser

#### 3. Performance Issues
- **Check**: Gzip compression enabled
- **Verify**: Browser caching headers
- **Test**: Google PageSpeed Insights

#### 4. Security Warnings
- **Check**: SSL certificate validity
- **Verify**: Security headers present
- **Test**: Mozilla Observatory scan

### Error Codes

#### HTTP 500 - Internal Server Error
```bash
# Check PHP error logs
tail -f /var/log/apache2/error.log
# or
tail -f /var/log/nginx/error.log

# Check file permissions
ls -la /var/www/html/
```

#### HTTP 403 - Forbidden
```bash
# Fix file permissions
find /var/www/html/ -type f -exec chmod 644 {} \;
find /var/www/html/ -type d -exec chmod 755 {} \;
```

#### Contact Form Errors
```bash
# Test email configuration
php test-email.php

# Check reCAPTCHA
curl -X POST "https://www.google.com/recaptcha/api/siteverify" \
  -d "secret=YOUR_SECRET_KEY" \
  -d "response=test"
```

## Performance Benchmarks

### Target Metrics
- **First Contentful Paint**: < 1.5s
- **Largest Contentful Paint**: < 2.5s
- **Total Blocking Time**: < 300ms
- **Cumulative Layout Shift**: < 0.1

### Testing Commands
```bash
# Lighthouse CI
npx lighthouse-ci autorun

# WebPageTest
curl "https://www.webpagetest.org/runtest.php?url=https://august.com.pk&k=API_KEY"

# GTmetrix
curl "https://gtmetrix.com/api/0.1/test" \
  -u "email@domain.com:api_key" \
  -d "url=https://august.com.pk"
```

## Rollback Procedure

### Quick Rollback
```bash
# Keep previous version
mv /var/www/html /var/www/html.backup
mv /var/www/html.previous /var/www/html
systemctl reload apache2
```

### Full Rollback
```bash
# Restore from backup
tar -xzf /backups/augustai-YYYYMMDD.tar.gz -C /var/www/html/
systemctl reload apache2
```

## Security Compliance

### OWASP Top 10 Checklist
- [x] A01: Broken Access Control - Rate limiting implemented
- [x] A02: Cryptographic Failures - HTTPS enforced
- [x] A03: Injection - Input validation with reCAPTCHA
- [x] A04: Insecure Design - Security by design principles
- [x] A05: Security Misconfiguration - Secure headers configured
- [x] A06: Vulnerable Components - Dependencies updated
- [x] A07: Authentication Failures - No authentication required
- [x] A08: Software Integrity Failures - Code integrity maintained
- [x] A09: Logging Failures - Security logging implemented
- [x] A10: SSRF - No server-side requests made

### Compliance Reports
```bash
# Generate security report
php security-test.php > security-report.html

# SSL Labs test
curl "https://api.ssllabs.com/api/v3/analyze?host=august.com.pk"
```

This deployment guide ensures your augustAI website is deployed with enterprise-grade security, performance, and scalability.
