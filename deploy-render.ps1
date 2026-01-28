# PowerShell script untuk deploy ke Render
param(
    [string]$RenderApiKey = "",
    [string]$ServiceId = ""
)

Write-Host "🚀 Deploying to Render..." -ForegroundColor Green

if (-not $RenderApiKey) {
    $RenderApiKey = Read-Host "Enter your Render API Key"
}

if (-not $ServiceId) {
    $ServiceId = Read-Host "Enter your Render Service ID (optional for new service)"
}

# Headers for Render API
$headers = @{
    "Authorization" = "Bearer $RenderApiKey"
    "Content-Type" = "application/json"
}

# Create new service if ServiceId is not provided
if (-not $ServiceId) {
    Write-Host "📝 Creating new Render service..." -ForegroundColor Yellow
    
    $serviceData = @{
        type = "web_service"
        name = "edufikri-smk-system"
        repo = "https://github.com/hafidzubaidillah/edufikri-smk-system"
        branch = "main"
        buildCommand = "./build.sh"
        startCommand = "./start.sh"
        plan = "free"
        env = "php"
        envVars = @(
            @{ key = "APP_NAME"; value = "SMK IT Ihsanul Fikri - Mungkid Magelang" }
            @{ key = "APP_ENV"; value = "production" }
            @{ key = "APP_DEBUG"; value = "false" }
            @{ key = "APP_KEY"; value = "base64:juQp72jOkqQ13Su+Dt02QPSIcj18elMVpqk+xxC4bEs=" }
        )
    } | ConvertTo-Json -Depth 3
    
    try {
        $response = Invoke-RestMethod -Uri "https://api.render.com/v1/services" -Method POST -Headers $headers -Body $serviceData
        $ServiceId = $response.service.id
        Write-Host "✅ Service created with ID: $ServiceId" -ForegroundColor Green
    }
    catch {
        Write-Host "❌ Failed to create service: $($_.Exception.Message)" -ForegroundColor Red
        exit 1
    }
}

# Trigger deployment
Write-Host "🔄 Triggering deployment..." -ForegroundColor Yellow

try {
    $deployData = @{
        clearCache = "clear"
    } | ConvertTo-Json
    
    $response = Invoke-RestMethod -Uri "https://api.render.com/v1/services/$ServiceId/deploys" -Method POST -Headers $headers -Body $deployData
    
    Write-Host "✅ Deployment triggered successfully!" -ForegroundColor Green
    Write-Host "📊 Deploy ID: $($response.deploy.id)" -ForegroundColor Cyan
    Write-Host "🌐 Service URL: https://$($response.deploy.service.name).onrender.com" -ForegroundColor Cyan
    
    # Monitor deployment status
    Write-Host "⏳ Monitoring deployment status..." -ForegroundColor Yellow
    
    do {
        Start-Sleep -Seconds 10
        $status = Invoke-RestMethod -Uri "https://api.render.com/v1/services/$ServiceId/deploys/$($response.deploy.id)" -Headers $headers
        Write-Host "Status: $($status.deploy.status)" -ForegroundColor Cyan
    } while ($status.deploy.status -eq "build_in_progress" -or $status.deploy.status -eq "update_in_progress")
    
    if ($status.deploy.status -eq "live") {
        Write-Host "🎉 Deployment completed successfully!" -ForegroundColor Green
        Write-Host "🌐 Your app is live at: https://$($status.deploy.service.name).onrender.com" -ForegroundColor Green
        Write-Host "🔑 Admin login: admin@smkitihsanulfikri.sch.id / admin123" -ForegroundColor Yellow
    } else {
        Write-Host "❌ Deployment failed with status: $($status.deploy.status)" -ForegroundColor Red
    }
}
catch {
    Write-Host "❌ Deployment failed: $($_.Exception.Message)" -ForegroundColor Red
    exit 1
}

Write-Host "✅ Render deployment process completed!" -ForegroundColor Green