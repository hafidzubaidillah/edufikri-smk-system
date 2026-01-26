<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Learner;
use App\Models\SchoolClass;

class LearnerSeeder extends Seeder
{
    public function run(): void
    {
        $classes = SchoolClass::all();
        
        // Nama-nama siswa Indonesia yang realistis
        $firstNames = [
            // Nama laki-laki
            'Ahmad', 'Muhammad', 'Abdul', 'Budi', 'Andi', 'Dedi', 'Eko', 'Fajar', 'Hadi', 'Indra',
            'Joko', 'Kurnia', 'Lukman', 'Maulana', 'Nugroho', 'Omar', 'Putra', 'Rizki', 'Sandi', 'Taufik',
            'Umar', 'Wahyu', 'Yudi', 'Zaki', 'Arif', 'Bayu', 'Candra', 'Dimas', 'Erlangga', 'Firdaus',
            
            // Nama perempuan
            'Siti', 'Aisyah', 'Dewi', 'Fitri', 'Indah', 'Lestari', 'Maya', 'Nur', 'Putri', 'Rina',
            'Sari', 'Tika', 'Wulan', 'Yuni', 'Zahra', 'Ayu', 'Bella', 'Citra', 'Dina', 'Evi',
            'Fani', 'Gita', 'Hana', 'Ika', 'Jihan', 'Kirana', 'Laila', 'Mira', 'Nisa', 'Olivia'
        ];
        
        $lastNames = [
            'Pratama', 'Wijaya', 'Kusuma', 'Santoso', 'Hidayat', 'Setiawan', 'Nugroho', 'Rahayu',
            'Sari', 'Lestari', 'Maharani', 'Purnama', 'Cahaya', 'Permana', 'Saputra', 'Saputri',
            'Handoko', 'Wibowo', 'Susanto', 'Hartono', 'Gunawan', 'Kurniawan', 'Suryanto', 'Budiman',
            'Firmansyah', 'Ramadhan', 'Maulana', 'Hakim', 'Syahputra', 'Syahputri', 'Ananda', 'Perdana'
        ];

        $studentCounter = 1;

        foreach ($classes as $class) {
            $studentsCount = $class->current_students;
            
            for ($i = 1; $i <= $studentsCount; $i++) {
                $firstName = $firstNames[array_rand($firstNames)];
                $lastName = $lastNames[array_rand($lastNames)];
                
                // Generate NIS (Nomor Induk Siswa)
                $studentId = sprintf('%04d%02d%03d', 
                    2025, // Tahun masuk
                    $class->grade, // Grade level
                    $studentCounter
                );
                
                // Generate tanggal lahir (umur 15-18 tahun)
                $birthYear = date('Y') - (15 + $class->grade - 10); // Kelas 10 = 15-16 tahun, dst
                $birthDate = date('Y-m-d', strtotime($birthYear . '-' . rand(1, 12) . '-' . rand(1, 28)));
                
                // Generate gender
                $gender = rand(0, 1) ? 'L' : 'P';
                
                // Generate alamat
                $addresses = [
                    'Jl. Magelang No. ' . rand(1, 100) . ', Mungkid',
                    'Jl. Borobudur No. ' . rand(1, 50) . ', Borobudur', 
                    'Jl. Merapi No. ' . rand(1, 75) . ', Muntilan',
                    'Jl. Diponegoro No. ' . rand(1, 200) . ', Magelang',
                    'Jl. Ahmad Yani No. ' . rand(1, 150) . ', Mertoyudan'
                ];
                
                // Generate phone
                $phone = '08' . rand(1, 9) . rand(10000000, 99999999);
                
                // Generate parent info
                $parentNames = [
                    'Bapak ' . $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)],
                    'Ibu ' . $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)]
                ];
                $parentPhone = '08' . rand(1, 9) . rand(10000000, 99999999);
                
                // Generate email
                $email = strtolower($firstName . '.' . $lastName . '.' . $studentId) . '@student.smkitihsanulfikri.sch.id';
                
                Learner::create([
                    'fname' => $firstName,
                    'mname' => '', // Middle name kosong
                    'lname' => $lastName,
                    'email' => $email,
                    'grade_level' => $class->grade,
                    'section' => $class->name,
                    'class_id' => $class->id,
                    'student_id' => $studentId,
                    'birth_date' => $birthDate,
                    'gender' => $gender,
                    'address' => $addresses[array_rand($addresses)],
                    'phone' => $phone,
                    'parent_name' => $parentNames[array_rand($parentNames)],
                    'parent_phone' => $parentPhone,
                ]);
                
                $studentCounter++;
            }
        }
    }
}