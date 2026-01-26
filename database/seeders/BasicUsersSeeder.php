<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Learner;
use App\Models\SchoolClass;
use App\Models\Subject;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class BasicUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates basic users: 1 admin, 1 teacher, 1 student
     */
    public function run(): void
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher']);
        $learnerRole = Role::firstOrCreate(['name' => 'learner']);

        // Create basic permissions
        $permissions = [
            'manage users',
            'manage classes',
            'manage subjects',
            'manage attendance',
            'send announcements',
            'view reports'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->syncPermissions(Permission::all());
        $teacherRole->syncPermissions(['manage attendance', 'view reports']);

        // 1. Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@edufikri.com'],
            [
                'name' => 'Administrator EDUFIKRI',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'plain_password' => 'admin123',
            ]
        );
        $admin->assignRole('admin');

        // 2. Create Teacher User
        $teacherUser = User::firstOrCreate(
            ['email' => 'guru@edufikri.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('guru123'),
                'email_verified_at' => now(),
                'plain_password' => 'guru123',
            ]
        );
        $teacherUser->assignRole('teacher');

        // Create teacher profile
        $teacher = Teacher::firstOrCreate(
            ['user_id' => $teacherUser->id],
            [
                'teacher_id' => 'GURU001',
                'name' => 'Budi Santoso',
                'email' => 'guru@edufikri.com',
                'nip' => '197505152006041001',
                'phone' => '081234567890',
                'address' => 'Jl. Pendidikan No. 123, Magelang',
                'birth_date' => '1985-05-15',
                'gender' => 'L',
                'education_level' => 'S1 Teknik Informatika',
                'subject_specialization' => 'Pemrograman Web',
                'hire_date' => '2015-07-01',
                'is_active' => true,
                'bio' => 'Guru berpengalaman dalam bidang pemrograman web dan teknologi informasi',
                'emergency_contact' => 'Siti Santoso',
                'emergency_phone' => '081234567893',
            ]
        );

        // 3. Create Student User
        $studentUser = User::firstOrCreate(
            ['email' => 'siswa@edufikri.com'],
            [
                'name' => 'Siti Nurhaliza',
                'password' => Hash::make('siswa123'),
                'email_verified_at' => now(),
                'plain_password' => 'siswa123',
            ]
        );
        $studentUser->assignRole('learner');

        // Create a basic class first
        $class = SchoolClass::firstOrCreate(
            ['name' => 'XII TJKT 1'],
            [
                'grade' => 12,
                'major' => 'TJKT',
                'class_number' => 1,
                'homeroom_teacher' => 'Budi Santoso',
                'capacity' => 36,
                'current_students' => 1,
                'academic_year' => '2025/2026',
                'is_active' => true,
            ]
        );

        // Create learner profile
        $learner = Learner::firstOrCreate(
            ['user_id' => $studentUser->id],
            [
                'fname' => 'Siti',
                'mname' => '',
                'lname' => 'Nurhaliza',
                'name' => 'Siti Nurhaliza',
                'email' => 'siswa@edufikri.com',
                'phone' => '081234567891',
                'address' => 'Jl. Siswa No. 456, Magelang',
                'birth_date' => '2006-08-20',
                'gender' => 'P',
                'student_id' => 'EDUFIKRI001',
                'class_id' => $class->id,
                'grade_level' => 'XII',
                'section' => 'TJKT 1',
                'enrollment_date' => '2023-07-01',
                'is_active' => true,
                'parent_name' => 'Ahmad Nurdin',
                'parent_phone' => '081234567892',
                'parent_email' => 'ahmad.nurdin@email.com',
                'parent_occupation' => 'Wiraswasta',
                'bio' => 'Siswa aktif yang tertarik dengan teknologi informasi',
                'hobby' => 'Coding, Reading',
                'aspirations' => 'Menjadi Software Developer',
                'blood_type' => 'A',
            ]
        );

        // Create some basic subjects
        $subjects = [
            [
                'name' => 'Pemrograman Web',
                'code' => 'PWB',
                'description' => 'Mata pelajaran pemrograman web dasar',
                'category' => 'kejuruan',
                'hours_per_week' => 4,
                'grade_level' => '12',
                'majors' => json_encode(['TJKT', 'RPL']),
                'is_mandatory' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Jaringan Komputer',
                'code' => 'JK',
                'description' => 'Mata pelajaran jaringan komputer dan telekomunikasi',
                'category' => 'kejuruan',
                'hours_per_week' => 4,
                'grade_level' => '12',
                'majors' => json_encode(['TJKT']),
                'is_mandatory' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Basis Data',
                'code' => 'BD',
                'description' => 'Mata pelajaran basis data',
                'category' => 'kejuruan',
                'hours_per_week' => 3,
                'grade_level' => '12',
                'majors' => json_encode(['TJKT', 'RPL']),
                'is_mandatory' => true,
                'is_active' => true,
            ]
        ];

        foreach ($subjects as $subjectData) {
            Subject::firstOrCreate(
                ['code' => $subjectData['code']],
                $subjectData
            );
        }

        $this->command->info('✅ Basic users created successfully!');
        $this->command->info('');
        $this->command->info('👤 ADMIN:');
        $this->command->info('   📧 Email: admin@edufikri.com');
        $this->command->info('   🔑 Password: admin123');
        $this->command->info('');
        $this->command->info('👨‍🏫 GURU:');
        $this->command->info('   📧 Email: guru@edufikri.com');
        $this->command->info('   🔑 Password: guru123');
        $this->command->info('   👤 Nama: Budi Santoso');
        $this->command->info('');
        $this->command->info('👨‍🎓 SISWA:');
        $this->command->info('   📧 Email: siswa@edufikri.com');
        $this->command->info('   🔑 Password: siswa123');
        $this->command->info('   👤 Nama: Siti Nurhaliza');
        $this->command->info('   🏫 Kelas: XII TJKT 1');
        $this->command->info('');
        $this->command->info('📚 Mata Pelajaran: Pemrograman Web, Jaringan Komputer, Basis Data');
    }
}