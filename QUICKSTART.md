# AugustAI Website - Quick Start Guide

## ⚡ Get Running in 5 Minutes

### Prerequisites
- Node.js 18+ installed
- Python 3.8+ installed
- Git installed

### 1. Clone or Download
```bash
# If you have the code locally, navigate to the directory
cd augustai-complete
```

### 2. Start Frontend (Terminal 1)
```bash
cd augustai-website
npm install
npm run dev
```
Frontend will be available at: http://localhost:5173

### 3. Start Backend (Terminal 2)
```bash
cd augustai-backend
source venv/bin/activate  # Linux/Mac
# or venv\Scripts\activate  # Windows

pip install -r requirements.txt
python src/main.py
```
Backend will be available at: http://localhost:5000

### 4. Configure Email (Optional)
Edit `augustai-backend/.env` with your email settings:
```env
SMTP_USERNAME=your-email@gmail.com
SMTP_PASSWORD=your-app-password
CONTACT_TO_EMAIL=your-contact@email.com
```

### 5. Test Everything
- Visit http://localhost:5173
- Navigate through all pages
- Test the ROI calculator
- Try the contact form
- Check mobile responsiveness

## 🎯 Key Features to Test

### Homepage
- ✅ 3D animated hero section
- ✅ Pain points section
- ✅ Services grid
- ✅ About section
- ✅ Contact form
- ✅ CTA section with contact buttons

### ROI Calculator (/roi)
- ✅ Input fields for hours, cost, months
- ✅ Real-time calculation updates
- ✅ Chart.js bar chart visualization
- ✅ ROI narrative generation
- ✅ Currency formatting

### Services Page (/services)
- ✅ Service listings with pricing
- ✅ Expandable descriptions
- ✅ Call-to-action buttons

### Contact Features
- ✅ Contact form with validation
- ✅ WhatsApp integration
- ✅ Phone number links
- ✅ Calendly booking
- ✅ Live chat widget

### Technical Features
- ✅ Responsive design (mobile/desktop)
- ✅ Semantic HTML structure
- ✅ Accessibility features
- ✅ Performance optimization
- ✅ Brand gradient styling

## 🔧 Quick Customization

### Update Business Info
Edit these files:
- `augustai-backend/.env` - Contact details
- `augustai-website/src/components/Header.jsx` - Navigation
- `augustai-website/src/components/Footer.jsx` - Footer info

### Change Colors
Edit `augustai-website/src/App.css`:
```css
.brand-gradient {
  background: linear-gradient(135deg, #your-color1, #your-color2);
}
```

### Update Logo
Replace `augustai-website/src/assets/augustai-logo.png`

### Modify Services
Edit `augustai-website/src/pages/ServicesPage.jsx`

## 🚀 Production Build

### Build Frontend
```bash
cd augustai-website
npm run build
```

### Serve with Backend
```bash
cp -r augustai-website/dist/* augustai-backend/src/static/
cd augustai-backend
python src/main.py
```

Visit http://localhost:5000 for the complete application.

## 📱 Mobile Testing

Test on different screen sizes:
- Desktop: 1920x1080
- Tablet: 768x1024
- Mobile: 375x667

Use browser dev tools or real devices.

## 🐛 Common Issues

### Port Already in Use
```bash
# Kill process on port 5173
npx kill-port 5173

# Kill process on port 5000
npx kill-port 5000
```

### Dependencies Issues
```bash
# Clear npm cache
npm cache clean --force

# Reinstall dependencies
rm -rf node_modules package-lock.json
npm install
```

### Python Environment
```bash
# Create new virtual environment
python -m venv venv
source venv/bin/activate
pip install -r requirements.txt
```

## 📞 Need Help?

- Check README.md for detailed setup
- Check DEPLOYMENT.md for production deployment
- Contact: info@august.com.pk

---

**You're all set! 🎉**

