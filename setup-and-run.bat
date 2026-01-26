@echo off
title SMK IT Ihsanul Fikri - Complete Setup
color 0A

echo ========================================
echo   SMK IT Ihsanul Fikri - Complete Setup
echo ========================================
echo.

REM Check if ngrok exists (global or local)
set "ngrok_cmd=ngrok"
where ngrok >nul 2>nul
if %errorlevel% neq 0 (
    if exist "ngrok\ngrok.exe" (
        set "ngrok_cmd=ngrok\ngrok.exe"
        echo ✓ Using local ngrok installation
    ) else (
        echo [SETUP] Ngrok not found. Let's set it up...
        echo.
        echo Please choose:
        echo 1. Run setup-ngrok.bat (if you have the ZIP file)
        echo 2. Download from https://ngrok.com/download
        echo 3. Continue without ngrok (local only)
        echo.
        set /p choice="Enter choice (1-3): "
        
        if "%choice%"=="1" (
            call setup-ngrok.bat
            if exist "ngrok\ngrok.exe" set "ngrok_cmd=ngrok\ngrok.exe"
        )
        
        if "%choice%"=="2" (
            echo Opening ngrok download page...
            start https://ngrok.com/download
            echo.
            echo After downloading, run: setup-ngrok.bat
            pause
            exit /b 0
        )
        
        if "%choice%"=="3" (
            set "ngrok_cmd="
            echo Continuing without ngrok...
        )
    )
) else (
    echo ✓ Using system ngrok installation
)

echo.
echo [1/4] Installing/Updating Composer dependencies...
composer install --optimize-autoloader

echo [2/4] Setting up Laravel...
php artisan key:generate --force
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo [3/4] Running database migrations...
php artisan migrate --force

echo [4/4] Starting services...
echo.
echo Starting Laravel server...
start "Laravel Server" cmd /k "title Laravel Server - SMK IT Ihsanul Fikri && color 0B && echo Laravel Server Running on http://localhost:8000 && echo. && php artisan serve"

timeout /t 5 /nobreak

if not "%ngrok_cmd%"=="" (
    echo Starting ngrok tunnel...
    start "Ngrok Tunnel" cmd /k "title Ngrok Public Tunnel && color 0E && echo Creating public tunnel... && echo. && %ngrok_cmd% http 8000"
) else (
    echo Ngrok not available. Running in local mode only.
)

echo.
echo ========================================
echo   SETUP COMPLETE!
echo ========================================
echo.
echo Local Access: http://localhost:8000
echo Public Access: Check ngrok window (if available)
echo.
echo Default Login:
echo Email: admin@smk.com
echo Password: password
echo.
timeout /t 3 /nobreak
start http://localhost:8000