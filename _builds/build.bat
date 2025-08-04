@echo off
REM Build Script for augustAI Website
REM This script generates static files and prepares for deployment

echo 🚀 augustAI Build Script
echo ========================

REM Check if PHP is available
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP not found in PATH
    echo Please install PHP or add it to your PATH
    echo Common locations:
    echo   - C:\xampp\php\php.exe
    echo   - C:\php\php.exe
    echo.
    pause
    exit /b 1
)

echo ✅ PHP found

REM Clean up directory
echo 🧹 Cleaning up directory...
php cleanup.php

REM Generate static files
echo 📄 Generating static files...
php static-generator.php generate

REM Check if dist directory was created
if exist "dist" (
    echo ✅ Static files generated successfully
    echo 📁 Output directory: dist/
    echo.
    echo 🌐 Ready for deployment!
    echo.
    echo Next steps:
    echo 1. Test the generated files in dist/
    echo 2. Upload to your web server
    echo 3. Configure your CDN if using one
) else (
    echo ❌ Static generation failed
    echo Check for errors above
)

echo.
pause
