<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class UpdatedSubjectSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dengan delete (bukan truncate)
        Subject::query()->delete();
        
        $subjects = [
            // Mata Pelajaran Umum (Semua Jurusan)
            [
                'code' => 'PAI',
                'name' => 'Pendidikan Agama Islam',
                'category' => 'agama',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran yang mengajarkan nilai-nilai Islam dan akhlak mulia'
            ],
            [
                'code' => 'PKN',
                'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran tentang nilai-nilai Pancasila dan kewarganegaraan'
            ],
            [
                'code' => 'BIN',
                'name' => 'Bahasa Indonesia',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran bahasa dan sastra Indonesia'
            ],
            [
                'code' => 'MTK',
                'name' => 'Matematika',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran matematika dasar dan terapan'
            ],
            [
                'code' => 'SEJ',
                'name' => 'Sejarah Indonesia',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran sejarah Indonesia'
            ],
            [
                'code' => 'BING',
                'name' => 'Bahasa Inggris',
                'category' => 'umum',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran bahasa Inggris'
            ],
            [
                'code' => 'PJOK',
                'name' => 'Pendidikan Jasmani, Olahraga dan Kesehatan',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran olahraga dan kesehatan'
            ],
            [
                'code' => 'SBK',
                'name' => 'Seni Budaya',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran seni dan budaya'
            ],

            // Mata Pelajaran Kejuruan TJKT (Teknik Jaringan Komputer dan Telekomunikasi)
            [
                'code' => 'TJKT_DASAR',
                'name' => 'Dasar-Dasar Teknik Jaringan Komputer dan Telekomunikasi',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '10',
                'majors' => ['TJKT'],
                'description' => 'Mata pelajaran dasar teknik jaringan komputer dan telekomunikasi'
            ],
            [
                'code' => 'TJKT_TEKNOLOGI',
                'name' => 'Teknologi Jaringan Berbasis Luas (WAN)',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '11',
                'majors' => ['TJKT'],
                'description' => 'Mata pelajaran teknologi jaringan WAN'
            ],
            [
                'code' => 'TJKT_ADMINISTRASI',
                'name' => 'Administrasi Infrastruktur Jaringan',
                'category' => 'kejuruan',
                'hours_per_week' => 12,
                'grade_level' => '12',
                'majors' => ['TJKT'],
                'description' => 'Mata pelajaran administrasi infrastruktur jaringan'
            ],
            [
                'code' => 'SIMDIG',
                'name' => 'Simulasi dan Komunikasi Digital',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '10',
                'majors' => ['TJKT', 'PPLG'],
                'description' => 'Mata pelajaran simulasi dan komunikasi digital'
            ],

            // Mata Pelajaran Kejuruan PPLG (Pengembangan Perangkat Lunak dan Gim)
            [
                'code' => 'PPLG_DASAR',
                'name' => 'Dasar-Dasar Pengembangan Perangkat Lunak dan Gim',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '10',
                'majors' => ['PPLG'],
                'description' => 'Mata pelajaran dasar pengembangan perangkat lunak dan gim'
            ],
            [
                'code' => 'PPLG_PEMROGRAMAN',
                'name' => 'Pemrograman Berorientasi Objek',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '11',
                'majors' => ['PPLG'],
                'description' => 'Mata pelajaran pemrograman berorientasi objek'
            ],
            [
                'code' => 'PPLG_WEB',
                'name' => 'Pemrograman Web dan Perangkat Bergerak',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '12',
                'majors' => ['PPLG'],
                'description' => 'Mata pelajaran pemrograman web dan mobile'
            ],
            [
                'code' => 'BASIS_DATA',
                'name' => 'Basis Data',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '11',
                'majors' => ['PPLG', 'TJKT'],
                'description' => 'Mata pelajaran tentang database dan SQL'
            ],

            // Mata Pelajaran Kejuruan TKR (Teknik Kendaraan Ringan)
            [
                'code' => 'TKR_DASAR',
                'name' => 'Dasar-Dasar Teknik Kendaraan Ringan',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '10',
                'majors' => ['TKR', 'TSM'],
                'description' => 'Mata pelajaran dasar-dasar teknik kendaraan ringan'
            ],
            [
                'code' => 'TKR_PERAWATAN',
                'name' => 'Perawatan dan Perbaikan Mesin Kendaraan Ringan',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '11',
                'majors' => ['TKR'],
                'description' => 'Mata pelajaran perawatan mesin kendaraan ringan'
            ],
            [
                'code' => 'TKR_KELISTRIKAN',
                'name' => 'Kelistrikan dan Elektronika Kendaraan Ringan',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TKR'],
                'description' => 'Mata pelajaran kelistrikan kendaraan ringan'
            ],

            // Mata Pelajaran Kejuruan TSM (Teknik Sepeda Motor)
            [
                'code' => 'TSM_PERAWATAN',
                'name' => 'Perawatan dan Perbaikan Sepeda Motor',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '11',
                'majors' => ['TSM'],
                'description' => 'Mata pelajaran perawatan sepeda motor'
            ],
            [
                'code' => 'TSM_KELISTRIKAN',
                'name' => 'Kelistrikan Sepeda Motor',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TSM'],
                'description' => 'Mata pelajaran kelistrikan sepeda motor'
            ],

            // Mata Pelajaran Kejuruan AKL (Akuntansi dan Keuangan Lembaga)
            [
                'code' => 'AKL_DASAR',
                'name' => 'Dasar-Dasar Akuntansi dan Keuangan Lembaga',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '10',
                'majors' => ['AKL'],
                'description' => 'Mata pelajaran dasar-dasar akuntansi'
            ],
            [
                'code' => 'AKL_KEUANGAN',
                'name' => 'Akuntansi Keuangan',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '11',
                'majors' => ['AKL'],
                'description' => 'Mata pelajaran akuntansi keuangan'
            ],
            [
                'code' => 'AKL_PERUSAHAAN',
                'name' => 'Akuntansi Perusahaan Jasa, Dagang dan Manufaktur',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '12',
                'majors' => ['AKL'],
                'description' => 'Mata pelajaran akuntansi perusahaan'
            ],

            // Muatan Lokal
            [
                'code' => 'BJAWA',
                'name' => 'Bahasa Jawa',
                'category' => 'muatan_lokal',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran bahasa dan budaya Jawa'
            ],
            [
                'code' => 'BARAB',
                'name' => 'Bahasa Arab',
                'category' => 'muatan_lokal',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran bahasa Arab'
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}