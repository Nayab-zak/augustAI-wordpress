# Build Script for augustAI Website (PowerShell)
# This script generates static files and prepares for deployment

Write-Host "🚀 augustAI Build Script" -ForegroundColor Green
Write-Host "========================" -ForegroundColor Green

# Check if PHP is available
try {
    $phpVersion = php --version 2>$null
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ PHP found" -ForegroundColor Green
    } else {
        throw "PHP not found"
    }
} catch {
    Write-Host "❌ PHP not found in PATH" -ForegroundColor Red
    Write-Host "Please install PHP or add it to your PATH" -ForegroundColor Yellow
    Write-Host "Common locations:" -ForegroundColor Yellow
    Write-Host "  - C:\xampp\php\php.exe" -ForegroundColor Yellow
    Write-Host "  - C:\php\php.exe" -ForegroundColor Yellow
    Read-Host "Press Enter to exit"
    exit 1
}

# Clean up directory
Write-Host "🧹 Cleaning up directory..." -ForegroundColor Blue
try {
    php cleanup.php
    Write-Host "✅ Cleanup completed" -ForegroundColor Green
} catch {
    Write-Host "⚠️  Cleanup encountered issues, continuing..." -ForegroundColor Yellow
}

# Generate static files
Write-Host "📄 Generating static files..." -ForegroundColor Blue
try {
    php static-generator.php generate
    
    # Check if dist directory was created
    if (Test-Path "dist") {
        Write-Host "✅ Static files generated successfully" -ForegroundColor Green
        Write-Host "📁 Output directory: dist/" -ForegroundColor Cyan
        Write-Host ""
        Write-Host "🌐 Ready for deployment!" -ForegroundColor Green
        Write-Host ""
        Write-Host "Next steps:" -ForegroundColor Yellow
        Write-Host "1. Test the generated files in dist/" -ForegroundColor White
        Write-Host "2. Upload to your web server" -ForegroundColor White
        Write-Host "3. Configure your CDN if using one" -ForegroundColor White
        
        # Show generated files
        Write-Host ""
        Write-Host "Generated files:" -ForegroundColor Cyan
        Get-ChildItem -Path "dist" -Recurse -File | ForEach-Object {
            Write-Host "  - $($_.FullName.Replace((Get-Location).Path + '\dist\', ''))" -ForegroundColor Gray
        }
    } else {
        Write-Host "❌ Static generation failed" -ForegroundColor Red
        Write-Host "Check for errors above" -ForegroundColor Yellow
    }
} catch {
    Write-Host "❌ Static generation failed: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host ""
Read-Host "Press Enter to exit"
