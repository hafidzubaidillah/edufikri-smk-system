# Panduan Menambah Siswa - EDUFIKRI

## Cara Menambah Siswa Baru

### Langkah 1: Akses Menu Learners
1. Login sebagai admin dengan email: `admin@edufikri.com` dan password: `admin123`
2. Klik menu **"Learner List"** di dashboard admin
3. Klik tombol **"Add Learner"** (biru dengan ikon plus)

### Langkah 2: Isi Form Siswa
Modal akan terbuka dengan 4 field yang harus diisi:

1. **Nama Lengkap Siswa**
   - Contoh: `Ahmad Rizki Pratama`
   - Isi nama lengkap sesuai dokumen resmi

2. **Username untuk Login**
   - Contoh: `ahmad.rizki` atau `2026001`
   - Username unik untuk login siswa
   - Bisa klik tombol "Auto" untuk generate otomatis dari nama

3. **Password**
   - Minimal 6 karakter
   - Contoh: `password123`
   - Bisa klik tombol "Auto" untuk generate password acak

4. **Pilih Kelas**
   - Pilih dari dropdown kelas yang tersedia
   - Contoh: `X TJKT 1 - TJKT (0/30)`

### Langkah 3: Submit Form
1. Klik tombol **"Tambah Siswa & Buat Akun"** (hijau)
2. Sistem akan otomatis membuat:
   - ✅ Akun login siswa dengan role "learner"
   - ✅ Email otomatis: username@student.edufikri.com
   - ✅ NIS otomatis berdasarkan tahun dan urutan
   - ✅ Tingkat dan section dari kelas yang dipilih

### Langkah 4: Verifikasi
- Setelah berhasil, akan muncul pesan sukses
- Siswa akan muncul di tabel "Learner List"
- Siswa bisa login dengan username dan password yang dibuat

## Troubleshooting

### Jika Form Tidak Submit
1. Buka Developer Tools (F12) di browser
2. Lihat tab Console untuk error JavaScript
3. Pastikan semua field terisi dengan benar
4. Pastikan kelas masih ada slot kosong

### Jika Ada Error Validation
- **Username sudah ada**: Ganti username dengan yang unik
- **Kelas penuh**: Pilih kelas lain atau tambah kapasitas kelas
- **Password terlalu pendek**: Minimal 6 karakter

### Jika Siswa Tidak Muncul di List
1. Refresh halaman (F5)
2. Cek log Laravel di `storage/logs/laravel.log`
3. Pastikan database connection berfungsi

## Login Siswa
Setelah siswa dibuat, mereka bisa login di:
- URL: `http://127.0.0.1:8000/login`
- Email: `username@student.edufikri.com`
- Password: sesuai yang diset saat pendaftaran

## Contoh Data Test
```
Nama: Ahmad Rizki Pratama
Username: ahmad.rizki
Password: password123
Kelas: X TJKT 1
```

Hasil otomatis:
- Email: ahmad.rizki@student.edufikri.com
- NIS: 2026001 (tahun + urutan)
- Grade: 10 (dari kelas X)
- Section: X TJKT 1