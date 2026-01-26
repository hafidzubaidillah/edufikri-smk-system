@echo off
title Quick Setup - SMK IT Ihsanul Fikri
color 0C

echo ========================================
echo   Quick Setup - SMK IT Ihsanul Fikri  
echo ========================================
echo.

echo [1/3] Setting up ngrok...
call setup-ngrok.bat

echo.
echo [2/3] Setting up Laravel...
composer install --optimize-autoloader
php artisan migrate --force

echo.
echo [3/3] Starting everything...
call setup-and-run.bat