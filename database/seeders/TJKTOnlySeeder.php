<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Major;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\Learner;

class TJKTOnlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengubah semua data menjadi hanya TJKT
     */
    public function run(): void
    {
        // 1. Create TJKT Major
        $tjkt = Major::firstOrCreate(
            ['code' => 'TJKT'],
            [
                'name' => 'Teknik Jaringan Komputer dan Telekomunikasi',
                'description' => 'Program keahlian yang mempelajari tentang jaringan komputer, telekomunikasi, dan teknologi informasi.',
                'head_of_major' => 'Budi Santoso',
                'capacity' => 108, // 3 kelas x 36 siswa
                'current_students' => 1, // akan diupdate otomatis
                'is_active' => true,
            ]
        );

        // 2. Update all subjects to only TJKT
        $subjects = Subject::all();
        foreach ($subjects as $subject) {
            $subject->majors = ['TJKT'];
            $subject->save();
        }

        // 3. Update all classes to TJKT major
        SchoolClass::query()->update(['major' => 'TJKT']);

        // 4. Update current students count in major
        $totalStudents = Learner::where('is_active', true)->count();
        $tjkt->update(['current_students' => $totalStudents]);

        $this->command->info('✅ Data berhasil diubah menjadi TJKT only!');
        $this->command->info('📊 Jurusan: ' . $tjkt->name);
        $this->command->info('👥 Total Siswa: ' . $totalStudents);
        $this->command->info('📚 Mata Pelajaran: ' . $subjects->count() . ' (semua untuk TJKT)');
        $this->command->info('🏫 Kelas: ' . SchoolClass::count() . ' (semua TJKT)');
    }
}