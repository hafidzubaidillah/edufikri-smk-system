<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdditionalTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Menambah beberapa guru untuk testing validasi kepala jurusan
     */
    public function run(): void
    {
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);

        $teachers = [
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti.rahayu@edufikri.com',
                'nip' => '198203152008042002',
                'phone' => '081234567894',
                'subject_specialization' => 'Basis Data',
                'education_level' => 'S1 Sistem Informasi',
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@edufikri.com',
                'nip' => '197908102005041003',
                'phone' => '081234567895',
                'subject_specialization' => 'Jaringan Komputer',
                'education_level' => 'S1 Teknik Informatika',
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi.sartika@edufikri.com',
                'nip' => '198506252010042004',
                'phone' => '081234567896',
                'subject_specialization' => 'Matematika',
                'education_level' => 'S1 Pendidikan Matematika',
            ]
        ];

        foreach ($teachers as $teacherData) {
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
            Teacher::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'teacher_id' => 'GURU' . str_pad(Teacher::count() + 1, 3, '0', STR_PAD_LEFT),
                    'name' => $teacherData['name'],
                    'email' => $teacherData['email'],
                    'nip' => $teacherData['nip'],
                    'phone' => $teacherData['phone'],
                    'address' => 'Jl. Pendidikan No. ' . (123 + Teacher::count()),
                    'birth_date' => '1980-01-01',
                    'gender' => 'L',
                    'education_level' => $teacherData['education_level'],
                    'subject_specialization' => $teacherData['subject_specialization'],
                    'hire_date' => '2020-07-01',
                    'is_active' => true,
                    'bio' => 'Guru berpengalaman dalam bidang ' . $teacherData['subject_specialization'],
                    'emergency_contact' => 'Keluarga ' . $teacherData['name'],
                    'emergency_phone' => '081234567890',
                ]
            );
        }

        $this->command->info('✅ Additional teachers created successfully!');
        $this->command->info('📧 Login credentials for all teachers: password "guru123"');
        $this->command->info('👥 Total teachers now: ' . Teacher::count());
    }
}