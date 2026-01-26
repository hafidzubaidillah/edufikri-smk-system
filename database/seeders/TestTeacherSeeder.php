<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TestTeacherSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Check if test teacher already exists
        $existingUser = User::where('email', 'budi.santoso@smk.edu')->first();
        if ($existingUser) {
            echo "Test teacher already exists!\n";
            echo "Email: budi.santoso@smk.edu\n";
            echo "Password: password123\n";
            return;
        }
        
        // Create test teacher user
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@smk.edu',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
        
        // Assign employee role
        $user->assignRole('employee');
        
        // Create teacher profile
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'teacher_id' => 'GR2026001', // This is the NIP in the old schema
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@smk.edu',
            'nip' => 'GR2026001',
            'phone' => '081234567890',
            'address' => 'Jl. Pendidikan No. 123, Magelang',
            'subject_specialization' => 'Matematika',
            'education_level' => 'S1',
            'hire_date' => now(),
            'is_active' => true,
        ]);
        
        echo "Test teacher created successfully!\n";
        echo "Email: budi.santoso@smk.edu\n";
        echo "Password: password123\n";
        echo "Teacher ID: {$teacher->id}\n";
    }
}