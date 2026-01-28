# Setup Vercel Postgres Database

Follow these steps to setup Vercel Postgres for your Laravel application:

## Step 1: Create Vercel Postgres Database

1. Go to your Vercel dashboard: https://vercel.com/dashboard
2. Select your project: `edufikri-smk-system`
3. Go to **Storage** tab
4. Click **Create Database**
5. Select **Postgres**
6. Choose a database name (e.g., `edufikri-db`)
7. Select region closest to your users (e.g., `Singapore` for Indonesia)
8. Click **Create**

## Step 2: Connect Database to Project

Vercel will automatically add these environment variables to your project:
- `POSTGRES_URL`
- `POSTGRES_PRISMA_URL`
- `POSTGRES_URL_NON_POOLING`
- `POSTGRES_USER`
- `POSTGRES_HOST`
- `POSTGRES_PASSWORD`
- `POSTGRES_DATABASE`

## Step 3: Add Laravel Environment Variables

Go to **Settings** → **Environment Variables** and add:

```
APP_NAME=SMK IT Ihsanul Fikri - Mungkid Magelang
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:juQp72jOkqQ13Su+Dt02QPSIcj18elMVpqk+xxC4bEs=
SESSION_DRIVER=cookie
CACHE_STORE=array
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
LOG_LEVEL=error
MAIL_MAILER=log
```

**Important:** Do NOT set `DB_CONNECTION`, `DB_HOST`, etc. manually. The code will automatically detect and use Vercel Postgres via `POSTGRES_URL`.

## Step 4: Redeploy

1. Go to **Deployments** tab
2. Click on the latest deployment
3. Click **⋯** (three dots) → **Redeploy**
4. Wait for deployment to complete

## Step 5: Run Migrations

After deployment completes:

1. Visit: `https://your-app.vercel.app/migrate`
2. This will:
   - Run all database migrations
   - Create an admin user
   - Setup initial database structure

**Default Admin Credentials:**
- Email: `admin@smkitihsanulfikri.sch.id`
- Password: `admin123`

⚠️ **IMPORTANT:** Change the admin password immediately after first login!

## Step 6: Verify Installation

1. Visit: `https://your-app.vercel.app/debug`
2. Check that:
   - ✓ Vercel Postgres is detected
   - ✓ Database connection successful
   - ✓ Users table accessible

## Troubleshooting

### Error: "Database connection failed"
- Check that Vercel Postgres is properly connected to your project
- Verify environment variables are set correctly
- Check Vercel function logs for detailed error messages

### Error: "Table not found"
- Run `/migrate` endpoint to create database tables

### Error: "SQLSTATE[08006]"
- Database connection timeout
- Try redeploying the application
- Check Vercel Postgres status

## Database Management

To manage your database:
1. Go to Vercel dashboard → Storage → Your database
2. Click **Data** to browse tables
3. Click **Query** to run SQL queries
4. Click **Settings** for database configuration

## Migration from SQLite

If you have existing data in SQLite locally:

1. Export data from local database:
   ```bash
   php artisan db:seed --class=YourSeeder
   ```

2. Or manually export/import data using SQL dumps

3. For production, always use Vercel Postgres (persistent storage)
