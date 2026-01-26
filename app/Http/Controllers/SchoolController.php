<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('school.about');
    }

    public function programs()
    {
        $programs = [
            [
                'name' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'code' => 'TJKT',
                'description' => 'Program keahlian yang mempelajari administrasi infrastruktur jaringan, instalasi, konfigurasi, dan maintenance sistem komputer dan jaringan.',
                'duration' => '3 Tahun',
                'icon' => 'fas fa-laptop-code',
                'color' => 'blue'
            ],
            [
                'name' => 'Pengembangan Perangkat Lunak dan Gim',
                'code' => 'PPLG',
                'description' => 'Program keahlian yang fokus pada pengembangan aplikasi mobile, web, dan game dengan teknologi terkini.',
                'duration' => '3 Tahun',
                'icon' => 'fas fa-mobile-alt',
                'color' => 'green'
            ],
            [
                'name' => 'Teknik Kendaraan Ringan',
                'code' => 'TKR',
                'description' => 'Program keahlian yang mempelajari perawatan dan perbaikan kendaraan bermotor roda empat.',
                'duration' => '3 Tahun',
                'icon' => 'fas fa-car',
                'color' => 'red'
            ],
            [
                'name' => 'Teknik Sepeda Motor',
                'code' => 'TSM',
                'description' => 'Program keahlian yang spesialisasi dalam perawatan dan perbaikan sepeda motor.',
                'duration' => '3 Tahun',
                'icon' => 'fas fa-motorcycle',
                'color' => 'purple'
            ],
            [
                'name' => 'Akuntansi & Keuangan Lembaga',
                'code' => 'AKL',
                'description' => 'Program keahlian yang mengelola keuangan dan akuntansi perusahaan dengan sistem modern.',
                'duration' => '3 Tahun',
                'icon' => 'fas fa-calculator',
                'color' => 'yellow'
            ]
        ];

        return view('school.programs', compact('programs'));
    }

    public function facilities()
    {
        $facilities = [
            [
                'name' => 'Laboratorium Komputer',
                'description' => 'Laboratorium komputer dengan perangkat terbaru untuk mendukung pembelajaran TJKT dan PPLG.',
                'icon' => 'fas fa-desktop',
                'image' => 'lab-komputer.jpg'
            ],
            [
                'name' => 'Workshop Otomotif',
                'description' => 'Bengkel lengkap dengan peralatan modern untuk praktik teknik kendaraan ringan dan sepeda motor.',
                'icon' => 'fas fa-tools',
                'image' => 'workshop-otomotif.jpg'
            ],
            [
                'name' => 'Masjid Sekolah',
                'description' => 'Masjid yang nyaman untuk kegiatan ibadah dan pembinaan spiritual siswa.',
                'icon' => 'fas fa-mosque',
                'image' => 'masjid.jpg'
            ],
            [
                'name' => 'Perpustakaan',
                'description' => 'Perpustakaan dengan koleksi buku lengkap dan akses internet untuk mendukung pembelajaran.',
                'icon' => 'fas fa-book',
                'image' => 'perpustakaan.jpg'
            ],
            [
                'name' => 'Lapangan Olahraga',
                'description' => 'Lapangan olahraga untuk kegiatan fisik dan pengembangan bakat siswa di bidang olahraga.',
                'icon' => 'fas fa-futbol',
                'image' => 'lapangan.jpg'
            ],
            [
                'name' => 'Kantin Sekolah',
                'description' => 'Kantin dengan makanan halal dan bergizi untuk memenuhi kebutuhan siswa.',
                'icon' => 'fas fa-utensils',
                'image' => 'kantin.jpg'
            ]
        ];

        return view('school.facilities', compact('facilities'));
    }

    public function news()
    {
        $news = [
            [
                'title' => 'Juara 1 Lomba Programming Tingkat Kabupaten',
                'excerpt' => 'Siswa SMK IT Ihsanul Fikri meraih juara 1 dalam lomba programming tingkat kabupaten.',
                'date' => '2026-01-15',
                'category' => 'Prestasi',
                'image' => 'news-1.jpg'
            ],
            [
                'title' => 'Wisuda Angkatan 2025',
                'excerpt' => 'Upacara wisuda siswa angkatan 2025 dengan tingkat kelulusan 98%.',
                'date' => '2026-01-10',
                'category' => 'Kegiatan',
                'image' => 'news-2.jpg'
            ],
            [
                'title' => 'Pendaftaran Siswa Baru Tahun Ajaran 2026/2027',
                'excerpt' => 'Pendaftaran siswa baru tahun ajaran 2026/2027 telah dibuka.',
                'date' => '2026-01-05',
                'category' => 'Pengumuman',
                'image' => 'news-3.jpg'
            ]
        ];

        return view('school.news', compact('news'));
    }

    public function contact()
    {
        $contact = [
            'address' => config('social.address'),
            'phone' => config('social.phone'),
            'email' => config('social.email'),
            'website' => config('social.website'),
            'social' => [
                'facebook' => config('social.facebook'),
                'instagram' => config('social.instagram'),
                'youtube' => config('social.youtube'),
                'whatsapp' => config('social.whatsapp')
            ]
        ];

        return view('school.contact', compact('contact'));
    }
}