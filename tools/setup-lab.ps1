# CMSForNerd v3.4 - Student Onboarding Script (Windows)
Write-Host "🧪 Starting CMSForNerd Laboratory Setup..." -ForegroundColor Cyan

# 1. Check PHP Version
$phpVersion = php -r "echo PHP_VERSION_ID;"
if ([int]$phpVersion -lt 80400) {
    Write-Host "❌ [ERROR] PHP 8.4+ is required. Current: $(php -v)" -ForegroundColor Red
    exit
}
Write-Host "✅ PHP 8.4+ detected." -ForegroundColor Green

# 2. Check for Composer
$composerCheck = Get-Command composer -ErrorAction SilentlyContinue
if (!$composerCheck) {
    Write-Host "❌ [ERROR] Composer not found. Install it from getcomposer.org" -ForegroundColor Red
    exit
}

# 3. Install Dependencies
Write-Host "📦 Installing Nerd-Stack dependencies..." -ForegroundColor Yellow
composer install

# 4. Verify Laboratory Readiness
Write-Host "🚀 Running Laboratory Compliance Check..." -ForegroundColor Yellow
composer lab-check

Write-Host "------------------------------------------------" -ForegroundColor Cyan
Write-Host "🎉 Setup Complete! Your Laboratory is ready." -ForegroundColor Green
Write-Host "Run 'composer analyze' to perform a Zero-Debt audit."
