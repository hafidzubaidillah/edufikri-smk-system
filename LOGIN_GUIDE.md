# 🔐 Panduan Login - SMK IT Ihsanul Fikri

## Screenshot Halaman Login

![Halaman Login EDUFIKRI](file:///C:/Users/kxkl_/.gemini/antigravity/brain/8e600f52-88cc-4982-b749-04a8d7038db1/uploaded_media_1769568096346.png)

---

## 📋 Cara Login

### Step 1: Buka Halaman Login

Buka URL berikut di browser:
```
https://laravel-omega-eight.vercel.app/login
```

Atau klik tombol **"Login"** di homepage.

### Step 2: Masukkan Credentials

Berdasarkan database yang ada, gunakan salah satu akun berikut:

#### **Option 1: Admin Default** (Jika sudah run migration)
- **Email**: `admin@smkitihsanulfikri.sch.id`
- **Password**: `admin123`

#### **Option 2: User yang Sudah Ada**
Database menunjukkan ada **1 user** yang sudah terdaftar. Jika Anda sudah pernah membuat user sebelumnya, gunakan credentials tersebut.

### Step 3: Klik "Masuk"

Setelah memasukkan email dan password, klik tombol **"Masuk"** atau tekan Enter.

---

## ⚠️ Troubleshooting

### Jika Login Gagal:

#### 1. **User Belum Ada**
Jika belum ada user di database, Anda perlu membuat user terlebih dahulu:

**Cara A: Via Migration Endpoint**
1. Buka: https://laravel-omega-eight.vercel.app/migrate
2. Endpoint ini akan otomatis membuat admin user dengan credentials:
   - Email: `admin@smkitihsanulfikri.sch.id`
   - Password: `admin123`

**Cara B: Via Register** (Jika fitur register aktif)
1. Klik link "Daftar" atau "Register"
2. Isi form pendaftaran
3. Verifikasi email (jika required)
4. Login dengan akun baru

#### 2. **Lupa Password**
- Klik link "Lupa Password?" di halaman login
- Masukkan email Anda
- Ikuti instruksi reset password via email

#### 3. **Error "Invalid Credentials"**
- Pastikan email dan password benar
- Cek capslock tidak aktif
- Coba reset password

#### 4. **Session Tidak Tersimpan**
Jika setelah login langsung logout lagi:
- Clear browser cookies
- Coba browser lain (Chrome, Firefox, Edge)
- Pastikan cookies enabled di browser

---

## 🔧 Setup Admin User (Jika Belum Ada)

Jalankan migration endpoint untuk membuat admin user:

### Via Browser:
```
https://laravel-omega-eight.vercel.app/migrate
```

### Via CLI (dari local):
```bash
# SSH ke Vercel (tidak tersedia untuk hobby plan)
# Atau gunakan endpoint /migrate via browser
```

Setelah migration selesai, login dengan:
- **Email**: `admin@smkitihsanulfikri.sch.id`
- **Password**: `admin123`

> [!WARNING]
> **SEGERA GANTI PASSWORD** setelah login pertama kali!

---

## 📱 Setelah Login Berhasil

Setelah login, Anda akan diarahkan ke:
- **Dashboard Admin** - Jika login sebagai admin
- **Dashboard Siswa** - Jika login sebagai siswa
- **Homepage** - Default redirect

### Menu yang Tersedia:
- 📊 Dashboard
- 👥 Manajemen Siswa
- 📚 Manajemen Kelas
- 📝 Data Akademik
- ⚙️ Pengaturan
- 🚪 Logout

---

## 🔐 Keamanan

### Ganti Password Default:
1. Login dengan password default
2. Klik menu **"Profile"** atau **"Pengaturan"**
3. Pilih **"Ganti Password"**
4. Masukkan password lama dan password baru
5. Simpan perubahan

### Password yang Baik:
- Minimal 8 karakter
- Kombinasi huruf besar, kecil, angka
- Gunakan simbol jika memungkinkan
- Jangan gunakan password yang mudah ditebak

---

## 📞 Butuh Bantuan?

### Check Status Aplikasi:
```
https://laravel-omega-eight.vercel.app/debug
```

Halaman ini menampilkan:
- Status database connection
- Jumlah user di database
- Environment configuration
- Error logs (jika ada)

### Kontak Support:
- Email: info@smkitihsanulfikri.sch.id
- WhatsApp: +62 823-2308-4443

---

## 🎯 Quick Reference

| Aksi | URL |
|------|-----|
| Login | https://laravel-omega-eight.vercel.app/login |
| Register | https://laravel-omega-eight.vercel.app/register |
| Lupa Password | https://laravel-omega-eight.vercel.app/password/reset |
| Migration | https://laravel-omega-eight.vercel.app/migrate |
| Debug Info | https://laravel-omega-eight.vercel.app/debug |
| Homepage | https://laravel-omega-eight.vercel.app |

---

## ✅ Checklist Login

- [ ] Buka halaman login
- [ ] Masukkan email yang benar
- [ ] Masukkan password yang benar
- [ ] Klik tombol "Masuk"
- [ ] Jika gagal, coba run `/migrate` untuk buat admin user
- [ ] Setelah berhasil login, ganti password default
- [ ] Explore dashboard dan fitur-fitur yang tersedia

Selamat menggunakan sistem EDUFIKRI! 🎉
