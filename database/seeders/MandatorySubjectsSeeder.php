<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class MandatorySubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Menghapus semua mata pelajaran dan membuat ulang hanya mata pelajaran wajib
     */
    public function run(): void
    {
        // Hapus semua mata pelajaran yang ada dengan cara yang aman
        // Hapus dulu relasi di class_subjects
        DB::table('class_subjects')->delete();
        
        // Kemudian hapus semua subjects
        Subject::query()->delete();
        
        // Mata pelajaran wajib untuk semua jurusan SMK
        $mandatorySubjects = [
            [
                'code' => 'MTK',
                'name' => 'Matematika',
                'description' => 'Mata pelajaran matematika wajib untuk semua jurusan',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
                'is_active' => true,
            ],
            [
                'code' => 'BIN',
                'name' => 'Bahasa Indonesia',
                'description' => 'Mata pelajaran bahasa Indonesia wajib untuk semua jurusan',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
                'is_active' => true,
            ],
            [
                'code' => 'BING',
                'name' => 'Bahasa Inggris',
                'description' => 'Mata pelajaran bahasa Inggris wajib untuk semua jurusan',
                'category' => 'umum',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
                'is_active' => true,
            ],
            [
                'code' => 'PPKN',
                'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'description' => 'Mata pelajaran PPKN wajib untuk semua jurusan',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
                'is_active' => true,
            ],
            [
                'code' => 'PAI',
                'name' => 'Pendidikan Agama Islam',
                'description' => 'Mata pelajaran PAI wajib untuk semua jurusan',
                'category' => 'agama',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'],
                'is_mandatory' => true,
                'is_active' => true,
            ]
        ];

        // Buat mata pelajaran wajib
        foreach ($mandatorySubjects as $subjectData) {
            Subject::create($subjectData);
        }

        $this->command->info('✅ Mandatory subjects created successfully!');
        $this->command->info('📚 Total mata pelajaran wajib: ' . count($mandatorySubjects));
        $this->command->info('');
        $this->command->info('📋 Daftar mata pelajaran wajib:');
        foreach ($mandatorySubjects as $subject) {
            $this->command->info("   - {$subject['code']}: {$subject['name']} ({$subject['hours_per_week']} jam/minggu)");
        }
        $this->command->info('');
        $this->command->info('ℹ️  Semua mata pelajaran berlaku untuk semua jurusan (TKJ, RPL, TKR, TSM, AKL)');
    }
}