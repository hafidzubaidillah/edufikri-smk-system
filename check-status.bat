@echo off
title Service Status Check
color 0B

echo ========================================
echo   SMK IT Ihsanul Fikri - Service Status
echo ========================================
echo.

echo Checking Laravel server...
tasklist /fi "imagename eq php.exe" 2>nul | find /i "php.exe" >nul
if %errorlevel% equ 0 (
    echo ✓ Laravel server is RUNNING
    echo   URL: http://localhost:8000
) else (
    echo ✗ Laravel server is STOPPED
)

echo.
echo Checking ngrok tunnel...
tasklist /fi "imagename eq ngrok.exe" 2>nul | find /i "ngrok.exe" >nul
if %errorlevel% equ 0 (
    echo ✓ Ngrok tunnel is RUNNING
    echo   Check ngrok window for public URL
) else (
    echo ✗ Ngrok tunnel is STOPPED
)

echo.
echo Checking network connectivity...
ping -n 1 localhost >nul 2>nul
if %errorlevel% equ 0 (
    echo ✓ Network is OK
) else (
    echo ✗ Network issue detected
)

echo.
echo ========================================
pause