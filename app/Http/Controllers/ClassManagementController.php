<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\ClassSubject;
use App\Models\Teacher;
use App\Models\Learner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClassManagementController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with(['subjects', 'learners'])
            ->active()
            ->orderBy('grade')
            ->orderBy('major')
            ->orderBy('class_number')
            ->get();

        $classStats = [
            'total_classes' => $classes->count(),
            'grade_10' => $classes->where('grade', 10)->count(),
            'grade_11' => $classes->where('grade', 11)->count(),
            'grade_12' => $classes->where('grade', 12)->count(),
            'total_students' => $classes->sum('current_students'),
            'majors' => $classes->groupBy('major')->map->count(),
        ];

        return view('admin.classes.index', compact('classes', 'classStats'));
    }

    public function create()
    {
        $teachers = Teacher::where('is_active', true)->get();
        $majors = ['TJKT', 'PPLG', 'TKR', 'TSM', 'AKL'];
        $grades = [10, 11, 12];
        
        return view('admin.classes.create', compact('teachers', 'majors', 'grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade' => 'required|integer|in:10,11,12',
            'major' => 'required|string|in:TJKT,PPLG,TKR,TSM,AKL',
            'class_number' => 'required|integer|min:1|max:10',
            'homeroom_teacher' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:50',
            'academic_year' => 'required|string|max:20',
        ]);

        // Generate class name
        $gradeRoman = ['10' => 'X', '11' => 'XI', '12' => 'XII'][$request->grade];
        $className = "{$gradeRoman} {$request->major} {$request->class_number}";

        // Check if class already exists
        $existingClass = SchoolClass::where('name', $className)
            ->where('academic_year', $request->academic_year)
            ->first();

        if ($existingClass) {
            return back()->withErrors(['class_number' => 'Kelas dengan nama tersebut sudah ada.'])->withInput();
        }

        SchoolClass::create([
            'name' => $className,
            'grade' => $request->grade,
            'major' => $request->major,
            'class_number' => $request->class_number,
            'homeroom_teacher' => $request->homeroom_teacher,
            'capacity' => $request->capacity,
            'current_students' => 0,
            'academic_year' => $request->academic_year,
            'is_active' => true,
        ]);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show(SchoolClass $class)
    {
        $class->load(['subjects', 'learners']);
        
        // Get mandatory and optional subjects separately
        $mandatorySubjects = $class->subjects()->wherePivot('is_active', true)->get()->filter(function($subject) {
            return $subject->is_mandatory;
        });
            
        $optionalSubjects = $class->subjects()->wherePivot('is_active', true)->get()->filter(function($subject) {
            return !$subject->is_mandatory;
        });
        
        // Get available subjects that can be added to this class
        $availableSubjects = Subject::active()
            ->where('is_mandatory', false)
            ->where(function($query) use ($class) {
                $query->where('grade_level', $class->grade)
                      ->orWhere('grade_level', 'all');
            })
            ->where(function($query) use ($class) {
                $query->whereNull('majors')
                      ->orWhereJsonContains('majors', $class->major);
            })
            ->whereNotIn('id', $class->subjects->pluck('id'))
            ->get();

        // Get all subjects available for this class (for assignment modal)
        $subjects = Subject::active()
            ->where(function($query) use ($class) {
                $query->where('grade_level', $class->grade)
                      ->orWhere('grade_level', 'all');
            })
            ->where(function($query) use ($class) {
                $query->whereNull('majors')
                      ->orWhereJsonContains('majors', $class->major);
            })
            ->whereNotIn('id', $class->subjects->pluck('id'))
            ->get();

        return view('admin.classes.show', compact('class', 'mandatorySubjects', 'optionalSubjects', 'availableSubjects', 'subjects'));
    }

    public function edit(SchoolClass $class)
    {
        $teachers = Teacher::where('is_active', true)->get();
        $majors = ['TJKT', 'PPLG', 'TKR', 'TSM', 'AKL'];
        $grades = [10, 11, 12];
        
        return view('admin.classes.edit', compact('class', 'teachers', 'majors', 'grades'));
    }

    public function update(Request $request, SchoolClass $class)
    {
        $request->validate([
            'grade' => 'required|integer|in:10,11,12',
            'major' => 'required|string|in:TJKT,PPLG,TKR,TSM,AKL',
            'class_number' => 'required|integer|min:1|max:10',
            'homeroom_teacher' => 'nullable|string|max:255',
            'capacity' => 'required|integer|min:1|max:50',
            'academic_year' => 'required|string|max:20',
        ]);

        // Generate new class name
        $gradeRoman = ['10' => 'X', '11' => 'XI', '12' => 'XII'][$request->grade];
        $className = "{$gradeRoman} {$request->major} {$request->class_number}";

        // Check if class name already exists (except current class)
        $existingClass = SchoolClass::where('name', $className)
            ->where('academic_year', $request->academic_year)
            ->where('id', '!=', $class->id)
            ->first();

        if ($existingClass) {
            return back()->withErrors(['class_number' => 'Kelas dengan nama tersebut sudah ada.'])->withInput();
        }

        $class->update([
            'name' => $className,
            'grade' => $request->grade,
            'major' => $request->major,
            'class_number' => $request->class_number,
            'homeroom_teacher' => $request->homeroom_teacher,
            'capacity' => $request->capacity,
            'academic_year' => $request->academic_year,
        ]);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(SchoolClass $class)
    {
        // Check if class has students
        if ($class->learners()->count() > 0) {
            return back()->withErrors(['delete' => 'Tidak dapat menghapus kelas yang masih memiliki siswa.']);
        }

        // Detach subjects
        $class->subjects()->detach();
        
        // Delete class
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }

    // Student management methods
    public function students(SchoolClass $class)
    {
        $students = $class->learners()->orderBy('name')->get();
        
        return view('admin.classes.students', compact('class', 'students'));
    }

    public function createStudent(SchoolClass $class)
    {
        return view('admin.classes.create-student', compact('class'));
    }

    public function storeStudent(Request $request, SchoolClass $class)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,email|unique:learners,student_id',
            'password' => 'required|string|min:6',
        ]);

        // Check class capacity
        if ($class->current_students >= $class->capacity) {
            return back()->withErrors(['capacity' => 'Kelas sudah penuh.'])->withInput();
        }

        DB::beginTransaction();
        
        try {
            // Generate auto data
            $currentYear = date('Y');
            $studentCount = Learner::whereYear('created_at', $currentYear)->count() + 1;
            $autoNIS = $currentYear . str_pad($studentCount, 3, '0', STR_PAD_LEFT);
            $autoEmail = $request->username . '@student.edufikri.com';
            
            // Create User account for login
            $user = User::create([
                'name' => $request->name,
                'email' => $autoEmail,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(), // Auto verify for students
            ]);
            
            // Assign learner role
            $user->assignRole('learner');
            
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
                'grade_level' => $class->grade, // Auto from class
                'section' => $class->name, // Auto from class
                'birth_date' => null, // Can be filled later
                'gender' => null, // Can be filled later
                'address' => 'Belum diisi', // Default value
                'phone' => null,
                'parent_name' => 'Belum diisi', // Default value
                'parent_phone' => null,
                'enrollment_date' => now(),
                'is_active' => true,
            ]);

            // Update class student count
            $class->increment('current_students');
            
            DB::commit();
            
            return redirect()->route('admin.classes.students', $class)
                ->with('success', "Siswa {$request->name} berhasil ditambahkan dengan akun login. Username: {$request->username}, Password: {$request->password}");
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating student: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'Gagal menambahkan siswa. Silakan coba lagi.'])->withInput();
        }
    }

    public function editStudent(SchoolClass $class, Learner $student)
    {
        return view('admin.classes.edit-student', compact('class', 'student'));
    }

    public function updateStudent(Request $request, SchoolClass $class, Learner $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:learners,email,' . $student->id,
            'student_id' => 'required|string|unique:learners,student_id,' . $student->id,
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'parent_name' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:20',
        ]);

        $student->update($request->all());

        return redirect()->route('admin.classes.students', $class)
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroyStudent(SchoolClass $class, Learner $student)
    {
        $student->delete();
        
        // Update class student count
        $class->decrement('current_students');

        return redirect()->route('admin.classes.students', $class)
            ->with('success', 'Siswa berhasil dihapus dari kelas.');
    }

    public function subjects()
    {
        $subjects = Subject::active()
            ->orderBy('category')
            ->orderBy('grade_level')
            ->orderBy('name')
            ->get()
            ->groupBy(['category', 'grade_level']);

        $stats = [
            'total' => Subject::active()->count(),
            'by_category' => Subject::active()->get()->groupBy('category')->map->count(),
            'by_grade' => Subject::active()->get()->groupBy('grade_level')->map->count(),
        ];

        return view('admin.subjects.index', compact('subjects', 'stats'));
    }

    public function assignSubjects(Request $request, SchoolClass $class)
    {
        $request->validate([
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
            'teachers.*' => 'nullable|string|max:255',
            'schedules.*' => 'nullable|string',
            'rooms.*' => 'nullable|string|max:50',
        ]);

        // Hapus assignment lama
        $class->subjects()->detach();

        // Assign subjects baru
        foreach ($request->subjects as $index => $subjectId) {
            $class->subjects()->attach($subjectId, [
                'teacher_name' => $request->teachers[$index] ?? null,
                'schedule_day' => $request->schedules[$index] ?? null,
                'room' => $request->rooms[$index] ?? null,
                'academic_year' => $class->academic_year,
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.classes.show', $class)
            ->with('success', 'Mata pelajaran berhasil diassign ke kelas.');
    }

    public function schedule()
    {
        $classes = SchoolClass::with(['subjects'])
            ->active()
            ->orderBy('grade')
            ->orderBy('major')
            ->orderBy('class_number')
            ->get();

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        
        return view('admin.schedule.index', compact('classes', 'days'));
    }

    public function dashboard()
    {
        // Data untuk dashboard yang sudah ada
        $userCount = \App\Models\User::count();
        $learnerCount = \App\Models\Learner::count();
        $mailLogCount = \App\Models\EmailLog::count();
        $announcementCount = \App\Models\Announcement::count();
        $attendanceCount = \App\Models\LearnerAttendance::count();

        // Data baru untuk kelas dan mata pelajaran
        $classCount = SchoolClass::active()->count();
        $subjectCount = Subject::active()->count();
        
        $classByGrade = SchoolClass::active()
            ->selectRaw('grade, COUNT(*) as count')
            ->groupBy('grade')
            ->pluck('count', 'grade');

        $classByMajor = SchoolClass::active()
            ->selectRaw('major, COUNT(*) as count')
            ->groupBy('major')
            ->pluck('count', 'major');

        $subjectByCategory = Subject::active()
            ->selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category');

        $totalStudents = SchoolClass::active()->sum('current_students');

        return view('admin.dashboard', compact(
            'userCount', 'learnerCount', 'mailLogCount', 'announcementCount', 
            'attendanceCount', 'classCount', 'subjectCount', 'classByGrade', 
            'classByMajor', 'subjectByCategory', 'totalStudents'
        ));
    }
}