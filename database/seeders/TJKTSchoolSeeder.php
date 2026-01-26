<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Learner;
use App\Models\ClassSubject;

class TJKTSchoolSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ClassSubject::truncate();
        Learner::truncate();
        Teacher::truncate();
        SchoolClass::truncate();
        Subject::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->createSubjects();
        $this->createClasses();
        $this->createTeachers();
        $this->createStudents();
        $this->assignSubjectsToClasses();
    }

    private function createSubjects()
    {
        $subjects = [
            // Mata Pelajaran Umum (Semua Kelas)
            [
                'code' => 'PAI',
                'name' => 'Pendidikan Agama Islam',
                'category' => 'agama',
                'hours_per_week' => 3,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran yang mengajarkan nilai-nilai Islam dan akhlak mulia'
            ],
            [
                'code' => 'PKN',
                'name' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran tentang nilai-nilai Pancasila dan kewarganegaraan'
            ],
            [
                'code' => 'BIN',
                'name' => 'Bahasa Indonesia',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran bahasa dan sastra Indonesia'
            ],
            [
                'code' => 'MTK',
                'name' => 'Matematika',
                'category' => 'umum',
                'hours_per_week' => 4,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran matematika dasar dan terapan'
            ],
            [
                'code' => 'SEJ',
                'name' => 'Sejarah Indonesia',
                'category' => 'umum',
                'hours_per_week' => 2,
                'grade_level' => 'all',
                'majors' => null,
                'description' => 'Mata pelajaran sejarah Indonesia'
            ],
            [
                'code' => 'BING',
           