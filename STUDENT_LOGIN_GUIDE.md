# Panduan Login Siswa - EDUFIKRI

## Setelah Siswa Dibuat Admin

### Informasi Login Siswa
Ketika admin berhasil menambahkan siswa, sistem otomatis membuat:

1. **Email Login**: `username@student.edufikri.com`
   - Contoh: jika username `ahmad.rizki`, maka email `ahmad.rizki@student.edufikri.com`

2. **Password**: Sesuai yang diset admin saat pendaftaran

3. **Role**: Otomatis sebagai "learner"

### Cara Login Siswa
1. Buka browser dan akses: `http://127.0.0.1:8000/login`
2. Masukkan email: `username@student.edufikri.com`
3. Masukkan password yang dibuat admin
4. Klik "Log in"
5. Siswa akan diarahkan ke dashboard siswa

### Dashboard Siswa
Setelah login berhasil, siswa akan melihat:
- Informasi profil siswa
- Kelas yang diikuti
- Jadwal pelajaran (jika sudah diatur)
- Menu navigasi khusus siswa

### Contoh Login Test
```
Email: ahmad.rizki@student.edufikri.com
Password: password123
```

### Troubleshooting Login Siswa

#### Jika Login Gagal
1. **Email tidak ditemukan**
   - Pastikan format email benar: `username@student.edufikri.com`
   - Cek apakah siswa sudah dibuat oleh admin

2. **Password salah**
   - Pastikan password sesuai yang dibuat admin
   - Password case-sensitive

3. **Akun belum aktif**
   - Cek dengan admin apakah akun sudah dibuat
   - Pastikan field `is_active` = true di database

#### Jika Redirect Tidak Benar
- Siswa dengan role "learner" harus diarahkan ke `/learner/dashboard`
- Jika diarahkan ke tempat lain, ada masalah dengan role assignment

### Fitur Dashboard Siswa
- **Profil**: Lihat dan edit informasi pribadi
- **Kelas**: Informasi kelas dan teman sekelas
- **Jadwal**: Jadwal pelajaran harian/mingguan
- **Tugas**: Tugas dan pengumuman dari guru
- **Absensi**: Riwayat kehadiran

### Logout
Siswa bisa logout dengan klik menu "Logout" di pojok kanan atas dashboard.