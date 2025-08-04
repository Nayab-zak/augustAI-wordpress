@echo off
REM Direct deployment script using SSH/rsync for Windows
REM This replaces the .cpanel.yml approach

echo 🚀 Starting deployment to augustai.com...

REM Configuration
set SERVER_USER=augustcom92b
set SERVER_HOST=augustai.com
set REMOTE_PATH=/home/augustcom92b/public_html
set LOCAL_PATH=.

echo 📁 Deploying files...
rsync -avz --delete --exclude=".git" --exclude=".gitignore" --exclude="_archive" --exclude="_builds" --exclude="_docs" --exclude="ssh_key.txt" --exclude="id_rsa.pub" --exclude="*.md" --exclude="build.sh" --exclude="deploy.sh" %LOCAL_PATH%/ %SERVER_USER%@%SERVER_HOST%:%REMOTE_PATH%/

echo ✅ Deployment complete!
echo 🌐 Visit https://augustai.com to verify
