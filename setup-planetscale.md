# Setup Database PlanetScale untuk Vercel

## Langkah 1: Buat Akun PlanetScale
1. Kunjungi https://planetscale.com/
2. Daftar dengan GitHub account
3. Buat database baru dengan nama `edufikri-db`

## Langkah 2: Dapatkan Connection String
1. Di dashboard PlanetScale, pilih database `edufikri-db`
2. Klik "Connect" 
3. Pilih "Laravel" sebagai framework
4. Copy connection details

## Langkah 3: Update Environment Variables di Vercel
Setelah deploy ke Vercel, tambahkan environment variables berikut:

```
DB_HOST=your-planetscale-host
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

## Langkah 4: Run Migrations
Setelah database terhubung, jalankan:
```bash
vercel env pull .env.production
php artisan migrate --force
```

## Alternative: Menggunakan SQLite untuk Testing
Jika ingin cepat testing tanpa setup database eksternal, bisa gunakan SQLite:
- Set `DB_CONNECTION=sqlite` di Vercel environment variables
- Hapus DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD