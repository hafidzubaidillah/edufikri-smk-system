@echo off
title SMK IT Ihsanul Fikri - Complete Auto Setup
color 0A

echo ========================================
echo   SMK IT Ihsanul Fikri - Auto Setup
echo ========================================
echo.

echo [1/6] Checking ngrok file...
set "ngrok_zip="

REM Check current directory first
for %%f in (ngrok*.zip) do set "ngrok_zip=%%f"

REM If not found, check Downloads and copy
if "%ngrok_zip%"=="" (
    echo Looking in Downloads folder...
    for %%f in ("C:\Users\kxkl_\Downloads\ngrok*.zip") do (
        if exist "%%f" (
            echo ✓ Found: %%~nxf
            echo Copying to project folder...
            copy "%%f" "." >nul 2>nul
            if exist "%%~nxf" (
                set "ngrok_zip=%%~nxf"
                echo ✓ Copied successfully!
            )
        )
    )
)

if "%ngrok_zip%"=="" (
    echo ⚠ Ngrok not found. Will setup without public access.
    set "skip_ngrok=1"
) else (
    echo ✓ Ngrok file ready: %ngrok_zip%
    set "skip_ngrok=0"
)

echo.
echo [2/6] Setting up Laravel dependencies...
composer install --optimize-autoloader --no-dev
if %errorlevel% neq 0 (
    echo ⚠ Composer install failed. Continuing anyway...
)

echo.
echo [3/6] Configuring Laravel...
php artisan key:generate --force
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan migrate --force

echo.
echo [4/6] Setting up ngrok (if available)...
if "%skip_ngrok%"=="0" (
    if not exist "ngrok" mkdir ngrok
    echo Extracting ngrok...
    powershell -command "Expand-Archive -Path '%ngrok_zip%' -DestinationPath 'ngrok' -Force" 2>nul
    
    if exist "ngrok\ngrok.exe" (
        echo ✓ Ngrok extracted successfully!
        
        echo.
        echo ========================================
        echo   Ngrok Authentication Setup
        echo ========================================
        echo.
        echo For public access, you need an authtoken from ngrok.com
        echo 1. Go to: https://dashboard.ngrok.com/get-started/your-authtoken
        echo 2. Sign up for FREE account
        echo 3. Copy your authtoken
        echo.
        
        set /p "setup_auth=Setup authtoken now? (y/n): "
        if /i "%setup_auth%"=="y" (
            start https://dashboard.ngrok.com/get-started/your-authtoken
            echo.
            set /p "authtoken=Paste your authtoken here: "
            if not "!authtoken!"=="" (
                ngrok\ngrok.exe config add-authtoken !authtoken!
                echo ✓ Authtoken configured!
            )
        )
    ) else (
        echo ✗ Failed to extract ngrok
        set "skip_ngrok=1"
    )
) else (
    echo Skipping ngrok setup (file not found)
)

echo.
echo [5/6] Starting Laravel server...
start "Laravel Server - SMK IT Ihsanul Fikri" cmd /k "title Laravel Server && color 0B && echo ✓ Laravel Server Running && echo Local URL: http://localhost:8000 && echo. && php artisan serve"

echo Waiting for Laravel to start...
timeout /t 5 /nobreak

echo.
echo [6/6] Starting ngrok tunnel (if available)...
if "%skip_ngrok%"=="0" if exist "ngrok\ngrok.exe" (
    start "Ngrok Public Tunnel" cmd /k "title Ngrok Tunnel && color 0E && echo ✓ Creating public tunnel... && echo Check below for your public URL: && echo. && ngrok\ngrok.exe http 8000"
    echo ✓ Ngrok tunnel starting...
) else (
    echo Ngrok not available - running in local mode only
)

echo.
echo ========================================
echo   🚀 SETUP COMPLETE! 🚀
echo ========================================
echo.
echo ✅ Laravel Server: http://localhost:8000
if "%skip_ngrok%"=="0" if exist "ngrok\ngrok.exe" (
    echo ✅ Public URL: Check ngrok window
) else (
    echo ⚠ Public access: Not available (ngrok not setup)
)
echo.
echo 📚 Default Login Credentials:
echo    Email: admin@smk.com
echo    Password: password
echo.
echo 🎯 Next Steps:
echo    1. Check both windows that opened
echo    2. Use the public URL to share with others
echo    3. Login with credentials above
echo.

timeout /t 3 /nobreak
start http://localhost:8000

echo Press any key to exit this setup window...
pause >nul