# PowerShell deployment script for augustAI website
# This uses SCP (part of OpenSSH) instead of rsync

param(
    [string]$ServerHost = "augustai.com",
    [string]$ServerUser = "augustcom92b", 
    [string]$RemotePath = "public_html",
    [string]$SSHKeyPath = "_archive/id_rsa.pub"
)

Write-Host "🚀 Starting deployment to augustai.com..." -ForegroundColor Green

# Files to exclude from deployment
$ExcludePatterns = @(
    "_archive",
    "_builds", 
    "_docs",
    "*.md",
    ".git*",
    "ssh_key.txt", 
    "id_rsa.pub",
    "deploy.*",
    "build.*"
)

# Create a temporary directory with files to deploy
$TempDir = "temp_deploy"
if (Test-Path $TempDir) { Remove-Item $TempDir -Recurse -Force }
New-Item -ItemType Directory -Path $TempDir

Write-Host "📁 Preparing files for deployment..." -ForegroundColor Yellow

# Copy all files except excluded ones
Get-ChildItem -Path . | Where-Object {
    $item = $_
    $shouldExclude = $false
    foreach ($pattern in $ExcludePatterns) {
        if ($item.Name -like $pattern) {
            $shouldExclude = $true
            break
        }
    }
    -not $shouldExclude
} | ForEach-Object {
    if ($_.PSIsContainer) {
        Copy-Item $_.FullName $TempDir -Recurse
    } else {
        Copy-Item $_.FullName $TempDir
    }
}

Write-Host "🌐 Uploading to server..." -ForegroundColor Yellow

# Use SCP to upload files
$ServerConnection = "$ServerUser@$ServerHost"
$Command = "scp -r $TempDir/* ${ServerConnection}:$RemotePath/"

Write-Host "Executing: $Command" -ForegroundColor Cyan
try {
    Invoke-Expression $Command
    Write-Host "✅ Deployment complete!" -ForegroundColor Green
    Write-Host "🌐 Visit https://augustai.com to verify" -ForegroundColor Green
} catch {
    Write-Host "❌ Deployment failed: $_" -ForegroundColor Red
} finally {
    # Cleanup
    Remove-Item $TempDir -Recurse -Force
}
