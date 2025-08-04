#!/bin/bash
# Direct deployment script using SSH/rsync
# This replaces the .cpanel.yml approach

set -e

echo "🚀 Starting deployment to augustai.com..."

# Configuration
SERVER_USER="augustcom92b"
SERVER_HOST="augustai.com"  # or your server IP
REMOTE_PATH="/home/augustcom92b/public_html"
LOCAL_PATH="."

# Exclude files that shouldn't be deployed
EXCLUDE_FILES=(
    ".git"
    ".gitignore" 
    "_archive"
    "_builds"
    "_docs"
    "ssh_key.txt"
    "id_rsa.pub"
    "*.md"
    "build.sh"
    "deploy.sh"
)

# Build exclude arguments for rsync
EXCLUDE_ARGS=""
for file in "${EXCLUDE_FILES[@]}"; do
    EXCLUDE_ARGS="$EXCLUDE_ARGS --exclude=$file"
done

echo "📁 Deploying files..."
rsync -avz --delete $EXCLUDE_ARGS $LOCAL_PATH/ $SERVER_USER@$SERVER_HOST:$REMOTE_PATH/

echo "✅ Deployment complete!"
echo "🌐 Visit https://augustai.com to verify"
