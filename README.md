# augustAI Website - Organized Structure

## 📁 Core Files
- `index.php` - Main website (PHP with dynamic content)
- `privacy.php` - Privacy policy page
- `content-config.php` - Services and content configuration
- `.htaccess` - URL routing and server configuration

## 📁 Organized Folders

### `/assets/` - Website Assets
- Images, logos, icons
- CSS and JavaScript files

### `/components/` - Modular Components  
- Reusable PHP components
- Template parts

### `/api/` - API Endpoints
- Contact form handlers
- API functionality

### `/_configs/` - Configuration Files
- `config-simple.php` - Site configuration
- Environment files (.env)
- SMTP and other configs

### `/_tests/` - Testing & Debug
- Test files for diagnostics
- Debug scripts
- Status checking tools

### `/_builds/` - Build & Deployment
- Static site generators
- Build scripts
- Deployment tools

### `/_docs/` - Documentation
- Setup guides
- Implementation notes
- Deployment instructions

### `/_archive/` - Archived Files
- Old versions
- Unused files
- Backup copies

## 🚀 Quick Start
1. Main site: `index.php`
2. Privacy policy: `privacy.php` or `/privacy`
3. Debug: `index.php?debug=1`

## 🔧 Development
- Configuration: `_configs/config-simple.php`
- Content: `content-config.php`
- Components: `/components/`
- Tests: `/_tests/`
