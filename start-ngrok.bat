@echo off
title SMK IT Ihsanul Fikri - Auto Deploy
color 0A

echo ========================================
echo   SMK IT Ihsanul Fikri - Auto Deploy
echo ========================================
echo.

echo [1/4] Checking Laravel installation...
if not exist "artisan" (
    echo ERROR: Laravel not found! Make sure you're in the right directory.
    pause
    exit /b 1
)

echo [2/4] Starting Laravel server...
start "Laravel Server" cmd /k "title Laravel Server && color 0B && php artisan serve"

echo [3/4] Waiting for server to start...
timeout /t 5 /nobreak

echo [4/4] Starting ngrok tunnel...
echo.
echo IMPORTANT: Make sure you have:
echo 1. Downloaded ngrok from https://ngrok.com/download
echo 2. Set your authtoken: ngrok config add-authtoken YOUR_TOKEN
echo.
echo Starting ngrok in 3 seconds...
timeout /t 3 /nobreak

start "Ngrok Tunnel" cmd /k "title Ngrok Tunnel && color 0E && ngrok http 8000"

echo.
echo ========================================
echo   SUCCESS! Both services are starting
echo ========================================
echo.
echo Laravel Server: http://localhost:8000
echo Ngrok Tunnel: Check the ngrok window for public URL
echo.
echo Press any key to open Laravel in browser...
pause >nul
start http://localhost:8000