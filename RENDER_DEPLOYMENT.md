# 🚀 Deploy Laravel ke Render

## Langkah-langkah Deployment

### 1. **Persiapan Repository**
```bash
# Pastikan semua file sudah di-commit
git add .
git commit -m "Prepare for Render deployment"
git push origin main
```

### 2. **Deploy ke Render**

1. **Buka Render Dashboard**
   - Pergi ke https://render.com
   - Sign up/Login dengan GitHub

2. **Create New Web Service**
   - Klik "New" → "Web Service"
   - Connect GitHub repository: `edufikri-smk-system`
   - Branch: `main`

3. **Configuration**
   - **Name**: `edufikri-smk-system`
   - **Environment**: `PHP`
   - **Build Command**: `./build.sh`
   - **Start Command**: `./start.sh`
   - **Plan**: `Free`

4. **Environment Variables** (akan di-set otomatis dari render.yaml)

### 3. **Setelah Deployment**

1. **Database akan otomatis dibuat** dengan PostgreSQL
2. **Migrations akan dijalankan** otomatis
3. **Admin user akan dibuat** otomatis

### 4. **Login Credentials**
- **Email**: `admin@smkitihsanulfikri.sch.id`
- **Password**: `admin123`

### 5. **URL Aplikasi**
Setelah deployment selesai, aplikasi akan tersedia di:
`https://edufikri-smk-system.onrender.com`

## 🔧 Troubleshooting

### Build Gagal?
- Check build logs di Render dashboard
- Pastikan `composer.json` dan `package.json` valid

### Database Error?
- Render akan otomatis create PostgreSQL database
- Environment variables akan di-set otomatis

### 500 Error?
- Check application logs di Render dashboard
- Pastikan APP_KEY sudah di-set

## 📊 Monitoring

- **Logs**: Tersedia di Render dashboard
- **Metrics**: CPU, Memory usage tracking
- **Health Check**: Otomatis monitoring

## 🎯 Keuntungan Render

✅ **Free Tier**: Permanent free hosting  
✅ **PostgreSQL**: Database gratis included  
✅ **Auto Deploy**: Git push = auto deploy  
✅ **SSL**: HTTPS otomatis  
✅ **Monitoring**: Built-in logs & metrics  
✅ **Laravel Friendly**: PHP support out of the box  

## 🔄 Update Aplikasi

Untuk update aplikasi:
```bash
git add .
git commit -m "Update aplikasi"
git push origin main
```

Render akan otomatis deploy ulang!