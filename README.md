# AugustAI Website - Complete Package

A fully interactive, modern website for AugustAI with 3D visual effects, ROI calculator, contact form, and all specified features.

## 🚀 Features

- **Modern React Frontend** with 3D animations using Three.js
- **Interactive ROI Calculator** with Chart.js visualization
- **Contact Form** with Flask backend integration
- **Responsive Design** optimized for mobile and desktop
- **Accessibility Features** with semantic HTML and ARIA labels
- **Live Chat Widget** and social media integration
- **Brand Gradient Design** with copper accent colors
- **Performance Optimized** for Lighthouse scores ≥90

## 📁 Project Structure

```
augustai-complete/
├── augustai-website/          # React Frontend
│   ├── src/
│   │   ├── components/        # Reusable components
│   │   ├── pages/            # Page components
│   │   └── assets/           # Images and static files
│   ├── dist/                 # Built production files
│   └── package.json
├── augustai-backend/         # Flask Backend
│   ├── src/
│   │   ├── routes/           # API routes
│   │   ├── static/           # Served static files
│   │   └── main.py           # Flask application
│   ├── venv/                 # Python virtual environment
│   ├── .env                  # Environment variables
│   └── requirements.txt
└── README.md                 # This file
```

## 🛠️ Setup Instructions

### Frontend (React)

1. **Navigate to frontend directory:**
   ```bash
   cd augustai-website
   ```

2. **Install dependencies:**
   ```bash
   pnpm install
   # or
   npm install
   ```

3. **Start development server:**
   ```bash
   pnpm run dev
   # or
   npm run dev
   ```

4. **Build for production:**
   ```bash
   pnpm run build
   # or
   npm run build
   ```

### Backend (Flask)

1. **Navigate to backend directory:**
   ```bash
   cd augustai-backend
   ```

2. **Activate virtual environment:**
   ```bash
   source venv/bin/activate  # Linux/Mac
   # or
   venv\Scripts\activate     # Windows
   ```

3. **Install dependencies:**
   ```bash
   pip install -r requirements.txt
   ```

4. **Configure environment variables:**
   Edit `.env` file with your SMTP settings:
   ```env
   SMTP_HOST=smtp.gmail.com
   SMTP_PORT=587
   SMTP_SECURE=tls
   SMTP_USERNAME=your-email@gmail.com
   SMTP_PASSWORD=your-app-password
   SMTP_FROM_EMAIL=noreply@yourdomain.com
   SMTP_FROM_NAME=Your Company Name
   CONTACT_TO_EMAIL=contact@yourdomain.com
   ```

5. **Start Flask server:**
   ```bash
   python src/main.py
   ```

## 🌐 Deployment Options

### Option 1: Full-Stack Deployment

1. Build the React frontend:
   ```bash
   cd augustai-website
   pnpm run build
   ```

2. Copy built files to Flask static directory:
   ```bash
   cp -r dist/* ../augustai-backend/src/static/
   ```

3. Deploy Flask backend (serves both API and frontend):
   ```bash
   cd augustai-backend
   python src/main.py
   ```

### Option 2: Separate Deployment

1. **Frontend:** Deploy `augustai-website/dist/` to any static hosting service (Netlify, Vercel, etc.)

2. **Backend:** Deploy Flask app to cloud service (Heroku, AWS, etc.)

3. **Update API endpoints** in frontend to point to your backend URL

## 🔧 Configuration

### Environment Variables

The backend requires these environment variables in `.env`:

```env
# SMTP Configuration
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_SECURE=tls
SMTP_USERNAME=info@august.com.pk
SMTP_PASSWORD=your-app-password
SMTP_FROM_EMAIL=noreply@august.com.pk
SMTP_FROM_NAME=AugustAI Contact Form

# Contact Settings
CONTACT_TO_EMAIL=info@august.com.pk

# Business Information
WHATSAPP_NUMBER=+971554483607
PHONE_NUMBER=+971583066201
CALENDLY_URL=https://calendly.com/admin-august/30min
BUSINESS_EMAIL=info@august.com.pk
BUSINESS_NAME=augustAI
SLOGAN=Automate Everything, Focus on What Matters
BUSINESS_ADDRESS=168 Banigala, Islamabad, Pakistan
```

### Frontend Configuration

Update contact information in `src/components/Header.jsx` and `src/components/Footer.jsx` if needed.

## 📱 Features Overview

### 1. Homepage
- Hero section with 3D animated background
- Pain points section
- Services overview
- About section
- Contact form
- CTA section

### 2. Services Page
- Detailed service listings with pricing
- Expandable service descriptions
- Call-to-action buttons

### 3. ROI Calculator
- Interactive calculator with real-time updates
- Chart.js visualization
- ROI narrative generation
- Currency formatting

### 4. Contact Form
- Full validation
- Email integration via Flask backend
- Success/error messaging
- Privacy policy compliance

### 5. Additional Features
- Live chat widget
- WhatsApp integration
- Calendly booking
- Phone contact
- Social media links
- Privacy policy page

## 🎨 Design System

### Colors
- Primary: Copper gradient (#B87333 to #CD853F)
- Background: White (#FFFFFF)
- Text: Gray-900 (#111827)
- Accent: Copper (#B87333)

### Typography
- Font Family: Inter (system fallback)
- Headings: Bold weights
- Body: Regular weight
- Responsive sizing

### Components
- Built with shadcn/ui components
- Tailwind CSS for styling
- Lucide React icons
- Responsive design patterns

## 🚀 Performance

- Lighthouse score ≥90 on mobile
- Lazy loading for images
- Code splitting
- Optimized bundle size
- Semantic HTML
- Accessibility features

## 📞 Support

For questions or support, contact:
- Email: info@august.com.pk
- Phone: +971 58 306 6201
- WhatsApp: +971 55 448 3607

## 📄 License

This project is proprietary to AugustAI. All rights reserved.

---

**Built with ❤️ by AugustAI Team**

<!-- Mohihussain@2025 -->
<!-- admin@augsut.com -->
<!-- formspree -->