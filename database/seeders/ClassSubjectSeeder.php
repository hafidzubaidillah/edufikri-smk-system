<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;
use App\Models\Subject;

class ClassSubjectSeeder extends Seeder
{
    public function run(): void
    {
        $academicYear = '2025/2026';
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $timeSlots = [
            ['07:00', '07:45'],
            ['07:45', '08:30'],
            ['08:30', '09:15'],
            ['09:30', '10:15'], // istirahat 15 menit
            ['10:15', '11:00'],
            ['11:00', '11:45'],
            ['12:30', '13:15'], // istirahat sholat dzuhur
            ['13:15', '14:00'],
            ['14:00', '14:45'],
            ['15:00', '15:45'], // istirahat 15 menit
        ];

        $teachers = [
            'PAI' => 'Ustadz Ahmad Fauzi, S.Ag',
            'PKN' => 'Dra. Siti Nurhaliza',
            'BIN' => 'Eko Prasetyo, S.Pd',
            'MTK' => 'Maya Sari, S.Pd',
            'SEJ' => 'Budi Santoso, S.Pd',
            'BING' => 'Rina Kusuma, S.Pd',
            'PJOK' => 'Agus Wijaya, S.Pd',
            'SBK' => 'Dewi Lestari, S.Sn',
            'SIJA' => 'Joko Susilo, S.Kom',
            'TJKT' => 'Rudi Hartono, S.T',
            'SIMDIG' => 'Bambang Sujono, S.Kom',
            'PWPB' => 'Heri Setiawan, S.Kom',
            'PBO' => 'Dedi Kurniawan, S.Kom',
            'BASIS_DATA' => 'Sari Indah, S.Kom',
            'TBSM' => 'Andi Pratama, S.T',
            'PDTO' => 'Ahmad Rizki, S.T',
            'PKKR' => 'Yudi Setiawan, S.T',
            'PTSM' => 'Fajar Nugroho, S.T',
            'KTSM' => 'Wahyu Hidayat, S.T',
            'AKD' => 'Lina Marlina, S.E',
            'AKK' => 'Ratna Sari, S.E',
            'AKP' => 'Indra Gunawan, S.E',
            'BJAWA' => 'Sumarno, S.Pd',
            'BARAB' => 'Ustadz Muhammad Ali, S.Ag',
        ];

        $rooms = [
            'Lab Komputer 1', 'Lab Komputer 2', 'Lab Komputer 3',
            'Workshop Otomotif 1', 'Workshop Otomotif 2',
            'Ruang Kelas 1', 'Ruang Kelas 2', 'Ruang Kelas 3', 'Ruang Kelas 4', 'Ruang Kelas 5',
            'Ruang Kelas 6', 'Ruang Kelas 7', 'Ruang Kelas 8', 'Ruang Kelas 9', 'Ruang Kelas 10',
            'Lab Akuntansi', 'Perpustakaan', 'Aula', 'Lapangan Olahraga'
        ];

        $classes = SchoolClass::all();
        
        foreach ($classes as $class) {
            // Ambil mata pelajaran yang sesuai dengan kelas
            $subjects = Subject::where(function($query) use ($class) {
                $query->where('grade_level', $class->grade)
                      ->orWhere('grade_level', 'all');
            })->where('is_active', true)->get()->filter(function($subject) use ($class) {
                return $subject->isForMajor($class->major);
            });

            $currentTimeSlot = 0;
            $currentDay = 0;

            foreach ($subjects as $subject) {
                // Tentukan hari dan waktu
                $day = $days[$currentDay % count($days)];
                $startTime = $timeSlots[$currentTimeSlot % count($timeSlots)][0];
                $endTime = $timeSlots[$currentTimeSlot % count($timeSlots)][1];
                
                // Pilih ruangan berdasarkan mata pelajaran
                $room = $this->selectRoom($subject, $rooms);

                // Assign mata pelajaran ke kelas
                $class->subjects()->attach($subject->id, [
                    'teacher_name' => $teachers[$subject->code] ?? 'Guru Belum Ditentukan',
                    'teacher_email' => null,
                    'schedule_day' => $day,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'room' => $room,
                    'academic_year' => $academicYear,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Pindah ke slot waktu berikutnya
                $currentTimeSlot++;
                
                // Jika sudah mencapai akhir hari, pindah ke hari berikutnya
                if ($currentTimeSlot % 8 == 0) { // 8 jam pelajaran per hari
                    $currentDay++;
                    $currentTimeSlot = 0;
                }
            }
        }
    }

    private function selectRoom($subject, $rooms)
    {
        // Pilih ruangan berdasarkan kategori mata pelajaran
        if (in_array($subject->code, ['SIJA', 'TJKT', 'SIMDIG', 'PWPB', 'PBO', 'BASIS_DATA'])) {
            return collect(['Lab Komputer 1', 'Lab Komputer 2', 'Lab Komputer 3'])->random();
        }
        
        if (in_array($subject->code, ['TBSM', 'PDTO', 'PKKR', 'PTSM', 'KTSM'])) {
            return collect(['Workshop Otomotif 1', 'Workshop Otomotif 2'])->random();
        }
        
        if (in_array($subject->code, ['AKD', 'AKK', 'AKP'])) {
            return 'Lab Akuntansi';
        }
        
        if ($subject->code == 'PJOK') {
            return 'Lapangan Olahraga';
        }
        
        // Mata pelajaran umum menggunakan ruang kelas biasa
        return collect([
            'Ruang Kelas 1', 'Ruang Kelas 2', 'Ruang Kelas 3', 'Ruang Kelas 4', 'Ruang Kelas 5',
            'Ruang Kelas 6', 'Ruang Kelas 7', 'Ruang Kelas 8', 'Ruang Kelas 9', 'Ruang Kelas 10'
        ])->random();
    }
}