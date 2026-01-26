# SMK IT Ihsanul Fikri - Auto Deploy Script
# PowerShell version with better error handling

Write-Host "========================================" -ForegroundColor Green
Write-Host "   SMK IT Ihsanul Fikri - Auto Deploy" -ForegroundColor Green  
Write-Host "========================================" -ForegroundColor Green
Write-Host ""

# Check if Laravel exists
if (!(Test-Path "artisan")) {
    Write-Host "ERROR: Laravel not found! Make sure you're in the project directory." -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

# Check if ngrok is installed
$ngrokPath = Get-Command ngrok -ErrorAction SilentlyContinue
if (!$ngrokPath) {
    Write-Host "WARNING: ngrok not found in PATH" -ForegroundColor Yellow
    Write-Host "Please download from: https://ngrok.com/download" -ForegroundColor Yellow
    Write-Host ""
}

Write-Host "[1/5] Clearing Laravel cache..." -ForegroundColor Cyan
php artisan config:clear
php artisan route:clear
php artisan view:clear

Write-Host "[2/5] Starting Laravel server..." -ForegroundColor Cyan
Start-Process powershell -ArgumentList "-NoExit", "-Command", "php artisan serve; Read-Host 'Laravel server stopped. Press Enter to close'"

Write-Host "[3/5] Waiting for server to initialize..." -ForegroundColor Cyan
Start-Sleep -Seconds 5

# Test if Laravel is running
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8000" -TimeoutSec 5 -ErrorAction Stop
    Write-Host "✓ Laravel server is running!" -ForegroundColor Green
} catch {
    Write-Host "⚠ Laravel server might not be ready yet" -ForegroundColor Yellow
}

Write-Host "[4/5] Starting ngrok tunnel..." -ForegroundColor Cyan
if ($ngrokPath) {
    Start-Process powershell -ArgumentList "-NoExit", "-Command", "ngrok http 8000; Read-Host 'Ngrok stopped. Press Enter to close'"
    Write-Host "✓ Ngrok tunnel started!" -ForegroundColor Green
} else {
    Write-Host "✗ Ngrok not found. Please install ngrok first." -ForegroundColor Red
}

Write-Host "[5/5] Opening browser..." -ForegroundColor Cyan
Start-Sleep -Seconds 2
Start-Process "http://localhost:8000"

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "   DEPLOYMENT COMPLETE!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "Local URL:  http://localhost:8000" -ForegroundColor White
Write-Host "Public URL: Check ngrok window" -ForegroundColor White
Write-Host ""
Write-Host "Press any key to exit this script..." -ForegroundColor Gray
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")