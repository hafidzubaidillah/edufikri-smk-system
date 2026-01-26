<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SMKSubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Menambahkan mata pelajaran untuk semua jurusan SMK
     */
    public function run(): void
    {
        // Mata pelajaran umum (untuk semua jurusan)
        $generalSubjects = [
            [
                'code' => 'PAI',
                'name' => 'Pendidikan Agama Islam',
                'description' => 'Mata pelajaran pendidikan agama Islam',
                'category' => 'agama',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'PKN',
                'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'description' => 'Mata pelajaran pendidikan kewarganegaraan',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'BIN',
                'name' => 'Bahasa Indonesia',
                'description' => 'Mata pelajaran bahasa Indonesia',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'MTK',
                'name' => 'Matematika',
                'description' => 'Mata pelajaran matematika',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'BING',
                'name' => 'Bahasa Inggris',
                'description' => 'Mata pelajaran bahasa Inggris',
                'category' => 'umum',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
            ]
        ];

        // Mata pelajaran kejuruan TKJ & RPL
        $tkjRplSubjects = [
            [
                'code' => 'PWB',
                'name' => 'Pemrograman Web',
                'description' => 'Mata pelajaran pemrograman web dasar dan lanjut',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TKJ', 'RPL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'JK',
                'name' => 'Jaringan Komputer',
                'description' => 'Mata pelajaran jaringan komputer dan telekomunikasi',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TKJ'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'BD',
                'name' => 'Basis Data',
                'description' => 'Mata pelajaran basis data',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '12',
                'majors' => ['TKJ', 'RPL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'PBO',
                'name' => 'Pemrograman Berorientasi Objek',
                'description' => 'Mata pelajaran pemrograman berorientasi objek',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['RPL'],
                'is_mandatory' => true,
            ]
        ];

        // Mata pelajaran kejuruan TKR
        $tkrSubjects = [
            [
                'code' => 'PTKR',
                'name' => 'Pemeliharaan Mesin Kendaraan Ringan',
                'description' => 'Mata pelajaran pemeliharaan dan perbaikan mesin kendaraan ringan',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '12',
                'majors' => ['TKR'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'CTKR',
                'name' => 'Chasis dan Pemindah Tenaga Kendaraan Ringan',
                'description' => 'Mata pelajaran sistem chasis dan pemindah tenaga',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TKR'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'LTKR',
                'name' => 'Kelistrikan Kendaraan Ringan',
                'description' => 'Mata pelajaran sistem kelistrikan kendaraan ringan',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '12',
                'majors' => ['TKR'],
                'is_mandatory' => true,
            ]
        ];

        // Mata pelajaran kejuruan TSM
        $tsmSubjects = [
            [
                'code' => 'PTSM',
                'name' => 'Pemeliharaan Mesin Sepeda Motor',
                'description' => 'Mata pelajaran pemeliharaan dan perbaikan mesin sepeda motor',
                'category' => 'kejuruan',
                'hours_per_week' => 10,
                'grade_level' => '12',
                'majors' => ['TSM'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'CTSM',
                'name' => 'Chasis dan Pemindah Tenaga Sepeda Motor',
                'description' => 'Mata pelajaran sistem chasis dan pemindah tenaga sepeda motor',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['TSM'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'LTSM',
                'name' => 'Kelistrikan Sepeda Motor',
                'description' => 'Mata pelajaran sistem kelistrikan sepeda motor',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '12',
                'majors' => ['TSM'],
                'is_mandatory' => true,
            ]
        ];

        // Mata pelajaran kejuruan AKL
        $aklSubjects = [
            [
                'code' => 'AK',
                'name' => 'Akuntansi Dasar',
                'description' => 'Mata pelajaran akuntansi dasar dan menengah',
                'category' => 'kejuruan',
                'hours_per_week' => 8,
                'grade_level' => '12',
                'majors' => ['AKL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'KU',
                'name' => 'Komputer Akuntansi',
                'description' => 'Mata pelajaran aplikasi komputer untuk akuntansi',
                'category' => 'kejuruan',
                'hours_per_week' => 6,
                'grade_level' => '12',
                'majors' => ['AKL'],
                'is_mandatory' => true,
            ],
            [
                'code' => 'ADM',
                'name' => 'Administrasi Pajak',
                'description' => 'Mata pelajaran administrasi perpajakan',
                'category' => 'kejuruan',
                'hours_per_week' => 4,
                'grade_level' => '12',
                'majors' => ['AKL'],
                'is_mandatory' => true,
            ]
        ];

        // Gabungkan semua mata pelajaran
        $allSubjects = array_merge(
            $generalSubjects,
            $tkjRplSubjects,
            $tkrSubjects,
            $tsmSubjects,
            $aklSubjects
        );

        // Hapus mata pelajaran lama yang tidak sesuai
        Subject::whereNotIn('code', array_column($allSubjects, 'code'))->delete();

        // Buat atau update mata pelajaran
        foreach ($allSubjects as $subjectData) {
            Subject::updateOrCreate(
                ['code' => $subjectData['code']],
                [
                    'name' => $subjectData['name'],
                    'description' => $subjectData['description'],
                    'category' => $subjectData['category'],
                    'hours_per_week' => $subjectData['hours_per_week'],
                    'grade_level' => $subjectData['grade_level'],
                    'majors' => $subjectData['majors'],
                    'is_mandatory' => $subjectData['is_mandatory'],
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('✅ SMK Subjects created successfully!');
        $this->command->info('📚 Total mata pelajaran: ' . count($allSubjects));
        $this->command->info('   - Mata pelajaran umum: ' . count($generalSubjects));
        $this->command->info('   - TKJ & RPL: ' . count($tkjRplSubjects));
        $this->command->info('   - TKR: ' . count($tkrSubjects));
        $this->command->info('   - TSM: ' . count($tsmSubjects));
        $this->command->info('   - AKL: ' . count($aklSubjects));
    }
}