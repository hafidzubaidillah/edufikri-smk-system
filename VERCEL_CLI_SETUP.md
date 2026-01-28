# Setup Vercel Postgres - CLI Guide

## ⚠️ Important Note

Vercel CLI **tidak mendukung** pembuatan Postgres database secara langsung. Database harus dibuat melalui **Vercel Dashboard**.

Tapi jangan khawatir! Prosesnya sangat cepat dan mudah.

---

## 🚀 Quick Setup (5 Menit)

### Step 1: Buat Postgres Database (Via Dashboard)

1. Buka: https://vercel.com/hafidzubaidillah/laravel/stores
2. Klik **"Create Database"**
3. Pilih **"Postgres"**
4. Isi:
   - Name: `edufikri-db`
   - Region: **Singapore** (terdekat dengan Indonesia)
5. Klik **"Create"**
6. Tunggu ~1 menit

✅ Vercel akan **otomatis** menambahkan `POSTGRES_URL` ke environment variables!

### Step 2: Tambah Environment Variables (Via CLI)

Jalankan command berikut satu per satu:

```powershell
# APP_ENV
echo production | vercel env add APP_ENV production

# APP_DEBUG  
echo false | vercel env add APP_DEBUG production

# APP_KEY
echo base64:juQp72jOkqQ13Su+Dt02QPSIcj18elMVpqk+xxC4bEs= | vercel env add APP_KEY production

# SESSION_DRIVER
echo cookie | vercel env add SESSION_DRIVER production

# CACHE_STORE
echo array | vercel env add CACHE_STORE production

# QUEUE_CONNECTION
echo sync | vercel env add QUEUE_CONNECTION production

# LOG_CHANNEL
echo stderr | vercel env add LOG_CHANNEL production

# LOG_LEVEL
echo error | vercel env add LOG_LEVEL production

# MAIL_MAILER
echo log | vercel env add MAIL_MAILER production
```

**Atau gunakan script otomatis:**
```powershell
.\setup-vercel-env.bat
```

### Step 3: Deploy ke Production

```powershell
vercel --prod
```

Tunggu deployment selesai (~2 menit).

### Step 4: Run Migrations

Setelah deployment selesai, buka di browser:

```
https://laravel-hafidzubaidillahs-projects.vercel.app/migrate
```

Ini akan:
- ✅ Membuat semua table database
- ✅ Membuat admin user
- ✅ Setup aplikasi

### Step 5: Test Aplikasi

Buka:
```
https://laravel-hafidzubaidillahs-projects.vercel.app
```

Login dengan:
- **Email**: `admin@smkitihsanulfikri.sch.id`
- **Password**: `admin123`

⚠️ **Segera ganti password** setelah login pertama kali!

---

## 🔍 Troubleshooting

### Check Status
```powershell
vercel env ls
```

### Check Deployment Logs
```powershell
vercel logs
```

### Debug Endpoint
Buka: `https://your-app.vercel.app/debug`

---

## 📝 Alternative: Setup Semua Via Dashboard

Jika lebih suka menggunakan dashboard sepenuhnya:

1. **Database**: https://vercel.com/hafidzubaidillah/laravel/stores
2. **Environment Variables**: https://vercel.com/hafidzubaidillah/laravel/settings/environment-variables
3. **Deployments**: https://vercel.com/hafidzubaidillah/laravel/deployments

---

## ✅ Checklist

- [ ] Buat Postgres database via dashboard
- [ ] Tambah environment variables (via CLI atau dashboard)
- [ ] Deploy ke production: `vercel --prod`
- [ ] Run migrations: visit `/migrate`
- [ ] Test login
- [ ] Ganti password admin

---

## 🎯 Next Steps After Setup

1. **Ganti Password Admin** - Segera!
2. **Upload Logo Sekolah** - Lihat `UPLOAD_LOGO_INSTRUCTIONS.md`
3. **Tambah Data Siswa** - Lihat `MANUAL_DATA_ENTRY_GUIDE.md`
4. **Konfigurasi Email** - Lihat `EMAIL_VERIFICATION_GUIDE.md`

Selamat! Aplikasi Anda sudah live di production! 🎉
