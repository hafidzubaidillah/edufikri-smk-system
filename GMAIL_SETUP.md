# Setup Gmail SMTP untuk Laravel

## Langkah-langkah:

### 1. Enable 2-Factor Authentication di Gmail
- Buka [Google Account Settings](https://myaccount.google.com/)
- Pilih "Security" 
- Enable "2-Step Verification"

### 2. Generate App Password
- Di halaman Security, cari "App passwords"
- Klik "App passwords"
- Pilih "Mail" dan "Other (custom name)"
- Masukkan nama: "Laravel EDUFIKRI"
- Copy password yang dihasilkan (16 karakter)

### 3. Update .env file
```
MAIL_USERNAME=hapisubed@gmail.com
MAIL_PASSWORD=your_16_character_app_password
```

### 4. Test Email
```bash
php artisan tinker
>>> Mail::raw('Test email', function($msg) { $msg->to('hapisubed@gmail.com')->subject('Test'); });
```

## Troubleshooting
- Pastikan 2FA sudah aktif
- Gunakan App Password, bukan password Gmail biasa
- Cek folder Spam di Gmail
- Pastikan "Less secure app access" dimatikan (gunakan App Password)