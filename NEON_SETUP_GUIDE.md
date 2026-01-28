# Neon PostgreSQL Setup Guide for Laravel on Vercel

## Step 1: Create Neon Account and Database

1. Go to [https://neon.tech](https://neon.tech) and sign up for a free account
2. Create a new project:
   - Click "New Project"
   - Choose a name like "edufikri-smk-system"
   - Select region closest to your users (e.g., US East for better Vercel integration)
   - Click "Create Project"

## Step 2: Get Connection Details

1. In your Neon dashboard, click the "Connect" button
2. Select "Laravel" from the framework dropdown
3. Copy the connection details - you'll need:
   - Host (something like `ep-xxx-xxx.us-east-1.aws.neon.tech`)
   - Database name
   - Username
   - Password
   - Port (5432)

## Step 3: Update Vercel Environment Variables

Run these commands to set your database environment variables:

```bash
# Replace with your actual Neon connection details
vercel env add DB_CONNECTION production
# Enter: pgsql

vercel env add DB_HOST production
# Enter: your-neon-hostname.us-east-1.aws.neon.tech

vercel env add DB_PORT production
# Enter: 5432

vercel env add DB_DATABASE production
# Enter: your-database-name

vercel env add DB_USERNAME production
# Enter: your-username

vercel env add DB_PASSWORD production
# Enter: your-password
```

## Step 4: Deploy and Run Migrations

After setting up the environment variables, the application will automatically:
1. Connect to your Neon database
2. Run migrations on first access
3. Create the admin user

## Admin Login Credentials

- Email: `admin@smkitihsanulfikri.sch.id`
- Password: `admin123`

## Troubleshooting

If you get "endpoint ID not specified" error, add this to your password:
```
endpoint=ep-your-endpoint-id;your-actual-password
```

The endpoint ID is the first part of your hostname (before the first dot).