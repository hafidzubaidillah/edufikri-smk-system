# Deploy Laravel ke Vercel - Manual Steps

## Langkah 1: Login ke Vercel
1. Buka https://vercel.com/
2. Login dengan GitHub account
3. Klik "New Project"

## Langkah 2: Import dari GitHub
1. Pilih repository: `hafidzubaidillah/edufikri-smk-system`
2. Klik "Import"

## Langkah 3: Configure Project
- **Framework Preset**: Other
- **Root Directory**: ./
- **Build Command**: (kosongkan)
- **Output Directory**: (kosongkan)
- **Install Command**: `composer install --no-dev --optimize-autoloader`

## Langkah 4: Environment Variables
Tambahkan environment variables berikut di Vercel dashboard:

```
APP_NAME=SMK IT Ihsanul Fikri - Mungkid Magelang
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:juQp72jOkqQ13Su+Dt02QPSIcj18elMVpqk+xxC4bEs=
APP_URL=https://your-project-name.vercel.app
DB_CONNECTION=sqlite
SESSION_DRIVER=cookie
CACHE_STORE=array
QUEUE_CONNECTION=sync
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=hapisubed@gmail.com
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hapisubed@gmail.com
MAIL_FROM_NAME=SMK IT Ihsanul Fikri
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

## Langkah 5: Deploy
1. Klik "Deploy"
2. Tunggu proses deployment selesai
3. Test aplikasi di URL yang diberikan

## Troubleshooting
Jika ada error, check:
1. Function logs di Vercel dashboard
2. Pastikan semua environment variables sudah benar
3. Check vercel.json configuration