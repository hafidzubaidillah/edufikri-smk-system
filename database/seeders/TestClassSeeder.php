<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class TestClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            // Kelas 10
            [
                'name' => 'X TJKT 3',
                'grade' => 10,
                'major' => 'TJKT',
                'class_number' => 3,
                'homeroom_teacher' => 'Pak Budi Santoso',
                'capacity' => 32,
                'current_students' => 0,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ],
            [
                'name' => 'X RPL 1',
                'grade' => 10,
                'major' => 'RPL',
                'class_number' => 1,
                'homeroom_teacher' => 'Bu Sari Dewi',
                'capacity' => 30,
                'current_students' => 0,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ],
            [
                'name' => 'X TKR 1',
                'grade' => 10,
                'major' => 'TKR',
                'class_number' => 1,
                'homeroom_teacher' => 'Pak Ahmad Yani',
                'capacity' => 28,
                'current_students' => 0,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ],
            
            // Kelas 11
            [
                'name' => 'XI TJKT 1',
                'grade' => 11,
                'major' => 'TJKT',
                'class_number' => 1,
                'homeroom_teacher' => 'Bu Rina Sari',
                'capacity' => 30,
                'current_students' => 0,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ],
            [
                'name' => 'XI RPL 1',
                'grade' => 11,
                'major' => 'RPL',
                'class_number' => 1,
                'homeroom_teacher' => 'Pak Dedi Kurniawan',
                'capacity' => 32,
                'current_students' => 0,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ],
            
            // Kelas 12
            [
                'name' => 'XII TJKT 1',
                'grade' => 12,
                'major' => 'TJKT',
                'class_number' => 1,
                'homeroom_teacher' => 'Bu Maya Sari',
                'capacity' => 28,
                'current_students' => 0,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ],
            [
                'name' => 'XII RPL 1',
                'grade' => 12,
                'major' => 'RPL',
                'class_number' => 1,
                'homeroom_teacher' => 'Pak Eko Prasetyo',
                'capacity' => 30,
                'current_students' => 0,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ],
        ];

        foreach ($classes as $classData) {
            SchoolClass::create($classData);
        }
    }
}