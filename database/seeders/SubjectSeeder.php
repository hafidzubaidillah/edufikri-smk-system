<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            // Mata Pelajaran Umum (Semua Jurusan) - WAJIB
            [
                'code' => 'PAI',
                'name' => 'Pendidikan Agama Islam',
                'category' => 'agama',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran yang mengajarkan nilai-nilai Islam dan akhlak mulia'
            ],
            [
                'code' => 'PKN',
                'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran tentang nilai-nilai Pancasila dan kewarganegaraan'
            ],
            [
                'code' => 'BIN',
                'name' => 'Bahasa Indonesia',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran bahasa dan sastra Indonesia'
            ],
            [
                'code' => 'MTK',
                'name' => 'Matematika',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran matematika dasar dan terapan'
            ],
            [
                'code' => 'SEJ',
                'name' => 'Sejarah Indonesia',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran sejarah Indonesia'
            ],
            [
                'code' => 'BING',
                'name' => 'Bahasa Inggris',
                'category' => 'umum',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran bahasa Inggris'
            ],
            [
                'code' => 'PJOK',
                'name' => 'Pendidikan Jasmani, Olahraga dan Kesehatan',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran olahraga dan kesehatan'
            ],
            [
                'code' => 'SBK',
                'name' => 'Seni Budaya',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => true,
                'description' => 'Mata pelajaran seni dan budaya'
            ],

            // Mata Pelajaran Kejuruan TKJ - TAMBAHAN
            [
                'code' => 'SIJA',
                'name' => 'Sistem Informasi, Jaringan dan Aplikasi',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '11',
                'majors' => ['TKJ'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran tentang sistem informasi dan jaringan komputer'
            ],
            [
                'code' => 'TJKT',
                'name' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '12',
                'majors' => ['TKJ'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran lanjutan teknik jaringan komputer'
            ],
            [
                'code' => 'SIMDIG',
                'name' => 'Simulasi dan Komunikasi Digital',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '10',
                'majors' => ['TKJ', 'RPL'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran simulasi dan komunikasi digital'
            ],

            // Mata Pelajaran Kejuruan RPL - TAMBAHAN
            [
                'code' => 'PWPB',
                'name' => 'Pemrograman Web dan Perangkat Bergerak',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '11',
                'majors' => ['RPL'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran pemrograman web dan mobile'
            ],
            [
                'code' => 'PBO',
                'name' => 'Pemrograman Berorientasi Objek',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '11',
                'majors' => ['RPL'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran pemrograman berorientasi objek'
            ],
            [
                'code' => 'BASIS_DATA',
                'name' => 'Basis Data',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '12',
                'majors' => ['RPL'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran tentang database dan SQL'
            ],

            // Mata Pelajaran Kejuruan TKR - TAMBAHAN
            [
                'code' => 'TBSM',
                'name' => 'Teknologi Dasar Otomotif',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '10',
                'majors' => ['TKR', 'TSM'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran dasar-dasar teknologi otomotif'
            ],
            [
                'code' => 'PDTO',
                'name' => 'Perbaikan dan Perawatan Mesin Kendaraan Ringan',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '11',
                'majors' => ['TKR'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran perbaikan mesin kendaraan ringan'
            ],
            [
                'code' => 'PKKR',
                'name' => 'Pemeliharaan Kelistrikan Kendaraan Ringan',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TKR'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran kelistrikan kendaraan ringan'
            ],

            // Mata Pelajaran Kejuruan TSM - TAMBAHAN
            [
                'code' => 'PTSM',
                'name' => 'Perawatan dan Perbaikan Sepeda Motor',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '11',
                'majors' => ['TSM'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran perawatan sepeda motor'
            ],
            [
                'code' => 'KTSM',
                'name' => 'Kelistrikan Sepeda Motor',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TSM'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran kelistrikan sepeda motor'
            ],

            // Mata Pelajaran Kejuruan AKL - TAMBAHAN
            [
                'code' => 'AKD',
                'name' => 'Akuntansi Dasar',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '10',
                'majors' => ['AKL'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran dasar-dasar akuntansi'
            ],
            [
                'code' => 'AKK',
                'name' => 'Akuntansi Keuangan',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '11',
                'majors' => ['AKL'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran akuntansi keuangan'
            ],
            [
                'code' => 'AKP',
                'name' => 'Akuntansi Perusahaan Jasa, Dagang dan Manufaktur',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '12',
                'majors' => ['AKL'],
                'is_mandatory' => false,
                'description' => 'Mata pelajaran akuntansi perusahaan'
            ],

            // Muatan Lokal - TAMBAHAN
            [
                'code' => 'BJAWA',
                'name' => 'Bahasa Jawa',
                'category' => 'muatan_lokal',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => false,
                'description' => 'Mata pelajaran bahasa dan budaya Jawa'
            ],
            [
                'code' => 'BARAB',
                'name' => 'Bahasa Arab',
                'category' => 'muatan_lokal',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'is_mandatory' => false,
                'description' => 'Mata pelajaran bahasa Arab'
            ],
        ];

        foreach ($subjects as $subject) {
            \App\Models\Subject::create($subject);
        }
    }
}
