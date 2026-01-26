@echo off
echo ========================================
echo   SMK IT Ihsanul Fikri - Public URLs
echo ========================================
echo.

echo Checking ngrok status...
curl -s http://127.0.0.1:4040/api/tunnels | findstr "public_url"

echo.
echo ========================================
echo   Access Information
echo ========================================
echo.
echo 🌐 Local Access:
echo    http://127.0.0.1:8000
echo.
echo 🌍 Public Access:
echo    Check above for https://... URLs
echo.
echo 🔑 Login Credentials:
echo    Admin: admin@edufikri.com / admin123
echo    Guru:  guru@edufikri.com / guru123
echo    Siswa: siswa@edufikri.com / siswa123
echo.
pause