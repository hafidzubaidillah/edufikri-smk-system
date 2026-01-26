<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SubjectTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Menambahkan guru-guru pengampu mata pelajaran wajib
     */
    public function run(): void
    {
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);

        // Data guru pengampu mata pelajaran wajib
        $subjectTeachers = [
            [
                'name' => 'Drs. Bambang Sutrisno',
                'email' => 'bambang.sutrisno@edufikri.com',
                'nip' => '196805121994031002',
                'phone' => '081234567898',
                'subject_specialization' => 'Matematika',
                'education_level' => 'S1 Pendidikan Matematika',
                'gender' => 'L',
                'birth_date' => '1968-05-12',
            ],
            [
                'name' => 'Dra. Sari Indrawati',
                'email' => 'sari.indrawati@edufikri.com',
                'nip' => '197203151998032001',
                'phone' => '081234567899',
                'subject_specialization' => 'Bahasa Indonesia',
                'education_level' => 'S1 Pendidikan Bahasa Indonesia',
                'gender' => 'P',
                'birth_date' => '1972-03-15',
            ],
            [
                'name' => 'Drs. Ahmad Yusuf',
                'email' => 'ahmad.yusuf@edufikri.com',
                'nip' => '197009102000031003',
                'phone' => '081234567900',
                'subject_specialization' => 'Bahasa Inggris',
                'education_level' => 'S1 Pendidikan Bahasa Inggris',
                'gender' => 'L',
                'birth_date' => '1970-09-10',
            ],
            [
                'name' => 'Dra. Nurul Hidayah',
                'email' => 'nurul.hidayah@edufikri.com',
                'nip' => '197506202005042002',
                'phone' => '081234567901',
                'subject_specialization' => 'PPKN',
                'education_level' => 'S1 Pendidikan Pancasila dan Kewarganegaraan',
                'gender' => 'P',
                'birth_date' => '1975-06-20',
            ],
            [
                'name' => 'Drs. H. Muhammad Ridwan',
                'email' => 'muhammad.ridwan@edufikri.com',
                'nip' => '196812051995031001',
                'phone' => '081234567902',
                'subject_specialization' => 'Pendidikan Agama Islam',
                'education_level' => 'S1 Pendidikan Agama Islam',
                'gender' => 'L',
                'birth_date' => '1968-12-05',
            ]
        ];

        foreach ($subjectTeachers as $index => $teacherData) {
            // Create user account
            $user = User::firstOrCreate(
                ['email' => $teacherData['email']],
                [
                    'name' => $teacherData['name'],
                    'password' => Hash::make('guru123'),
                    'email_verified_at' => now(),
                    'plain_password' => 'guru123',
                ]
            );
            $user->assignRole($teacherRole);

            // Create teacher profile
            $teacherId = 'GURU' . str_pad((Teacher::count() + 1), 3, '0', STR_PAD_LEFT);
            
            Teacher::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'teacher_id' => $teacherId,
                    'name' => $teacherData['name'],
                    'email' => $teacherData['email'],
                    'nip' => $teacherData['nip'],
                    'phone' => $teacherData['phone'],
                    'address' => 'Jl. Pendidikan No. ' . (130 + $index),
                    'birth_date' => $teacherData['birth_date'],
                    'gender' => $teacherData['gender'],
                    'education_level' => $teacherData['education_level'],
                    'subject_specialization' => $teacherData['subject_specialization'],
                    'hire_date' => '2010-07-01',
                    'is_active' => true,
                    'bio' => 'Guru pengampu mata pelajaran ' . $teacherData['subject_specialization'] . ' dengan pengalaman mengajar lebih dari 10 tahun',
                    'emergency_contact' => 'Keluarga ' . explode(' ', $teacherData['name'])[1] ?? $teacherData['name'],
                    'emergency_phone' => '081234567890',
                ]
            );
        }

        $this->command->info('✅ Subject teachers created successfully!');
        $this->command->info('👥 Total guru pengampu mata pelajaran: ' . count($subjectTeachers));
        $this->command->info('');
        $this->command->info('📋 Daftar guru pengampu:');
        foreach ($subjectTeachers as $teacher) {
            $this->command->info("   - {$teacher['subject_specialization']}: {$teacher['name']}");
        }
        $this->command->info('');
        $this->command->info('🔑 Password untuk semua guru: guru123');
        $this->command->info('📧 Format email: nama.guru@edufikri.com');
        
        // Show total teachers now
        $totalTeachers = Teacher::count();
        $this->command->info("📊 Total guru di sistem: {$totalTeachers}");
    }
}