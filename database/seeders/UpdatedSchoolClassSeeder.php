<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class UpdatedSchoolClassSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dengan delete (bukan truncate)
        SchoolClass::query()->delete();
        
        $academicYear = '2025/2026';
        
        // Jurusan SMK sesuai kurikulum terbaru
        $majors = [
            'TJKT', // Teknik Jaringan Komputer dan Telekomunikasi (dulu TKJ)
            'PPLG', // Pengembangan Perangkat Lunak dan Gim (dulu RPL)
            'TKR',  // Teknik Kendaraan Ringan
            'TSM',  // Teknik Sepeda Motor  
            'AKL'   // Akuntansi dan Keuangan Lembaga
        ];
        
        $teachers = [
            'TJKT' => ['Joko Susilo, S.Kom', 'Eko Prasetyo, S.T', 'Sari Indah, S.Kom'],
            'PPLG' => ['Rudi Hartono, S.Kom', 'Heri Setiawan, S.T', 'Dedi Kurniawan, S.Kom'],
            'TKR' => ['Andi Pratama, S.T', 'Ahmad Rizki, S.Pd', 'Yudi Setiawan, S.T'],
            'TSM' => ['Fajar Nugroho, S.T', 'Wahyu Hidayat, S.Pd', 'Bambang Sujono, S.T'],
            'AKL' => ['Lina Marlina, S.E', 'Ratna Sari, S.E', 'Indra Gunawan, S.E']
        ];

        $classes = [];

        // Generate kelas untuk setiap tingkat (10, 11, 12)
        for ($grade = 10; $grade <= 12; $grade++) {
            foreach ($majors as $major) {
                // Setiap jurusan memiliki 2-3 kelas
                $classCount = ($major === 'TJKT' || $major === 'PPLG') ? 3 : 2;
                
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

        SchoolClass::insert($classes);
    }
}