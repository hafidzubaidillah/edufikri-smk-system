<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Learner;
use App\Models\ClassSubject;

class CleanAndUpdateSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        echo "Menghapus data lama...\n";
        
        // Hapus semua data
        ClassSubject::truncate();
        \DB::table('learner_attendance')->truncate();
        \DB::table('announcement_logs')->truncate();
        Learner::truncate();
        Teacher::truncate();
        SchoolClass::truncate();
        Subject::truncate();
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        echo "Data lama berhasil dihapus.\n";
        
        // Jalankan seeder baru dengan urutan yang benar
        echo "Menambahkan data baru...\n";
        
        $this->call([
            UpdatedSubjectSeeder::class,
            UpdatedSchoolClassSeeder::class,
            UpdatedTeacherSeeder::class,
        ]);
        
        echo "Data baru berhasil ditambahkan.\n";
        echo "Silakan jalankan LearnerSeeder dan ClassSubjectSeeder secara terpisah.\n";
    }
}