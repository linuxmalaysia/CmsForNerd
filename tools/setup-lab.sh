#!/bin/bash

# CMSForNerd v3.4 - Student Onboarding Script (Linux/macOS)
echo "🧪 Starting CMSForNerd Laboratory Setup..."

# 1. Check PHP Version
PHP_VER=$(php -r 'echo PHP_VERSION_ID;')
if [ "$PHP_VER" -lt 80400 ]; then
    echo "❌ [ERROR] PHP 8.4+ is required. Found: $(php -v | head -n 1)"
    exit 1
fi
echo "✅ PHP 8.4+ detected."

# 2. Check for Composer
if ! command -v composer &> /dev/null; then
    echo "❌ [ERROR] Composer not found. Please install it from getcomposer.org"
    exit 1
fi

# 3. Install Dependencies
echo "📦 Installing Nerd-Stack dependencies..."
composer install

# 4. Verify Laboratory Readiness
echo "🚀 Running Laboratory Compliance Check..."
composer lab-check

echo "------------------------------------------------"
echo "🎉 Setup Complete! Your Laboratory is ready."
echo "Run 'composer analyze' anytime to check your code."
