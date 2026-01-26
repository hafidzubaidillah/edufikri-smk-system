# 📝 Panduan Input Data Manual - EDUFIKRI

## 🎯 Overview

Sistem EDUFIKRI sekarang sudah dibersihkan dari data dummy dan siap untuk input data manual. Anda dapat menambahkan kelas, mata pelajaran, guru, dan siswa sesuai kebutuhan sekolah Anda.

## 🔐 Login Admin

Gunakan akun admin yang telah dibuat:
- **Email**: `admin@edufikri.com`
- **Password**: `admin123`

> ⚠️ **Penting**: Segera ganti password admin setelah login pertama kali!

## 📋 Urutan Input Data yang Disarankan

### 1. 🏫 **Tambah Kelas Terlebih Dahulu**
   - Masuk ke menu **Akademik > Kelas**
   - Klik **Tambah Kelas Baru**
   - Isi informasi kelas:
     - Nama Kelas (contoh: X PPLG 1, XI TJKT 2)
     - Tingkat (10, 11, atau 12)
     - Jurusan (PPLG, TJKT, AKL, BDP, OTKP)
     - Nomor Kelas (1, 2, 3, dst)
     - Wali Kelas
     - Kapasitas Siswa
     - Tahun Ajaran

### 2. 📚 **Tambah Mata Pelajaran**
   - Masuk ke menu **Akademik > Mata Pelajaran**
   - Klik **Tambah Mata Pelajaran**
   - Isi informasi mata pelajaran:
     - Nama Mata Pelajaran
     - Kode Mata Pelajaran
     - Deskripsi
     - Jumlah SKS/Jam
     - Kategori (Wajib/Pilihan)

### 3. 👨‍🏫 **Tambah Data Guru**
   - Masuk ke menu **Akademik > Jadwal**
   - Atau bisa langsung saat mengatur jadwal kelas
   - Isi informasi guru:
     - Nama Lengkap
     - Email
     - Mata Pelajaran yang Diampu
     - Status (Aktif/Tidak Aktif)

### 4. 👨‍🎓 **Tambah Data Siswa**
   - Masuk ke menu **Akademik > Kelas**
   - Pilih kelas yang sudah dibuat
   - Klik **Kelola Siswa**
   - Klik **Tambah Siswa Baru**
   - Isi informasi siswa:
     - Nama Lengkap
     - NIS (Nomor Induk Siswa)
     - Email (opsional)
     - Status (Aktif/Tidak Aktif)

### 5. 📅 **Atur Jadwal Pelajaran**
   - Masuk ke menu **Akademik > Jadwal**
   - Pilih kelas
   - Tambah jadwal untuk setiap mata pelajaran:
     - Mata Pelajaran
     - Guru Pengampu
     - Hari
     - Jam Mulai - Jam Selesai
     - Ruangan

## 🛠️ Fitur yang Tersedia

### ✅ **Manajemen Kelas**
- ➕ Tambah kelas baru
- ✏️ Edit informasi kelas
- 👥 Kelola daftar siswa per kelas
- 📊 Lihat statistik kelas
- 🗑️ Hapus kelas (jika kosong)

### ✅ **Manajemen Mata Pelajaran**
- ➕ Tambah mata pelajaran baru
- ✏️ Edit informasi mata pelajaran
- 📋 Lihat daftar semua mata pelajaran
- 🔍 Cari mata pelajaran

### ✅ **Manajemen Siswa**
- ➕ Tambah siswa baru ke kelas
- ✏️ Edit informasi siswa
- 🔄 Pindah siswa antar kelas
- 📊 Lihat profil lengkap siswa
- 🗑️ Hapus data siswa

### ✅ **Manajemen Jadwal**
- ➕ Buat jadwal pelajaran
- ✏️ Edit jadwal yang ada
- 👨‍🏫 Assign guru ke mata pelajaran
- 🏫 Atur ruangan kelas
- 📅 Lihat jadwal per hari/minggu

## 📊 Dashboard Admin

Setelah menambahkan data, dashboard akan menampilkan:
- 📈 **Statistik Real-time**:
  - Total Kelas
  - Total Siswa
  - Total Guru
  - Total Mata Pelajaran

- 📋 **Informasi Terkini**:
  - Kelas dengan siswa terbanyak
  - Mata pelajaran yang paling banyak diampu
  - Aktivitas terbaru

## 🎨 Contoh Data yang Bisa Ditambahkan

### **Contoh Kelas SMK IT Ihsanul Fikri:**
```
Kelas X:
- X PPLG 1 (Pengembangan Perangkat Lunak dan Gim)
- X PPLG 2
- X TJKT 1 (Teknik Jaringan Komputer dan Telekomunikasi)
- X TJKT 2
- X AKL 1 (Akuntansi dan Keuangan Lembaga)
- X BDP 1 (Bisnis Daring dan Pemasaran)
- X OTKP 1 (Otomatisasi dan Tata Kelola Perkantoran)

Kelas XI & XII: (sama dengan pola di atas)
```

### **Contoh Mata Pelajaran:**
```
Mata Pelajaran Umum:
- Pendidikan Agama Islam
- Pendidikan Pancasila dan Kewarganegaraan
- Bahasa Indonesia
- Matematika
- Sejarah Indonesia
- Bahasa Inggris

Mata Pelajaran Kejuruan PPLG:
- Pemrograman Dasar
- Basis Data
- Pemrograman Web
- Pemrograman Berorientasi Objek
- Pengembangan Aplikasi Mobile

Mata Pelajaran Kejuruan TJKT:
- Sistem Komputer
- Jaringan Dasar
- Administrasi Infrastruktur Jaringan
- Teknologi Layanan Jaringan
```

## 🔧 Tips dan Best Practices

### **1. Penamaan yang Konsisten**
- Gunakan format penamaan yang konsisten untuk kelas
- Contoh: `X PPLG 1`, `XI TJKT 2`, `XII AKL 1`

### **2. Kode Mata Pelajaran**
- Buat kode singkat untuk mata pelajaran
- Contoh: `PAI` (Pendidikan Agama Islam), `MTK` (Matematika)

### **3. Email Siswa**
- Jika siswa memiliki email, masukkan untuk fitur notifikasi
- Format yang disarankan: `nama.kelas@smkitihsanulfikri.sch.id`

### **4. Backup Data**
- Lakukan backup database secara berkala
- Export data penting ke Excel/CSV

### **5. Validasi Data**
- Pastikan NIS siswa unik
- Cek email tidak duplikat
- Verifikasi kapasitas kelas

## 🚨 Troubleshooting

### **Problem: Tidak bisa menambah siswa**
**Solusi**: Pastikan kelas sudah dibuat terlebih dahulu

### **Problem: Jadwal bentrok**
**Solusi**: Cek jadwal guru dan ruangan yang sudah ada

### **Problem: Data tidak tersimpan**
**Solusi**: Cek koneksi database dan validasi form

### **Problem: Lupa password admin**
**Solusi**: Jalankan seeder admin lagi atau reset via database

## 📞 Bantuan

Jika mengalami kesulitan:
1. 📖 Baca dokumentasi lengkap di `CLASS_MANAGEMENT_GUIDE.md`
2. 🔍 Cek log error di `storage/logs/laravel.log`
3. 💬 Hubungi developer untuk bantuan teknis

## 🎯 Langkah Selanjutnya

Setelah data dasar lengkap:
1. ✅ Test fitur absensi QR Code
2. ✅ Test sistem pengumuman email
3. ✅ Setup notifikasi untuk orang tua/wali
4. ✅ Konfigurasi laporan dan analytics

---

**🎉 Selamat! Sistem EDUFIKRI siap digunakan dengan data Anda sendiri!**

*Dibuat untuk SMK IT Ihsanul Fikri - Mungkid, Magelang*