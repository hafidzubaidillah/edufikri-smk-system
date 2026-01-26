<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\DB;

class AssignSubjectTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengassign guru ke mata pelajaran di semua kelas
     */
    public function run(): void
    {
        // Mapping guru dengan mata pelajaran berdasarkan spesialisasi
        $teacherSubjectMapping = [
            'Matematika' => 'MTK',
            'Bahasa Indonesia' => 'BIN',
            'Bahasa Inggris' => 'BING',
            'PPKN' => 'PPKN',
            'Pendidikan Agama Islam' => 'PAI',
        ];

        // Jadwal mengajar (contoh)
        $schedules = [
            'MTK' => ['day' => 'Senin', 'start' => '07:00', 'end' => '10:00'],
            'BIN' => ['day' => 'Selasa', 'start' => '07:00', 'end' => '10:00'],
            'BING' => ['day' => 'Rabu', 'start' => '07:00', 'end' => '09:30'],
            'PPKN' => ['day' => 'Kamis', 'start' => '07:00', 'end' => '08:30'],
            'PAI' => ['day' => 'Jumat', 'start' => '07:00', 'end' => '09:30'],
        ];

        // Hapus assignment lama jika ada
        DB::table('class_subjects')->delete();

        $assignmentCount = 0;

        // Loop untuk setiap mata pelajaran
        foreach ($teacherSubjectMapping as $specialization => $subjectCode) {
            // Cari guru berdasarkan spesialisasi
            $teacher = Teacher::where('subject_specialization', $specialization)->first();
            
            // Cari mata pelajaran berdasarkan kode
            $subject = Subject::where('code', $subjectCode)->first();
            
            if (!$teacher || !$subject) {
                $this->command->warn("⚠️  Guru atau mata pelajaran tidak ditemukan untuk: {$specialization} -> {$subjectCode}");
                continue;
            }

            // Assign ke semua kelas yang ada
            $classes = SchoolClass::where('is_active', true)->get();
            
            foreach ($classes as $class) {
                DB::table('class_subjects')->insert([
                    'school_class_id' => $class->id,
                    'subject_id' => $subject->id,
                    'teacher_name' => $teacher->name,
                    'teacher_email' => $teacher->email,
                    'schedule_day' => $schedules[$subjectCode]['day'],
                    'start_time' => $schedules[$subjectCode]['start'],
                    'end_time' => $schedules[$subjectCode]['end'],
                    'room' => 'Ruang ' . $class->name,
                    'academic_year' => '2025/2026',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $assignmentCount++;
            }
        }

        $this->command->info('✅ Subject teachers assigned successfully!');
        $this->command->info("📊 Total assignment: {$assignmentCount}");
        $this->command->info('');
        
        // Show summary
        $this->command->info('📋 Ringkasan assignment:');
        foreach ($teacherSubjectMapping as $specialization => $subjectCode) {
            $teacher = Teacher::where('subject_specialization', $specialization)->first();
            $subject = Subject::where('code', $subjectCode)->first();
            $classCount = SchoolClass::where('is_active', true)->count();
            
            if ($teacher && $subject) {
                $this->command->info("   - {$subject->name} ({$subjectCode}): {$teacher->name} -> {$classCount} kelas");
            }
        }
        
        $this->command->info('');
        $this->command->info('🕐 Jadwal mengajar:');
        foreach ($schedules as $code => $schedule) {
            $subject = Subject::where('code', $code)->first();
            if ($subject) {
                $this->command->info("   - {$subject->name}: {$schedule['day']} {$schedule['start']}-{$schedule['end']}");
            }
        }
    }
}