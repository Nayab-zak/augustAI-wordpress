# Component Architecture Guide

This document explains the modular component structure of the augustAI website.

## 📁 Directory Structure

```
augustAI-wordpress/
├── 🏠 Core Files
│   ├── index.php                 # Main landing page (monolithic)
│   ├── content-config.php        # Centralized configuration
│   ├── static-generator.php      # Build system
│   └── cleanup.php              # Directory maintenance
│
├── 🧩 Components/
│   ├── renderer.php             # Template rendering system
│   ├── services.php             # Services section
│   ├── about-us.php             # About/Why Us section
│   ├── contact.php              # Contact form
│   ├── portfolio.php            # Portfolio showcase
│   ├── testimonials.php         # Client testimonials
│   ├── roi-calculator.php       # ROI calculation tool
│   ├── process.php              # Process timeline
│   ├── hero.php                 # Hero section
│   └── navigation.php           # Navigation bar
│
├── ⚙️ Configuration/
│   ├── config.php               # Main configuration
│   ├── security-config.php      # Security settings
│   └── smtp-config.php          # Email configuration
│
├── 🔧 Handlers/
│   ├── contact-handler.php      # Form processing
│   └── security-check.php       # Security validation
│
├── 🎨 Assets/
│   └── assets/                  # Images, logos, etc.
│
├── 🌐 API/
│   └── api/                     # API endpoints
│
├── 🏗️ Build/
│   ├── build.bat               # Windows build script
│   ├── build.ps1               # PowerShell build script
│   └── dist/                   # Generated static files
│
└── 📚 Documentation/
    ├── DEPLOYMENT.md
    ├── SETUP.md
    └── UX-POLISH-SUMMARY.md
```

## 🧩 Component System

### How Components Work

1. **Standalone Components**: Each component is a self-contained PHP file that can be rendered independently
2. **Shared Configuration**: All components load from `content-config.php` for consistency
3. **Template Rendering**: The `ComponentRenderer` class handles loading and rendering components
4. **Static Generation**: Components can be built into static HTML files for CDN deployment

### Creating New Components

```php
<?php
/**
 * New Component Example
 * components/example.php
 */

// Load configuration if not already loaded
if (!isset($content_config)) {
    $content_config = require_once __DIR__ . '/../content-config.php';
}

// Extract any needed data
$example_data = $content_config['example_section'] ?? [];
?>

<!-- Your HTML here -->
<section id="example" class="py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Component content -->
    </div>
</section>
```

### Component Configuration

Add your component route to `content-config.php`:

```php
'static_generation' => [
    'routes' => [
        '/example' => 'components/example.php',
        // ... other routes
    ]
]
```

## 🏗️ Build System

### Static Site Generation

The build system generates static HTML files from PHP components:

```bash
# Windows
build.bat

# PowerShell
.\build.ps1

# Direct PHP (if available in PATH)
php static-generator.php generate
```

### Generated Structure

```
dist/
├── index.html              # Main page
├── services/
│   └── index.html          # Services page
├── about/
│   └── index.html          # About page
├── contact/
│   └── index.html          # Contact page
├── assets/                 # Copied assets
└── sitemap.xml            # Generated sitemap
```

## 🎯 Benefits of This Architecture

### 1. **Modularity**
- Each section can be developed/tested independently
- Easy to maintain and update specific features
- Reusable components across different pages

### 2. **Performance**
- Static HTML generation for faster loading
- CDN-ready output files
- Reduced server processing time

### 3. **SEO Optimization**
- Individual pages for better indexing
- Dedicated URLs for each section
- Automatic sitemap generation

### 4. **Development Efficiency**
- Separation of concerns
- Easier team collaboration
- Component-based testing

### 5. **Deployment Flexibility**
- Can deploy as static site or dynamic PHP
- CDN compatibility
- Multiple hosting options

## 🔄 Development Workflow

### 1. **Component Development**
```bash
# Edit individual components
components/services.php
components/about-us.php
# etc.
```

### 2. **Testing**
```bash
# Test individual component
http://localhost/components/services.php

# Test full site
http://localhost/index.php
```

### 3. **Static Generation**
```bash
# Generate static files
.\build.ps1

# Test static files
# Open dist/index.html in browser
```

### 4. **Deployment**
```bash
# Upload dist/ folder to web server
# Configure CDN to serve from dist/
# Update DNS if needed
```

## 🎨 Styling & Assets

### Shared Styles
- All components inherit styles from main CSS in the renderer
- Consistent color scheme and typography
- Responsive design utilities

### Asset Management
- Images stored in `assets/` directory
- Copied automatically during build process
- Optimized for CDN delivery

## 🔧 Maintenance

### Regular Cleanup
```bash
php cleanup.php
```

This script:
- Moves test files to `_archive/`
- Organizes log files
- Updates `.gitignore`
- Cleans temporary files

### Configuration Updates
- Update `content-config.php` for pricing/content changes
- Rebuild static files after updates
- Test generated output before deployment

## 🚀 Future Enhancements

### Planned Features
1. **CMS Integration**: Headless CMS for content management
2. **Advanced Build Pipeline**: Minification, optimization
3. **A/B Testing**: Component-level testing capabilities
4. **Analytics Integration**: Performance tracking per component

### Migration Path
The current architecture supports gradual migration:
1. ✅ **Phase 1**: Component separation (current)
2. 🔄 **Phase 2**: CMS integration
3. 📋 **Phase 3**: Advanced build pipeline
4. 🎯 **Phase 4**: Full static site with dynamic features

This modular approach provides flexibility while maintaining the simplicity needed for the current requirements.
