<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYear = '2025/2026';
        $majors = ['TKJ', 'RPL', 'TKR', 'TSM', 'AKL'];
        $teachers = [
            'TKJ' => ['Eko Prasetyo, S.Kom', 'Sari Indah, S.T', 'Budi Santoso, S.Kom'],
            'RPL' => ['Maya Sari, S.Kom', 'Agus Wijaya, S.T', 'Rina Kusuma, S.Kom'],
            'TKR' => ['Joko Susilo, S.T', 'Andi Pratama, S.Pd', 'Dedi Kurniawan, S.T'],
            'TSM' => ['Rudi Hartono, S.T', 'Bambang Sujono, S.Pd', 'Heri Setiawan, S.T'],
            'AKL' => ['Siti Nurhaliza, S.E', 'Dewi Lestari, S.E', 'Ahmad Fauzi, S.E']
        ];

        $classes = [];

        // Generate kelas untuk setiap tingkat (10, 11, 12)
        for ($grade = 10; $grade <= 12; $grade++) {
            foreach ($majors as $major) {
                // Setiap jurusan memiliki 2-3 kelas
                $classCount = ($major === 'TKJ' || $major === 'RPL') ? 3 : 2;
                
                for ($classNumber = 1; $classNumber <= $classCount; $classNumber++) {
                    $gradeRoman = ['10' => 'X', '11' => 'XI', '12' => 'XII'][$grade];
                    $className = "{$gradeRoman} {$major} {$classNumber}";
                    
                    $classes[] = [
                        'name' => $className,
                        'grade' => $grade,
                        'major' => $major,
                        'class_number' => $classNumber,
                        'homeroom_teacher' => $teachers[$major][($classNumber - 1) % count($teachers[$major])],
                        'capacity' => 36,
                        'current_students' => rand(30, 36),
                        'academic_year' => $academicYear,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        \App\Models\SchoolClass::insert($classes);
    }
}
