# AugustAI Website - Deployment Guide

## 🚀 Production Deployment Options

### Option 1: Vercel + Railway (Recommended)

#### Frontend (Vercel)
1. Push code to GitHub repository
2. Connect Vercel to your GitHub repo
3. Set build command: `cd augustai-website && pnpm run build`
4. Set output directory: `augustai-website/dist`
5. Deploy automatically

#### Backend (Railway)
1. Push backend code to GitHub
2. Connect Railway to your repo
3. Set start command: `python src/main.py`
4. Add environment variables in Railway dashboard
5. Deploy automatically

### Option 2: Netlify + Heroku

#### Frontend (Netlify)
1. Drag and drop `augustai-website/dist` folder to Netlify
2. Or connect GitHub repo with build settings:
   - Build command: `cd augustai-website && pnpm run build`
   - Publish directory: `augustai-website/dist`

#### Backend (Heroku)
1. Create `Procfile` in backend root:
   ```
   web: python src/main.py
   ```
2. Push to Heroku:
   ```bash
   heroku create your-app-name
   git push heroku main
   ```

### Option 3: AWS (Advanced)

#### Frontend (S3 + CloudFront)
1. Upload `dist` folder to S3 bucket
2. Enable static website hosting
3. Configure CloudFront distribution
4. Set up custom domain

#### Backend (EC2 + RDS)
1. Launch EC2 instance
2. Install Python and dependencies
3. Configure nginx as reverse proxy
4. Set up SSL certificate
5. Configure RDS for database (if needed)

### Option 4: DigitalOcean App Platform

1. Connect GitHub repository
2. Configure build settings:
   - Frontend: Static site from `augustai-website/dist`
   - Backend: Python app from `augustai-backend`
3. Set environment variables
4. Deploy with automatic scaling

## 🔧 Environment Configuration

### Production Environment Variables

```env
# Flask Configuration
FLASK_ENV=production
SECRET_KEY=your-super-secret-key-here

# SMTP Configuration (Gmail)
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_SECURE=tls
SMTP_USERNAME=your-email@gmail.com
SMTP_PASSWORD=your-app-password
SMTP_FROM_EMAIL=noreply@yourdomain.com
SMTP_FROM_NAME=AugustAI

# Contact Configuration
CONTACT_TO_EMAIL=contact@yourdomain.com

# Business Information
WHATSAPP_NUMBER=+971554483607
PHONE_NUMBER=+971583066201
CALENDLY_URL=https://calendly.com/your-link
BUSINESS_EMAIL=contact@yourdomain.com
BUSINESS_NAME=AugustAI
BUSINESS_ADDRESS=Your Business Address
```

### Gmail App Password Setup

1. Enable 2-factor authentication on Gmail
2. Go to Google Account settings
3. Security → App passwords
4. Generate app password for "Mail"
5. Use this password in `SMTP_PASSWORD`

## 🔒 Security Considerations

### Backend Security
- Use strong `SECRET_KEY`
- Enable HTTPS in production
- Configure CORS properly
- Validate all form inputs
- Rate limit contact form submissions

### Frontend Security
- Sanitize user inputs
- Use HTTPS for all requests
- Implement CSP headers
- Minimize exposed API endpoints

## 📊 Monitoring & Analytics

### Recommended Tools
- **Uptime Monitoring:** UptimeRobot, Pingdom
- **Analytics:** Google Analytics, Plausible
- **Error Tracking:** Sentry
- **Performance:** Google PageSpeed Insights

### Health Check Endpoint
Add to Flask backend:
```python
@app.route('/health')
def health_check():
    return {'status': 'healthy', 'timestamp': datetime.utcnow().isoformat()}
```

## 🚀 Performance Optimization

### Frontend Optimizations
- Enable gzip compression
- Set proper cache headers
- Use CDN for static assets
- Optimize images (WebP format)
- Implement service worker for caching

### Backend Optimizations
- Use gunicorn for production WSGI server
- Configure nginx for static file serving
- Enable database connection pooling
- Implement Redis for caching
- Use async processing for emails

## 📱 Domain & SSL Setup

### Custom Domain
1. Purchase domain from registrar
2. Configure DNS records:
   - A record: `@` → Your server IP
   - CNAME: `www` → Your domain
3. Update environment variables with new domain

### SSL Certificate
- **Free:** Let's Encrypt via Certbot
- **Paid:** SSL certificate from registrar
- **Managed:** Use platform SSL (Vercel, Netlify)

## 🔄 CI/CD Pipeline

### GitHub Actions Example
```yaml
name: Deploy AugustAI Website

on:
  push:
    branches: [main]

jobs:
  deploy-frontend:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup Node.js
        uses: actions/setup-node@v2
        with:
          node-version: '18'
      - name: Install dependencies
        run: cd augustai-website && npm install
      - name: Build
        run: cd augustai-website && npm run build
      - name: Deploy to Vercel
        uses: vercel/action@v1
        with:
          vercel-token: ${{ secrets.VERCEL_TOKEN }}

  deploy-backend:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Deploy to Railway
        uses: railway/action@v1
        with:
          railway-token: ${{ secrets.RAILWAY_TOKEN }}
```

## 🐛 Troubleshooting

### Common Issues

1. **CORS Errors**
   - Ensure Flask-CORS is configured properly
   - Check frontend API endpoints

2. **Email Not Sending**
   - Verify SMTP credentials
   - Check Gmail app password
   - Ensure 2FA is enabled

3. **Build Failures**
   - Check Node.js version compatibility
   - Verify all dependencies are installed
   - Check for TypeScript errors

4. **Performance Issues**
   - Enable gzip compression
   - Optimize images
   - Use CDN for static assets

### Debug Commands
```bash
# Check Flask logs
python src/main.py --debug

# Test email configuration
python -c "from src.routes.contact import test_email; test_email()"

# Build with verbose output
npm run build --verbose
```

## 📞 Support

For deployment support:
- Email: tech@august.com.pk
- Documentation: Check README.md
- Issues: Create GitHub issue

---

**Happy Deploying! 🚀**

