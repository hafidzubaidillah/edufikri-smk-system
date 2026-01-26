<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            // Guru Agama Islam
            [
                'name' => 'Ustadz Ahmad Fauzi, S.Ag',
                'email' => 'ahmad.fauzi@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Pendidikan Agama Islam',
                'subjects' => ['PAI', 'BARAB'],
                'status' => 'PNS',
                'specialization' => 'Pendidikan Agama Islam'
            ],
            
            // Guru Mata Pelajaran Umum
            [
                'name' => 'Dra. Siti Nurhaliza',
                'email' => 'siti.nurhaliza@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Pendidikan Pancasila dan Kewarganegaraan',
                'subjects' => ['PKN'],
                'status' => 'PNS',
                'specialization' => 'PKN'
            ],
            [
                'name' => 'Eko Prasetyo, S.Pd',
                'email' => 'eko.prasetyo@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Pendidikan Bahasa Indonesia',
                'subjects' => ['BIN'],
                'status' => 'PNS',
                'specialization' => 'Bahasa Indonesia'
            ],
            [
                'name' => 'Maya Sari, S.Pd',
                'email' => 'maya.sari@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Pendidikan Matematika',
                'subjects' => ['MTK'],
                'status' => 'PNS',
                'specialization' => 'Matematika'
            ],
            [
                'name' => 'Budi Santoso, S.Pd',
                'email' => 'budi.santoso@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Pendidikan Sejarah',
                'subjects' => ['SEJ'],
                'status' => 'Honorer',
                'specialization' => 'Sejarah'
            ],
            [
                'name' => 'Rina Kusuma, S.Pd',
                'email' => 'rina.kusuma@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Pendidikan Bahasa Inggris',
                'subjects' => ['BING'],
                'status' => 'PNS',
                'specialization' => 'Bahasa Inggris'
            ],
            [
                'name' => 'Agus Wijaya, S.Pd',
                'email' => 'agus.wijaya@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Pendidikan Jasmani',
                'subjects' => ['PJOK'],
                'status' => 'Honorer',
                'specialization' => 'Pendidikan Jasmani'
            ],
            [
                'name' => 'Dewi Lestari, S.Sn',
                'email' => 'dewi.lestari@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Seni Rupa',
                'subjects' => ['SBK'],
                'status' => 'Kontrak',
                'specialization' => 'Seni Budaya'
            ],

            // Guru TKJ & RPL
            [
                'name' => 'Joko Susilo, S.Kom',
                'email' => 'joko.susilo@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['SIJA', 'SIMDIG', 'TJKT'],
                'status' => 'PNS',
                'specialization' => 'Teknik Komputer Jaringan'
            ],
            [
                'name' => 'Rudi Hartono, S.T',
                'email' => 'rudi.hartono@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['PWPB', 'PBO', 'BASIS_DATA'],
                'status' => 'PNS',
                'specialization' => 'Rekayasa Perangkat Lunak'
            ],
            [
                'name' => 'Bambang Sujono, S.Kom',
                'email' => 'bambang.sujono@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Sistem Informasi',
                'subjects' => ['SIMDIG', 'BASIS_DATA'],
                'status' => 'Honorer',
                'specialization' => 'Sistem Informasi'
            ],
            [
                'name' => 'Heri Setiawan, S.Kom',
                'email' => 'heri.setiawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['PWPB', 'PBO'],
                'status' => 'Kontrak',
                'specialization' => 'Pemrograman'
            ],
            [
                'name' => 'Dedi Kurniawan, S.Kom',
                'email' => 'dedi.kurniawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['PBO', 'BASIS_DATA'],
                'status' => 'Honorer',
                'specialization' => 'Database'
            ],
            [
                'name' => 'Sari Indah, S.Kom',
                'email' => 'sari.indah@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Sistem Informasi',
                'subjects' => ['BASIS_DATA', 'SIMDIG'],
                'status' => 'PNS',
                'specialization' => 'Sistem Informasi'
            ],

            // Guru Otomotif (TKR & TSM)
            [
                'name' => 'Andi Pratama, S.T',
                'email' => 'andi.pratama@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Mesin',
                'subjects' => ['TBSM', 'PDTO'],
                'status' => 'PNS',
                'specialization' => 'Teknik Kendaraan Ringan'
            ],
            [
                'name' => 'Ahmad Rizki, S.T',
                'email' => 'ahmad.rizki@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Otomotif',
                'subjects' => ['PDTO', 'PKKR'],
                'status' => 'PNS',
                'specialization' => 'Mesin Otomotif'
            ],
            [
                'name' => 'Yudi Setiawan, S.T',
                'email' => 'yudi.setiawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Elektro',
                'subjects' => ['PKKR', 'KTSM'],
                'status' => 'Honorer',
                'specialization' => 'Kelistrikan Otomotif'
            ],
            [
                'name' => 'Fajar Nugroho, S.T',
                'email' => 'fajar.nugroho@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Mesin',
                'subjects' => ['PTSM', 'TBSM'],
                'status' => 'Kontrak',
                'specialization' => 'Teknik Sepeda Motor'
            ],
            [
                'name' => 'Wahyu Hidayat, S.T',
                'email' => 'wahyu.hidayat@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Elektro',
                'subjects' => ['KTSM', 'PKKR'],
                'status' => 'Honorer',
                'specialization' => 'Kelistrikan'
            ],

            // Guru Akuntansi (AKL)
            [
                'name' => 'Lina Marlina, S.E',
                'email' => 'lina.marlina@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Akuntansi',
                'subjects' => ['AKD', 'AKK'],
                'status' => 'PNS',
                'specialization' => 'Akuntansi'
            ],
            [
                'name' => 'Ratna Sari, S.E',
                'email' => 'ratna.sari@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Akuntansi',
                'subjects' => ['AKK', 'AKP'],
                'status' => 'PNS',
                'specialization' => 'Akuntansi Keuangan'
            ],
            [
                'name' => 'Indra Gunawan, S.E',
                'email' => 'indra.gunawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Manajemen',
                'subjects' => ['AKP', 'AKD'],
                'status' => 'Honorer',
                'specialization' => 'Manajemen Keuangan'
            ],

            // Guru Muatan Lokal
            [
                'name' => 'Sumarno, S.Pd',
                'email' => 'sumarno@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Pendidikan Bahasa Jawa',
                'subjects' => ['BJAWA'],
                'status' => 'Honorer',
                'specialization' => 'Bahasa Jawa'
            ],
            [
                'name' => 'Ustadz Muhammad Ali, S.Ag',
                'email' => 'muhammad.ali@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Bahasa Arab',
                'subjects' => ['BARAB', 'PAI'],
                'status' => 'Kontrak',
                'specialization' => 'Bahasa Arab'
            ],
        ];

        foreach ($teachers as $index => $teacherData) {
            // Generate NIP
            $teacherId = sprintf('19%02d%02d%03d', 
                rand(80, 99), // Tahun lahir
                rand(1, 12),  // Bulan lahir
                $index + 1    // Nomor urut
            );

            // Generate data tambahan
            $birthYear = 1980 + rand(0, 15); // Lahir 1980-1995
            $birthDate = date('Y-m-d', strtotime($birthYear . '-' . rand(1, 12) . '-' . rand(1, 28)));
            
            $joinYear = 2010 + rand(0, 15); // Mulai kerja 2010-2025
            $joinDate = date('Y-m-d', strtotime($joinYear . '-' . rand(1, 12) . '-' . rand(1, 28)));
            
            $phone = '08' . rand(1, 9) . rand(10000000, 99999999);
            
            $addresses = [
                'Jl. Magelang Raya No. ' . rand(1, 100) . ', Mungkid',
                'Jl. Borobudur No. ' . rand(1, 50) . ', Borobudur', 
                'Jl. Merapi No. ' . rand(1, 75) . ', Muntilan',
                'Jl. Diponegoro No. ' . rand(1, 200) . ', Magelang',
                'Jl. Ahmad Yani No. ' . rand(1, 150) . ', Mertoyudan'
            ];

            Teacher::create([
                'teacher_id' => $teacherId,
                'name' => $teacherData['name'],
                'email' => $teacherData['email'],
                'phone' => $phone,
                'birth_date' => $birthDate,
                'gender' => $teacherData['gender'],
                'address' => $addresses[array_rand($addresses)],
                'education' => $teacherData['education'],
                'major' => $teacherData['major'],
                'subjects' => $teacherData['subjects'],
                'status' => $teacherData['status'],
                'join_date' => $joinDate,
                'is_active' => true,
            ]);
        }
    }
}