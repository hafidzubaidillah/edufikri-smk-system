<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Learner;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LearnerController extends Controller
{
    public function index()
    {
         if (auth()->user()->hasRole('learner')) {
        return view('learner.dashboard');
    }

    // For admin viewing learner records
        // $learners = Learner::all();
         $learners = Learner::orderByRaw("CONCAT(lname, fname, mname) ASC")->get();
        return view('admin.learners.index', compact('learners'));
    }

    public function announcements()
    {
        // Get all announcements for students
        $announcements = \App\Models\Announcement::orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('learner.announcements', compact('announcements'));
    }

    public function schedule()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner) {
            return redirect()->route('learner.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // Get class subjects for the student's class
        $classSubjects = \App\Models\ClassSubject::with(['subject', 'teacher'])
            ->where('class_id', $learner->class_id)
            ->get();
            
        return view('learner.schedule', compact('classSubjects', 'learner'));
    }

    public function grades()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner) {
            return redirect()->route('learner.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // For now, we'll show a placeholder since grades system isn't implemented yet
        return view('learner.grades', compact('learner'));
    }

    public function help()
    {
        return view('learner.help');
    }

    public function courses()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner) {
            return redirect()->route('learner.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // Get enrolled courses for the student
        $courses = collect([
            (object)[
                'id' => 1,
                'title' => 'Matematika Dasar',
                'description' => 'Pelajaran matematika untuk tingkat dasar',
                'progress' => 75,
                'instructor' => 'Pak Ahmad',
                'status' => 'active'
            ],
            (object)[
                'id' => 2,
                'title' => 'Bahasa Indonesia',
                'description' => 'Pembelajaran bahasa Indonesia yang baik dan benar',
                'progress' => 60,
                'instructor' => 'Bu Sari',
                'status' => 'active'
            ],
            (object)[
                'id' => 3,
                'title' => 'Bahasa Inggris',
                'description' => 'English language learning for beginners',
                'progress' => 45,
                'instructor' => 'Mr. John',
                'status' => 'active'
            ]
        ]);
        
        return view('learner.courses', compact('courses', 'learner'));
    }

    public function browseCourses()
    {
        // Available courses to browse
        $availableCourses = collect([
            (object)[
                'id' => 4,
                'title' => 'Fisika Lanjutan',
                'description' => 'Pelajaran fisika untuk tingkat lanjutan',
                'instructor' => 'Pak Budi',
                'duration' => '12 minggu',
                'level' => 'Menengah'
            ],
            (object)[
                'id' => 5,
                'title' => 'Kimia Organik',
                'description' => 'Memahami struktur dan reaksi senyawa organik',
                'instructor' => 'Bu Lisa',
                'duration' => '10 minggu',
                'level' => 'Lanjutan'
            ]
        ]);
        
        return view('learner.browse-courses', compact('availableCourses'));
    }

    public function progress()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner) {
            return redirect()->route('learner.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // Sample progress data
        $progressData = (object)[
            'overall_progress' => 65,
            'completed_courses' => 2,
            'active_courses' => 3,
            'certificates_earned' => 1,
            'study_hours' => 45
        ];
        
        return view('learner.progress', compact('progressData', 'learner'));
    }

    public function certificates()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner) {
            return redirect()->route('learner.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // Sample certificates
        $certificates = collect([
            (object)[
                'id' => 1,
                'course_name' => 'Matematika Dasar',
                'issued_date' => '2024-01-15',
                'certificate_number' => 'CERT-2024-001',
                'grade' => 'A'
            ],
            (object)[
                'id' => 2,
                'course_name' => 'Bahasa Indonesia',
                'issued_date' => '2024-02-20',
                'certificate_number' => 'CERT-2024-002',
                'grade' => 'B+'
            ]
        ]);
        
        return view('learner.certificates', compact('certificates', 'learner'));
    }

    public function community()
    {
        // Sample community posts/discussions
        $discussions = collect([
            (object)[
                'id' => 1,
                'title' => 'Tips Belajar Matematika Efektif',
                'author' => 'Ahmad Rizki',
                'replies' => 12,
                'created_at' => now()->subHours(2),
                'category' => 'Tips Belajar'
            ],
            (object)[
                'id' => 2,
                'title' => 'Diskusi Soal Fisika Bab 3',
                'author' => 'Siti Nurhaliza',
                'replies' => 8,
                'created_at' => now()->subHours(5),
                'category' => 'Diskusi Pelajaran'
            ]
        ]);
        
        return view('learner.community', compact('discussions'));
    }

    public function messages()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner) {
            return redirect()->route('learner.dashboard')->with('error', 'Data siswa tidak ditemukan.');
        }
        
        // Sample messages
        $messages = collect([
            (object)[
                'id' => 1,
                'from' => 'Pak Ahmad (Guru Matematika)',
                'subject' => 'Tugas Matematika Minggu Ini',
                'preview' => 'Jangan lupa mengerjakan tugas halaman 45-50...',
                'created_at' => now()->subHours(1),
                'is_read' => false
            ],
            (object)[
                'id' => 2,
                'from' => 'Admin Sekolah',
                'subject' => 'Pengumuman Ujian Tengah Semester',
                'preview' => 'Ujian tengah semester akan dilaksanakan...',
                'created_at' => now()->subHours(3),
                'is_read' => false
            ],
            (object)[
                'id' => 3,
                'from' => 'Bu Sari (Wali Kelas)',
                'subject' => 'Rapat Orang Tua',
                'preview' => 'Mengundang orang tua untuk hadir dalam rapat...',
                'created_at' => now()->subDays(1),
                'is_read' => true
            ]
        ]);
        
        return view('learner.messages', compact('messages', 'learner'));
    }

    public function myClass()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner || !$learner->class_id) {
            return redirect()->route('learner.dashboard')->with('error', 'Data kelas tidak ditemukan.');
        }
        
        // Get class information with subjects and classmates
        $class = \App\Models\SchoolClass::with(['subjects', 'learners'])
            ->findOrFail($learner->class_id);
            
        // Get mandatory and optional subjects
        $mandatorySubjects = $class->subjects->where('is_mandatory', true);
        $optionalSubjects = $class->subjects->where('is_mandatory', false);
        
        // Get classmates (excluding current student)
        $classmates = $class->learners->where('id', '!=', $learner->id);
        
        // Get class statistics
        $classStats = [
            'total_students' => $class->learners->count(),
            'male_students' => $class->learners->where('gender', 'L')->count(),
            'female_students' => $class->learners->where('gender', 'P')->count(),
            'total_subjects' => $class->subjects->count(),
            'mandatory_subjects' => $mandatorySubjects->count(),
            'optional_subjects' => $optionalSubjects->count(),
        ];
        
        return view('learner.my-class', compact('learner', 'class', 'mandatorySubjects', 'optionalSubjects', 'classmates', 'classStats'));
    }

    public function settings()
    {
        return redirect()->route('profile.edit');
    }

    public function store(Request $request)
    {
        // Debug: Log semua input yang diterima
        \Log::info('=== LEARNER STORE DEBUG START ===');
        \Log::info('Request method: ' . $request->method());
        \Log::info('Request URL: ' . $request->url());
        \Log::info('All input data:', $request->all());
        \Log::info('Headers:', $request->headers->all());
        
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:50|unique:users,email|unique:learners,student_id',
                'password' => 'required|string|min:6',
                'class_id' => 'required|exists:school_classes,id',
            ]);

            \Log::info('Validation passed successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed:', $e->errors());
            throw $e;
        }

        DB::beginTransaction();
        
        try {
            // Get class info
            $class = SchoolClass::findOrFail($request->class_id);
            \Log::info('Class found', ['class' => $class->name]);
            
            // Check class capacity
            if ($class->current_students >= $class->capacity) {
                \Log::warning('Class full', ['current' => $class->current_students, 'capacity' => $class->capacity]);
                return back()->withErrors(['class_id' => 'Kelas sudah penuh.'])->withInput();
            }
            
            // Generate auto data
            $currentYear = date('Y');
            $studentCount = Learner::whereYear('created_at', $currentYear)->count() + 1;
            $autoNIS = $currentYear . str_pad($studentCount, 3, '0', STR_PAD_LEFT);
            $autoEmail = $request->username . '@student.edufikri.com';
            
            \Log::info('Generated data', ['nis' => $autoNIS, 'email' => $autoEmail]);
            
            // Create User account for login
            $user = User::create([
                'name' => $request->name,
                'email' => $autoEmail,
                'password' => Hash::make($request->password),
                'plain_password' => $request->password,
                'email_verified_at' => now(), // Auto verify for students
            ]);
            
            \Log::info('User created', ['user_id' => $user->id]);
            
            // Assign learner role
            $user->assignRole('learner');
            \Log::info('Role assigned');
            
            // Create Learner profile
            $student = Learner::create([
                'user_id' => $user->id,
                'student_id' => $autoNIS,
                'fname' => $request->name, // Use full name as first name for now
                'mname' => '', // Empty middle name
                'lname' => '', // Empty last name
                'name' => $request->name,
                'email' => $autoEmail,
                'class_id' => $class->id,
                'grade_level' => $class->grade,
                'section' => $class->name,
                'birth_date' => null,
                'gender' => null,
                'address' => 'Belum diisi',
                'phone' => null,
                'parent_name' => 'Belum diisi',
                'parent_phone' => null,
                'enrollment_date' => now(),
                'is_active' => true,
            ]);

            \Log::info('Learner created', ['learner_id' => $student->id]);

            // Update class student count
            $class->increment('current_students');
            \Log::info('Class count updated');
            
            DB::commit();
            \Log::info('Transaction committed successfully');
            \Log::info('=== LEARNER STORE DEBUG END ===');
            
            return redirect()->back()->with('success', "Siswa {$request->name} berhasil ditambahkan dengan akun login. Username: {$request->username}, Password: {$request->password}");
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating student: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('=== LEARNER STORE DEBUG END (ERROR) ===');
            
            return back()->withErrors(['error' => 'Gagal menambahkan siswa. Silakan coba lagi.'])->withInput();
        }
    }

    public function update(Request $request, Learner $learner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:learners,email,' . $learner->id,
            'class_id' => 'required|exists:school_classes,id',
        ]);

        // Update class info if changed
        if ($request->class_id != $learner->class_id) {
            $newClass = \App\Models\SchoolClass::findOrFail($request->class_id);
            $learner->update([
                'name' => $request->name,
                'email' => $request->email,
                'class_id' => $request->class_id,
                'grade_level' => $newClass->grade,
                'section' => $newClass->name,
            ]);
        } else {
            $learner->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Learner $learner)
    {
        $learner->delete();

        return redirect()->back()->with('success', 'Learner deleted successfully!');
    }

    /**
     * Show detailed student information for admin
     */
    public function show(Learner $learner)
    {
        $learner->load(['user', 'schoolClass.subjects']);
        
        // Get class statistics
        $classStats = [];
        if ($learner->schoolClass) {
            $classStats = [
                'total_students' => $learner->schoolClass->learners()->count(),
                'male_students' => $learner->schoolClass->learners()->where('gender', 'L')->count(),
                'female_students' => $learner->schoolClass->learners()->where('gender', 'P')->count(),
                'total_subjects' => $learner->schoolClass->subjects()->count(),
            ];
        }
        
        return view('admin.learners.show', compact('learner', 'classStats'));
    }
}
