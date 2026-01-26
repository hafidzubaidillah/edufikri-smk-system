<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\Teacher;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get sample data
        $classes = SchoolClass::take(3)->get();
        $subjects = Subject::take(8)->get();
        $teachers = Teacher::take(3)->get();

        if ($classes->isEmpty() || $subjects->isEmpty()) {
            $this->command->info('No classes or subjects found. Please run class and subject seeders first.');
            return;
        }

        $materials = [
            // Matematika Materials
            [
                'title' => 'Pengenalan Aljabar Dasar',
                'description' => 'Materi pengenalan konsep dasar aljabar untuk siswa kelas X. Mencakup variabel, konstanta, dan operasi dasar.',
                'type' => 'document',
                'subject_name' => 'Matematika',
                'is_published' => true,
            ],
            [
                'title' => 'Video Tutorial Persamaan Linear',
                'description' => 'Video pembelajaran tentang cara menyelesaikan persamaan linear satu variabel dengan berbagai metode.',
                'type' => 'video',
                'subject_name' => 'Matematika',
                'external_link' => 'https://www.youtube.com/watch?v=example',
                'is_published' => true,
            ],
            [
                'title' => 'Tugas Latihan Soal Aljabar',
                'description' => 'Kerjakan 20 soal latihan aljabar yang telah disediakan. Kumpulkan dalam bentuk PDF.',
                'type' => 'assignment',
                'subject_name' => 'Matematika',
                'due_date' => now()->addDays(7),
                'max_score' => 100,
                'is_published' => true,
            ],

            // Bahasa Indonesia Materials
            [
                'title' => 'Teks Eksposisi dan Strukturnya',
                'description' => 'Materi pembelajaran tentang teks eksposisi, ciri-ciri, struktur, dan contoh-contohnya.',
                'type' => 'document',
                'subject_name' => 'Bahasa Indonesia',
                'is_published' => true,
            ],
            [
                'title' => 'Kuis Pemahaman Teks Eksposisi',
                'description' => 'Kuis online untuk menguji pemahaman siswa tentang materi teks eksposisi.',
                'type' => 'quiz',
                'subject_name' => 'Bahasa Indonesia',
                'max_score' => 80,
                'is_published' => true,
            ],

            // Bahasa Inggris Materials
            [
                'title' => 'Simple Present Tense',
                'description' => 'Penjelasan lengkap tentang Simple Present Tense, penggunaan, dan contoh kalimat.',
                'type' => 'document',
                'subject_name' => 'Bahasa Inggris',
                'is_published' => true,
            ],
            [
                'title' => 'English Grammar Practice',
                'description' => 'Link ke website latihan grammar bahasa Inggris interaktif.',
                'type' => 'link',
                'subject_name' => 'Bahasa Inggris',
                'external_link' => 'https://www.englishgrammar.org',
                'is_published' => true,
            ],

            // Pendidikan Agama Islam Materials
            [
                'title' => 'Akhlak Mulia dalam Islam',
                'description' => 'Materi tentang pentingnya akhlak mulia dalam kehidupan sehari-hari menurut ajaran Islam.',
                'type' => 'document',
                'subject_name' => 'Pendidikan Agama Islam',
                'is_published' => true,
            ],
            [
                'title' => 'Tugas Refleksi Akhlak',
                'description' => 'Buatlah refleksi tentang penerapan akhlak mulia dalam kehidupan sehari-hari Anda.',
                'type' => 'assignment',
                'subject_name' => 'Pendidikan Agama Islam',
                'due_date' => now()->addDays(10),
                'max_score' => 90,
                'is_published' => true,
            ],

            // Sejarah Indonesia Materials
            [
                'title' => 'Perjuangan Kemerdekaan Indonesia',
                'description' => 'Materi tentang perjuangan bangsa Indonesia dalam meraih kemerdekaan dari penjajahan.',
                'type' => 'document',
                'subject_name' => 'Sejarah Indonesia',
                'is_published' => true,
            ],
            [
                'title' => 'Video Dokumenter Proklamasi',
                'description' => 'Video dokumenter tentang peristiwa proklamasi kemerdekaan Indonesia 17 Agustus 1945.',
                'type' => 'video',
                'subject_name' => 'Sejarah Indonesia',
                'external_link' => 'https://www.youtube.com/watch?v=sejarah-indonesia',
                'is_published' => true,
            ],
        ];

        foreach ($materials as $materialData) {
            // Find subject by name
            $subject = $subjects->firstWhere('name', $materialData['subject_name']);
            if (!$subject) continue;

            // Get random class and teacher
            $class = $classes->random();
            $teacher = $teachers->random();

            Material::create([
                'title' => $materialData['title'],
                'description' => $materialData['description'],
                'subject_id' => $subject->id,
                'class_id' => $class->id,
                'teacher_id' => $teacher->id,
                'type' => $materialData['type'],
                'external_link' => $materialData['external_link'] ?? null,
                'due_date' => $materialData['due_date'] ?? null,
                'max_score' => $materialData['max_score'] ?? null,
                'is_published' => $materialData['is_published'],
                'is_active' => true,
                'published_at' => $materialData['is_published'] ? now() : null,
            ]);
        }

        $this->command->info('Materials seeded successfully!');
    }
}
