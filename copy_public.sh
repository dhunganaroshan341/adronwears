#!/bin/bash

echo "⚠️  WARNING: This script is intended for production use only!"
echo "It will copy files from ./public to ../public_html."
echo "Ensure you're running this in the production server SSH session."
read -p "❓ Are you sure you want to continue? (yes/no): " confirm

if [[ "$confirm" != "yes" ]]; then
    echo "❌ Operation cancelled."
    exit 1
fi

# Check if public_html exists before proceeding
if [ ! -d "../public_html" ]; then
    echo "❌ Error: ../public_html directory not found!"
    echo "Make sure you're running this on the server where public_html exists."
    exit 1
fi

# Proceed to copy
rsync -av \
  --exclude='index.php' \
  --exclude='.htaccess' \
  --exclude='robots.txt' \
  --exclude='favicon.ico' \
  --exclude='storage/' \
  ./public/ ../public_html/

echo "✅ Public assets copied successfully!"
