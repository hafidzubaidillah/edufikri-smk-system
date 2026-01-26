# 📚 Panduan Manajemen Kelas dan Siswa

## 🎯 **Fitur yang Tersedia**

### 🏫 **Manajemen Kelas**
- ✅ **Lihat Semua Kelas** - Dashboard dengan statistik lengkap
- ✅ **Tambah Kelas Baru** - Form dengan validasi dan preview nama kelas
- ✅ **Edit Kelas** - Update informasi kelas yang sudah ada
- ✅ **Hapus Kelas** - Dengan validasi (tidak bisa hapus jika ada siswa)
- ✅ **Filter dan Pencarian** - Berdasarkan tingkat dan jurusan

### 👥 **Manajemen Siswa**
- ✅ **Lihat Siswa per Kelas** - Daftar siswa dengan statistik
- ✅ **Tambah Siswa Baru** - Form lengkap dengan data pribadi dan orang tua
- ✅ **Edit Data Siswa** - Update informasi siswa
- ✅ **Hapus Siswa** - Dengan konfirmasi
- ✅ **Auto-generate Email** - Email otomatis berdasarkan nama dan NIS
- ✅ **Validasi Kapasitas** - Cek kapasitas kelas sebelum menambah siswa

## 🚀 **Cara Menggunakan**

### **1. Mengelola Kelas**

#### **Tambah Kelas Baru:**
1. Masuk ke **Admin Dashboard** → **Kelola Kelas**
2. Klik tombol **"Tambah Kelas"**
3. Isi form dengan data:
   - **Tingkat**: X, XI, atau XII
   - **Jurusan**: TJKT, PPLG, TKR, TSM, atau AKL
   - **Nomor Kelas**: 1-5
   - **Kapasitas**: Maksimal 50 siswa (default: 36)
   - **Wali Kelas**: Pilih dari daftar guru (opsional)
   - **Tahun Ajaran**: Format 2025/2026
4. Lihat **preview nama kelas** yang akan dibuat
5. Klik **"Simpan Kelas"**

#### **Edit Kelas:**
1. Di halaman **Kelola Kelas**, klik **dropdown** pada card kelas
2. Pilih **"Edit Kelas"**
3. Update informasi yang diperlukan
4. Klik **"Perbarui Kelas"**

#### **Hapus Kelas:**
1. Di halaman **Kelola Kelas**, klik **dropdown** pada card kelas
2. Pilih **"Hapus Kelas"**
3. Konfirmasi penghapusan
4. **Catatan**: Kelas yang memiliki siswa tidak bisa dihapus

### **2. Mengelola Siswa**

#### **Tambah Siswa Baru:**
1. Di halaman **Kelola Kelas**, klik **"Siswa"** pada card kelas
2. Klik tombol **"Tambah Siswa"**
3. Isi form dengan data lengkap:
   
   **Data Pribadi:**
   - Nama Lengkap
   - NIS (Nomor Induk Siswa)
   - Email (auto-generate berdasarkan nama dan NIS)
   - Jenis Kelamin
   - Tanggal Lahir
   - No. Telepon (opsional)
   - Alamat Lengkap
   
   **Data Orang Tua:**
   - Nama Orang Tua/Wali
   - No. Telepon Orang Tua/Wali

4. Klik **"Simpan Siswa"**

#### **Edit Data Siswa:**
1. Di halaman **Kelola Siswa**, klik **"Edit"** pada card siswa
2. Update informasi yang diperlukan
3. Klik **"Perbarui Data"**

#### **Hapus Siswa:**
1. Di halaman **Kelola Siswa**, klik **"Hapus"** pada card siswa
2. Konfirmasi penghapusan
3. Siswa akan dihapus dan kapasitas kelas akan berkurang

## 📊 **Statistik dan Monitoring**

### **Dashboard Kelas:**
- Total kelas per tingkat (X, XI, XII)
- Distribusi kelas per jurusan
- Total siswa di semua kelas
- Rata-rata siswa per kelas

### **Dashboard Siswa per Kelas:**
- Total siswa dalam kelas
- Distribusi berdasarkan jenis kelamin
- Sisa kapasitas kelas
- Progress bar kapasitas kelas

## 🔍 **Fitur Pencarian dan Filter**

### **Filter Kelas:**
- **Berdasarkan Tingkat**: X, XI, XII
- **Berdasarkan Jurusan**: TJKT, PPLG, TKR, TSM, AKL
- **Real-time filtering** dengan animasi

### **Pencarian Siswa:**
- **Berdasarkan Nama**: Pencarian real-time
- **Berdasarkan NIS**: Cari dengan nomor induk
- **Filter Jenis Kelamin**: Laki-laki atau Perempuan

## ⚙️ **Validasi dan Keamanan**

### **Validasi Kelas:**
- ✅ Nama kelas harus unik per tahun ajaran
- ✅ Kapasitas maksimal 50 siswa
- ✅ Tingkat harus 10, 11, atau 12
- ✅ Jurusan harus sesuai kurikulum SMK modern

### **Validasi Siswa:**
- ✅ Email harus unik
- ✅ NIS harus unik
- ✅ Cek kapasitas kelas sebelum menambah siswa
- ✅ Format tanggal lahir yang benar
- ✅ Validasi nomor telepon

### **Keamanan:**
- ✅ CSRF protection pada semua form
- ✅ Konfirmasi sebelum penghapusan
- ✅ Validasi server-side dan client-side
- ✅ Sanitasi input data

## 🎨 **Antarmuka Pengguna**

### **Desain Responsif:**
- ✅ Mobile-friendly design
- ✅ Card-based layout yang modern
- ✅ Animasi smooth pada interaksi
- ✅ Color scheme sesuai identitas sekolah (hijau & kuning)

### **User Experience:**
- ✅ Preview nama kelas saat input
- ✅ Auto-generate email siswa
- ✅ Format otomatis nomor telepon
- ✅ Loading states dan feedback visual
- ✅ Alert messages yang informatif

## 🔗 **Navigasi**

### **Menu Utama:**
```
Admin Dashboard
├── Kelola Kelas
│   ├── Daftar Semua Kelas
│   ├── Tambah Kelas Baru
│   ├── Edit Kelas
│   └── Kelola Siswa per Kelas
│       ├── Daftar Siswa
│       ├── Tambah Siswa
│       ├── Edit Siswa
│       └── Hapus Siswa
├── Kelola Mata Pelajaran
└── Jadwal Pelajaran
```

## 📱 **Akses Cepat**

### **URL Routes:**
- **Daftar Kelas**: `/admin/classes`
- **Tambah Kelas**: `/admin/classes/create`
- **Edit Kelas**: `/admin/classes/{id}/edit`
- **Siswa Kelas**: `/admin/classes/{id}/students`
- **Tambah Siswa**: `/admin/classes/{id}/students/create`

## 🎓 **Kurikulum Modern SMK**

### **Jurusan yang Didukung:**
- **TJKT** - Teknik Jaringan Komputer dan Telekomunikasi
- **PPLG** - Pengembangan Perangkat Lunak dan Gim
- **TKR** - Teknik Kendaraan Ringan
- **TSM** - Teknik Sepeda Motor
- **AKL** - Akuntansi dan Keuangan Lembaga

### **Format Penamaan Kelas:**
- **Kelas X**: X TJKT 1, X PPLG 2, dll.
- **Kelas XI**: XI TKR 1, XI TSM 2, dll.
- **Kelas XII**: XII AKL 1, XII TJKT 3, dll.

---

## 🚀 **Fitur Selanjutnya (Roadmap)**

- [ ] Import siswa dari Excel/CSV
- [ ] Export data siswa ke PDF/Excel
- [ ] Sistem absensi terintegrasi
- [ ] Notifikasi email otomatis
- [ ] Laporan statistik lanjutan
- [ ] Backup dan restore data
- [ ] API untuk integrasi sistem lain

---

**Dibuat untuk SMK Islam Terpadu Ihsanul Fikri**  
*Sistem Manajemen Pembelajaran Modern*