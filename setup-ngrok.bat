@echo off
title Setup Ngrok - SMK IT Ihsanul Fikri
color 0A

echo ========================================
echo   Setup Ngrok - SMK IT Ihsanul Fikri
echo ========================================
echo.

REM Check if ngrok already exists
where ngrok >nul 2>nul
if %errorlevel% equ 0 (
    echo ✓ Ngrok already installed and in PATH!
    ngrok version
    goto :setup_auth
)

echo [1/5] Looking for ngrok ZIP file...
set "ngrok_zip="

REM First check current directory
for %%f in (ngrok*.zip) do set "ngrok_zip=%%f"

REM If not found, check Downloads folder
if "%ngrok_zip%"=="" (
    echo Checking Downloads folder...
    for %%f in ("C:\Users\kxkl_\Downloads\ngrok*.zip") do (
        if exist "%%f" (
            echo ✓ Found ngrok in Downloads: %%~nxf
            echo Copying to project folder...
            copy "%%f" "." >nul
            set "ngrok_zip=%%~nxf"
        )
    )
)

if "%ngrok_zip%"=="" (
    echo ✗ Ngrok ZIP file not found.
    echo.
    echo Searched in:
    echo - Current directory: %CD%
    echo - Downloads: C:\Users\kxkl_\Downloads\
    echo.
    echo Please download ngrok from https://ngrok.com/download
    pause
    exit /b 1
)

echo ✓ Using: %ngrok_zip%

echo [2/5] Extracting ngrok...
if not exist "ngrok" mkdir ngrok
powershell -command "Expand-Archive -Path '%ngrok_zip%' -DestinationPath 'ngrok' -Force"

if exist "ngrok\ngrok.exe" (
    echo ✓ Ngrok extracted successfully!
) else (
    echo ✗ Failed to extract ngrok. Please extract manually.
    pause
    exit /b 1
)

echo [3/5] Adding ngrok to PATH for this session...
set "PATH=%CD%\ngrok;%PATH%"

echo [4/5] Testing ngrok installation...
ngrok\ngrok.exe version
if %errorlevel% equ 0 (
    echo ✓ Ngrok is working!
) else (
    echo ✗ Ngrok test failed.
    pause
    exit /b 1
)

:setup_auth
echo.
echo ========================================
echo   Setup Ngrok Authentication
echo ========================================
echo.
echo To get your authtoken:
echo 1. Go to https://dashboard.ngrok.com/get-started/your-authtoken
echo 2. Sign up for free account (if needed)
echo 3. Copy your authtoken
echo.
set /p "authtoken=Paste your authtoken here (or press Enter to skip): "

if not "%authtoken%"=="" (
    echo Setting up authtoken...
    if exist "ngrok\ngrok.exe" (
        ngrok\ngrok.exe config add-authtoken %authtoken%
    ) else (
        ngrok config add-authtoken %authtoken%
    )
    
    if %errorlevel% equ 0 (
        echo ✓ Authtoken configured successfully!
    ) else (
        echo ✗ Failed to set authtoken. You can set it later.
    )
) else (
    echo Skipping authtoken setup. You can set it later with:
    echo ngrok config add-authtoken YOUR_TOKEN
)

echo.
echo ========================================
echo   Setup Complete!
echo ========================================
echo.
echo Ngrok is ready to use!
echo You can now run: setup-and-run.bat
echo.
pause