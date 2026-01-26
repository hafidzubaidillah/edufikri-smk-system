# 🚀 Quick Start Guide - EDUFIKRI

## 🎯 Memulai dengan Data Kosong

Sistem EDUFIKRI telah dibersihkan dan siap untuk input data manual. Ikuti langkah-langkah berikut untuk memulai:

## 🔐 Login Admin

```
Email: admin@edufikri.com
Password: admin123
```

> ⚠️ **Segera ganti password setelah login pertama!**

## 📋 Langkah Cepat (5 Menit Setup)

### 1. 🏫 Buat Kelas Pertama
- Dashboard → Akademik → Kelas → **Tambah Kelas Baru**
- Contoh: `X PPLG 1` (Kelas 10, Jurusan PPLG, Nomor 1)

### 2. 📚 Tambah Mata Pelajaran
- Dashboard → Akademik → Mata Pelajaran → **Tambah Mata Pelajaran**
- Contoh: `Matematika`, `Bahasa Indonesia`, `Pemrograman Dasar`

### 3. 👨‍🎓 Tambah Siswa Pertama
- Dashboard → Akademik → Kelas → Pilih Kelas → **Kelola Siswa** → **Tambah Siswa**

### 4. 📅 Buat Jadwal
- Dashboard → Akademik → Jadwal → **Tambah Jadwal**

## 🎨 Contoh Data SMK IT Ihsanul Fikri

### **Kelas yang Bisa Dibuat:**
```
Kelas X (Grade 10):
- X PPLG 1, X PPLG 2 (Pengembangan Perangkat Lunak dan Gim)
- X TJKT 1, X TJKT 2 (Teknik Jaringan Komputer dan Telekomunikasi)
- X AKL 1 (Akuntansi dan Keuangan Lembaga)
- X BDP 1 (Bisnis Daring dan Pemasaran)
- X OTKP 1 (Otomatisasi dan Tata Kelola Perkantoran)

Kelas XI & XII: (sama dengan pola di atas)
```

### **Mata Pelajaran Umum:**
- Pendidikan Agama Islam
- Pendidikan Pancasila dan Kewarganegaraan
- Bahasa Indonesia
- Matematika
- Sejarah Indonesia
- Bahasa Inggris

### **Mata Pelajaran Kejuruan PPLG:**
- Pemrograman Dasar
- Basis Data
- Pemrograman Web
- Pemrograman Berorientasi Objek

### **Mata Pelajaran Kejuruan TJKT:**
- Sistem Komputer
- Jaringan Dasar
- Administrasi Infrastruktur Jaringan

## ⚡ Fitur yang Langsung Bisa Digunakan

✅ **Manajemen Kelas** - Tambah, edit, hapus kelas  
✅ **Manajemen Siswa** - Kelola data siswa per kelas  
✅ **Manajemen Mata Pelajaran** - Kelola mapel dan kategori  
✅ **Sistem Jadwal** - Buat jadwal pelajaran  
✅ **Absensi QR Code** - Scan QR untuk absensi  
✅ **Email Pengumuman** - Kirim pengumuman ke siswa  
✅ **Dashboard Analytics** - Lihat statistik real-time  

## 🔧 Tips Cepat

1. **Format Penamaan Kelas**: `[Tingkat] [Jurusan] [Nomor]`
   - Contoh: `X PPLG 1`, `XI TJKT 2`, `XII AKL 1`

2. **NIS Siswa**: Gunakan format yang konsisten
   - Contoh: `2024001`, `2024002`, dst.

3. **Email Siswa**: Format yang disarankan
   - `nama.kelas@smkitihsanulfikri.sch.id`

4. **Backup Data**: Export data penting secara berkala

## 🆘 Bantuan Cepat

**Problem**: Tidak bisa tambah siswa  
**Solusi**: Pastikan kelas sudah dibuat dulu

**Problem**: Jadwal bentrok  
**Solusi**: Cek jadwal guru yang sudah ada

**Problem**: Lupa password admin  
**Solusi**: Jalankan `php artisan db:seed --class=AdminOnlySeeder`

## 📞 Support

- 📖 Panduan Lengkap: `MANUAL_DATA_ENTRY_GUIDE.md`
- 🔍 Log Error: `storage/logs/laravel.log`
- 💬 Developer Support: Hubungi tim IT

---

**🎉 Selamat! Anda siap menggunakan EDUFIKRI!**

*SMK IT Ihsanul Fikri - Mungkid, Magelang*