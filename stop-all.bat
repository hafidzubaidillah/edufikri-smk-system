@echo off
title Stop All Services
color 0C

echo ========================================
echo   Stopping All Services
echo ========================================
echo.

echo Stopping Laravel server...
taskkill /f /im php.exe 2>nul
if %errorlevel% equ 0 (
    echo ✓ Laravel server stopped
) else (
    echo ✗ No Laravel server found
)

echo Stopping ngrok tunnel...
taskkill /f /im ngrok.exe 2>nul
if %errorlevel% equ 0 (
    echo ✓ Ngrok tunnel stopped
) else (
    echo ✗ No ngrok tunnel found
)

echo.
echo All services stopped!
timeout /t 3