<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Major;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SMKMajorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Menambahkan jurusan-jurusan SMK yang sesuai dengan kondisi saat ini
     */
    public function run(): void
    {
        // Buat guru-guru tambahan untuk kepala jurusan
        $this->createAdditionalTeachers();
        
        // Data jurusan SMK
        $majors = [
            [
                'code' => 'TKJ',
                'name' => 'Teknik Komputer dan Jaringan',
                'description' => 'Program keahlian yang mempelajari tentang instalasi, konfigurasi, dan pemeliharaan komputer serta jaringan.',
                'capacity' => 108, // 3 kelas x 36 siswa
                'teacher_name' => 'Budi Santoso', // Existing teacher
            ],
            [
                'code' => 'RPL',
                'name' => 'Rekayasa Perangkat Lunak',
                'description' => 'Program keahlian yang mempelajari tentang pengembangan aplikasi dan sistem perangkat lunak.',
                'capacity' => 72, // 2 kelas x 36 siswa
                'teacher_name' => 'Siti Rahayu',
            ],
            [
                'code' => 'TKR',
                'name' => 'Teknik Kendaraan Ringan',
                'description' => 'Program keahlian yang mempelajari tentang perawatan dan perbaikan kendaraan bermotor roda empat.',
                'capacity' => 108, // 3 kelas x 36 siswa
                'teacher_name' => 'Ahmad Fauzi',
            ],
            [
                'code' => 'TSM',
                'name' => 'Teknik Sepeda Motor',
                'description' => 'Program keahlian yang mempelajari tentang perawatan dan perbaikan sepeda motor.',
                'capacity' => 72, // 2 kelas x 36 siswa
                'teacher_name' => 'Dewi Sartika',
            ],
            [
                'code' => 'AKL',
                'name' => 'Akuntansi dan Keuangan Lembaga',
                'description' => 'Program keahlian yang mempelajari tentang pencatatan, pengelolaan, dan pelaporan keuangan.',
                'capacity' => 72, // 2 kelas x 36 siswa
                'teacher_name' => 'Rina Wijayanti', // New teacher
            ]
        ];

        // Hapus data lama jika ada
        Major::where('code', 'TJKT')->delete();
        
        foreach ($majors as $majorData) {
            // Cari teacher berdasarkan nama
            $teacher = Teacher::where('name', $majorData['teacher_name'])->first();
            
            $major = Major::firstOrCreate(
                ['code' => $majorData['code']],
                [
                    'name' => $majorData['name'],
                    'description' => $majorData['description'],
                    'head_of_major_id' => $teacher ? $teacher->id : null,
                    'capacity' => $majorData['capacity'],
                    'current_students' => 0,
                    'is_active' => true,
                ]
            );

            // Update subjects untuk jurusan ini
            $this->updateSubjectsForMajor($majorData['code']);
            
            // Buat kelas-kelas untuk jurusan ini
            $this->createClassesForMajor($major);
        }

        $this->command->info('✅ SMK Majors created successfully!');
        $this->command->info('📊 Jurusan yang dibuat:');
        foreach ($majors as $major) {
            $this->command->info("   - {$major['code']}: {$major['name']}");
        }
    }

    private function createAdditionalTeachers()
    {
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);

        $newTeacher = [
            'name' => 'Rina Wijayanti',
            'email' => 'rina.wijayanti@edufikri.com',
            'nip' => '198712152012042005',
            'phone' => '081234567897',
            'subject_specialization' => 'Akuntansi',
            'education_level' => 'S1 Akuntansi',
        ];

        // Create user account
        $user = User::firstOrCreate(
            ['email' => $newTeacher['email']],
            [
                'name' => $newTeacher['name'],
                'password' => Hash::make('guru123'),
                'email_verified_at' => now(),
                'plain_password' => 'guru123',
            ]
        );
        $user->assignRole($teacherRole);

        // Create teacher profile
        Teacher::firstOrCreate(
            ['user_id' => $user->id],
            [
                'teacher_id' => 'GURU005',
                'name' => $newTeacher['name'],
                'email' => $newTeacher['email'],
                'nip' => $newTeacher['nip'],
                'phone' => $newTeacher['phone'],
                'address' => 'Jl. Pendidikan No. 127',
                'birth_date' => '1987-12-15',
                'gender' => 'P',
                'education_level' => $newTeacher['education_level'],
                'subject_specialization' => $newTeacher['subject_specialization'],
                'hire_date' => '2015-07-01',
                'is_active' => true,
                'bio' => 'Guru berpengalaman dalam bidang ' . $newTeacher['subject_specialization'],
                'emergency_contact' => 'Keluarga ' . $newTeacher['name'],
                'emergency_phone' => '081234567890',
            ]
        );
    }

    private function updateSubjectsForMajor($majorCode)
    {
        // Mapping mata pelajaran per jurusan
        $subjectsByMajor = [
            'TKJ' => ['Pemrograman Web', 'Jaringan Komputer', 'Basis Data'],
            'RPL' => ['Pemrograman Web', 'Basis Data'],
            'TKR' => [],
            'TSM' => [],
            'AKL' => [],
        ];

        if (isset($subjectsByMajor[$majorCode])) {
            foreach ($subjectsByMajor[$majorCode] as $subjectName) {
                $subject = Subject::where('name', $subjectName)->first();
                if ($subject) {
                    $majors = $subject->majors ?? [];
                    if (!in_array($majorCode, $majors)) {
                        $majors[] = $majorCode;
                        $subject->majors = $majors;
                        $subject->save();
                    }
                }
            }
        }
    }

    private function createClassesForMajor($major)
    {
        $classCount = $major->capacity / 36; // Asumsi 36 siswa per kelas
        
        for ($i = 1; $i <= $classCount; $i++) {
            SchoolClass::firstOrCreate(
                ['name' => "XII {$major->code} {$i}"],
                [
                    'grade' => 12,
                    'major' => $major->code,
                    'class_number' => $i,
                    'homeroom_teacher' => null,
                    'capacity' => 36,
                    'current_students' => 0,
                    'academic_year' => '2025/2026',
                    'is_active' => true,
                ]
            );
        }
    }
}