@echo off
echo Setting up Neon PostgreSQL for Vercel deployment...
echo.

echo Please enter your Neon database connection details:
echo (You can find these in your Neon dashboard by clicking 'Connect')
echo.

set /p DB_HOST="Database Host (e.g., ep-xxx-xxx.us-east-1.aws.neon.tech): "
set /p DB_DATABASE="Database Name: "
set /p DB_USERNAME="Username: "
set /p DB_PASSWORD="Password: "

echo.
echo Setting Vercel environment variables...

vercel env add DB_CONNECTION production
echo pgsql

vercel env add DB_HOST production
echo %DB_HOST%

vercel env add DB_PORT production
echo 5432

vercel env add DB_DATABASE production
echo %DB_DATABASE%

vercel env add DB_USERNAME production
echo %DB_USERNAME%

vercel env add DB_PASSWORD production
echo %DB_PASSWORD%

echo.
echo Environment variables set! Now deploying to Vercel...
vercel --prod

echo.
echo Setup complete! Your Laravel app should now be using Neon PostgreSQL.
echo Admin login: admin@smkitihsanulfikri.sch.id / admin123
pause