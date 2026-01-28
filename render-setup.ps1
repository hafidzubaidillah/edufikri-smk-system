# Helper script untuk setup Render deployment
Write-Host "Render Deployment Helper" -ForegroundColor Green
Write-Host "================================" -ForegroundColor Green

Write-Host ""
Write-Host "Pre-deployment Checklist:" -ForegroundColor Yellow
Write-Host "Repository pushed to GitHub" -ForegroundColor Green
Write-Host "render.yaml configured" -ForegroundColor Green
Write-Host "build.sh and start.sh created" -ForegroundColor Green
Write-Host "ProductionSeeder ready" -ForegroundColor Green

Write-Host ""
Write-Host "Next Steps:" -ForegroundColor Cyan
Write-Host "1. Open: https://render.com" -ForegroundColor White
Write-Host "2. Sign up/Login with GitHub" -ForegroundColor White
Write-Host "3. Click 'New' -> 'Web Service'" -ForegroundColor White
Write-Host "4. Connect repository: edufikri-smk-system" -ForegroundColor White
Write-Host "5. Branch: main" -ForegroundColor White
Write-Host "6. Render will auto-detect configuration from render.yaml" -ForegroundColor White

Write-Host ""
Write-Host "Configuration (Auto-detected):" -ForegroundColor Cyan
Write-Host "Name: edufikri-smk-system" -ForegroundColor White
Write-Host "Environment: PHP" -ForegroundColor White
Write-Host "Build Command: ./build.sh" -ForegroundColor White
Write-Host "Start Command: ./start.sh" -ForegroundColor White
Write-Host "Plan: Free" -ForegroundColor White
Write-Host "Database: PostgreSQL (auto-created)" -ForegroundColor White

Write-Host ""
Write-Host "After Deployment:" -ForegroundColor Cyan
Write-Host "URL: https://edufikri-smk-system.onrender.com" -ForegroundColor White
Write-Host "Admin Email: admin@smkitihsanulfikri.sch.id" -ForegroundColor White
Write-Host "Admin Password: admin123" -ForegroundColor White

Write-Host ""
Write-Host "Estimated Time: 10-15 minutes" -ForegroundColor Yellow

Write-Host ""
$openBrowser = Read-Host "Open Render dashboard now? (y/n)"
if ($openBrowser -eq "y" -or $openBrowser -eq "Y") {
    Start-Process "https://render.com"
    Write-Host "Opening Render dashboard..." -ForegroundColor Green
}

Write-Host ""
Write-Host "Monitor deployment progress in Render dashboard" -ForegroundColor Cyan
Write-Host "Setup helper completed!" -ForegroundColor Green