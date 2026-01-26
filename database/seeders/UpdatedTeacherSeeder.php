<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class UpdatedTeacherSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dengan delete (bukan truncate)
        Teacher::query()->delete();
        
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

            // Guru TJKT (Teknik Jaringan Komputer dan Telekomunikasi)
            [
                'name' => 'Joko Susilo, S.Kom',
                'email' => 'joko.susilo@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['TJKT_DASAR', 'TJKT_TEKNOLOGI', 'TJKT_ADMINISTRASI', 'SIMDIG'],
                'status' => 'PNS',
                'specialization' => 'Teknik Jaringan Komputer dan Telekomunikasi'
            ],
            [
                'name' => 'Eko Prasetyo, S.T',
                'email' => 'eko.prasetyo.tjkt@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Telekomunikasi',
                'subjects' => ['TJKT_TEKNOLOGI', 'TJKT_ADMINISTRASI', 'BASIS_DATA'],
                'status' => 'PNS',
                'specialization' => 'Jaringan dan Telekomunikasi'
            ],
            [
                'name' => 'Sari Indah, S.Kom',
                'email' => 'sari.indah@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Sistem Informasi',
                'subjects' => ['TJKT_DASAR', 'BASIS_DATA', 'SIMDIG'],
                'status' => 'PNS',
                'specialization' => 'Sistem Informasi Jaringan'
            ],

            // Guru PPLG (Pengembangan Perangkat Lunak dan Gim)
            [
                'name' => 'Rudi Hartono, S.Kom',
                'email' => 'rudi.hartono@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['PPLG_DASAR', 'PPLG_PEMROGRAMAN', 'PPLG_WEB'],
                'status' => 'PNS',
                'specialization' => 'Pengembangan Perangkat Lunak dan Gim'
            ],
            [
                'name' => 'Heri Setiawan, S.Kom',
                'email' => 'heri.setiawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['PPLG_PEMROGRAMAN', 'PPLG_WEB', 'BASIS_DATA'],
                'status' => 'Kontrak',
                'specialization' => 'Pemrograman Web dan Mobile'
            ],
            [
                'name' => 'Dedi Kurniawan, S.Kom',
                'email' => 'dedi.kurniawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Informatika',
                'subjects' => ['PPLG_DASAR', 'BASIS_DATA', 'SIMDIG'],
                'status' => 'Honorer',
                'specialization' => 'Database dan Pemrograman'
            ],

            // Guru Otomotif (TKR & TSM)
            [
                'name' => 'Andi Pratama, S.T',
                'email' => 'andi.pratama@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Mesin',
                'subjects' => ['TKR_DASAR', 'TKR_PERAWATAN'],
                'status' => 'PNS',
                'specialization' => 'Teknik Kendaraan Ringan'
            ],
            [
                'name' => 'Ahmad Rizki, S.T',
                'email' => 'ahmad.rizki@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Otomotif',
                'subjects' => ['TKR_PERAWATAN', 'TKR_KELISTRIKAN'],
                'status' => 'PNS',
                'specialization' => 'Mesin Otomotif'
            ],
            [
                'name' => 'Yudi Setiawan, S.T',
                'email' => 'yudi.setiawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Elektro',
                'subjects' => ['TKR_KELISTRIKAN', 'TSM_KELISTRIKAN'],
                'status' => 'Honorer',
                'specialization' => 'Kelistrikan Otomotif'
            ],
            [
                'name' => 'Fajar Nugroho, S.T',
                'email' => 'fajar.nugroho@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Mesin',
                'subjects' => ['TSM_PERAWATAN', 'TKR_DASAR'],
                'status' => 'Kontrak',
                'specialization' => 'Teknik Sepeda Motor'
            ],
            [
                'name' => 'Wahyu Hidayat, S.T',
                'email' => 'wahyu.hidayat@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Teknik Elektro',
                'subjects' => ['TSM_KELISTRIKAN', 'TKR_KELISTRIKAN'],
                'status' => 'Honorer',
                'specialization' => 'Kelistrikan Kendaraan'
            ],

            // Guru Akuntansi (AKL)
            [
                'name' => 'Lina Marlina, S.E',
                'email' => 'lina.marlina@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Akuntansi',
                'subjects' => ['AKL_DASAR', 'AKL_KEUANGAN'],
                'status' => 'PNS',
                'specialization' => 'Akuntansi dan Keuangan Lembaga'
            ],
            [
                'name' => 'Ratna Sari, S.E',
                'email' => 'ratna.sari@smkitihsanulfikri.sch.id',
                'gender' => 'P',
                'education' => 'S1',
                'major' => 'Akuntansi',
                'subjects' => ['AKL_KEUANGAN', 'AKL_PERUSAHAAN'],
                'status' => 'PNS',
                'specialization' => 'Akuntansi Keuangan'
            ],
            [
                'name' => 'Indra Gunawan, S.E',
                'email' => 'indra.gunawan@smkitihsanulfikri.sch.id',
                'gender' => 'L',
                'education' => 'S1',
                'major' => 'Manajemen',
                'subjects' => ['AKL_PERUSAHAAN', 'AKL_DASAR'],
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