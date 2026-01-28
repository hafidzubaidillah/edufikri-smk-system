@echo off
REM Script to add all required environment variables to Vercel

echo Adding Laravel environment variables to Vercel...
echo.

REM Add APP_ENV
echo [1/9] Adding APP_ENV...
echo production | vercel env add APP_ENV production

REM Add APP_DEBUG
echo [2/9] Adding APP_DEBUG...
echo false | vercel env add APP_DEBUG production

REM Add APP_KEY
echo [3/9] Adding APP_KEY...
echo base64:juQp72jOkqQ13Su+Dt02QPSIcj18elMVpqk+xxC4bEs= | vercel env add APP_KEY production

REM Add SESSION_DRIVER
echo [4/9] Adding SESSION_DRIVER...
echo cookie | vercel env add SESSION_DRIVER production

REM Add CACHE_STORE
echo [5/9] Adding CACHE_STORE...
echo array | vercel env add CACHE_STORE production

REM Add QUEUE_CONNECTION
echo [6/9] Adding QUEUE_CONNECTION...
echo sync | vercel env add QUEUE_CONNECTION production

REM Add LOG_CHANNEL
echo [7/9] Adding LOG_CHANNEL...
echo stderr | vercel env add LOG_CHANNEL production

REM Add LOG_LEVEL
echo [8/9] Adding LOG_LEVEL...
echo error | vercel env add LOG_LEVEL production

REM Add MAIL_MAILER
echo [9/9] Adding MAIL_MAILER...
echo log | vercel env add MAIL_MAILER production

echo.
echo ✓ All environment variables added successfully!
echo.
echo Next steps:
echo 1. Create Postgres database: vercel postgres create
echo 2. Redeploy: vercel --prod
echo 3. Run migrations: visit /migrate endpoint
echo.
pause
