# Panduan Sharing Website ke Teman

## Opsi 1: Menggunakan ngrok (Recommended)

### 1. Install ngrok
- Download dari: https://ngrok.com/download
- Extract dan letakkan di folder yang mudah diakses
- Daftar akun gratis di ngrok.com untuk mendapat authtoken

### 2. Setup ngrok
```bash
# Jalankan di terminal/cmd
ngrok config add-authtoken YOUR_AUTHTOKEN
```

### 3. Share aplikasi
```bash
# Pastikan Laravel server berjalan di http://127.0.0.1:8000
# Buka terminal baru dan jalankan:
ngrok http 8000
```

### 4. Bagikan URL
- ngrok akan memberikan URL seperti: `https://abc123.ngrok.io`
- Bagikan URL ini ke teman kamu
- Teman bisa akses langsung tanpa install apapun

---

## Opsi 2: Menggunakan Laravel Valet (Mac/Linux)

### 1. Install Valet
```bash
composer global require laravel/valet
valet install
```

### 2. Setup project
```bash
# Di folder project
valet link edufikri
valet secure edufikri  # Optional: untuk HTTPS
```

### 3. Share
```bash
valet share
```

---

## Opsi 3: Deploy ke Hosting Gratis

### Vercel (Recommended untuk demo)
1. Push code ke GitHub
2. Connect GitHub ke Vercel
3. Deploy otomatis
4. Dapat URL permanen

### Railway
1. Connect GitHub ke Railway
2. Deploy dengan database PostgreSQL gratis
3. URL permanen

---

## Kredensial Login untuk Teman

### Admin
- Email: `admin@edufikri.com`
- Password: `admin123`

### Guru/Teacher
- Email: `guru@edufikri.com`
- Password: `guru123`

### Siswa/Student  
- Email: `siswa@edufikri.com`
- Password: `siswa123`

### Guru Spesialis
- **Matematika**: `bambang.sutrisno@edufikri.com` / `guru123`
- **Bahasa Indonesia**: `sari.indrawati@edufikri.com` / `guru123`
- **Bahasa Inggris**: `ahmad.yusuf@edufikri.com` / `guru123`
- **PPKN**: `nurul.hidayah@edufikri.com` / `guru123`
- **PAI**: `muhammad.ridwan@edufikri.com` / `guru123`

---

## Tips Keamanan

1. **Jangan share kredensial admin** ke sembarang orang
2. **Gunakan ngrok hanya untuk demo** - tidak untuk production
3. **Buat user baru** untuk teman dengan role yang sesuai
4. **Monitor akses** melalui log Laravel

---

## Troubleshooting

### Jika teman tidak bisa akses:
1. Pastikan Laravel server masih berjalan
2. Cek koneksi internet
3. Pastikan ngrok tunnel masih aktif
4. Clear browser cache teman

### Jika login gagal:
1. Pastikan email dan password benar
2. Cek role user di database
3. Clear session dan cookies