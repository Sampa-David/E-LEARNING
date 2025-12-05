# E-Learning Platform - Railway Deployment Guide

## 📋 Prerequisites
- Railway account: https://railway.app
- GitHub repository with your Laravel project pushed
- PostgreSQL plugin enabled on Railway
- Git installed locally

## 🚀 Step-by-Step Deployment

### Step 1: Push Code to GitHub
```bash
cd s:\php(Laravel)\Learning
git add .
git commit -m "Prepare for Railway deployment"
git push origin main
```

### Step 2: Create Railway Project
1. Go to https://railway.app and sign in
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Connect your GitHub account
5. Select the E-Learning repository
6. Railway will automatically create a new project

### Step 3: Add PostgreSQL Database
1. In your Railway project, click "+ Add"
2. Search for "PostgreSQL"
3. Click "PostgreSQL"
4. Railway will create a database instance
5. Note the connection details (will be provided as DATABASE_URL)

### Step 4: Configure Environment Variables
1. Go to your Railway project dashboard
2. Click on the Web Service (your app)
3. Go to "Variables" tab
4. Add the following variables:

```
APP_NAME=E-Learning
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APPLICATION_KEY_HERE
APP_URL=https://<your-railway-domain>.railway.app

DB_CONNECTION=pgsql
DB_HOST=${{ Postgres.PGHOST }}
DB_PORT=${{ Postgres.PGPORT }}
DB_DATABASE=${{ Postgres.PGDATABASE }}
DB_USERNAME=${{ Postgres.PGUSER }}
DB_PASSWORD=${{ Postgres.PGPASSWORD }}

SESSION_DRIVER=cookie
SESSION_LIFETIME=120
SESSION_ENCRYPT=true

CACHE_STORE=file
LOG_CHANNEL=stack
LOG_LEVEL=info

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@elearning.app
```

### Step 5: Generate Application Key
```bash
# Generate locally first
php artisan key:generate

# Copy the APP_KEY value and add it to Railway Variables
# Format should be: base64:xxxxxxxxxxx
```

### Step 6: Set Start Command in Railway
1. In Railway dashboard, go to Deployment tab
2. Look for "Start Command"
3. Set it to:
```
vendor/bin/heroku-php-apache2 public/
```

Or alternatively:
```
php artisan serve --host=0.0.0.0 --port=${PORT}
```

### Step 7: Configure Database Connection
1. In Railway, click on the PostgreSQL instance
2. Copy the DATABASE_URL
3. Add to your app variables (can use the reference syntax above)

### Step 8: Deploy
1. Railway will automatically detect changes and deploy
2. Watch the build logs in the Deployments tab
3. Wait for deployment to complete

### Step 9: Run Migrations
After deployment completes, you need to run migrations:

**Option A: Via Railway Console**
1. In Railway dashboard, go to "Deployments"
2. Click on the latest deployment
3. Open "Runtime Logs" or "Build Logs"
4. You should see migration output

**Option B: Manually via SSH/Console**
```bash
php artisan migrate --force
php artisan db:seed --force
```

### Step 10: Verify Deployment
1. Visit your Railway app URL
2. Test login with admin credentials:
   - Email: admin@elearning.com
   - Password: password

## 🔧 Troubleshooting

### Issue: "Class Not Found" or "File Not Found"
```bash
# Regenerate class maps
php artisan optimize
php artisan config:cache
```

### Issue: Database connection error
1. Verify DATABASE_URL is correctly set in Railway Variables
2. Check PostgreSQL instance is running
3. Ensure DB credentials match

### Issue: Migrations not running automatically
1. Add `php artisan migrate --force` to Procfile:
```
release: php artisan migrate --force
web: vendor/bin/heroku-php-apache2 public/
```

### Issue: Storage or cache permissions
Railway automatically handles permissions, but if issues persist:
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Assets not loading
```bash
php artisan asset:publish
php artisan view:cache
```

## 📊 Monitoring

### View Logs
1. Go to your Railway project
2. Click "Logs" tab
3. View real-time application logs

### Monitor Performance
1. Go to "Metrics" tab
2. Monitor CPU, Memory, Network usage

### Manage Database
1. Click on PostgreSQL instance
2. View database stats and connections

## 🔐 Security Checklist

- [ ] APP_DEBUG set to false
- [ ] APP_ENV set to production
- [ ] APP_KEY generated and set
- [ ] HTTPS enabled (Railway provides free SSL)
- [ ] Database credentials secure
- [ ] MAIL credentials set correctly
- [ ] SESSION_ENCRYPT enabled
- [ ] Regular backups configured

## 📝 Environment Variables Reference

See `railway.env` file for complete list of variables

## 🆘 Support

- Railway Docs: https://docs.railway.app
- Laravel Deployment: https://laravel.com/docs/deployment
- Email support: support@railway.app

