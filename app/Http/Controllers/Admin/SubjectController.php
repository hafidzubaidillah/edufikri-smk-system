<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('classes')
            ->orderBy('is_mandatory', 'desc')
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(15);

        // Calculate statistics
        $stats = [
            'total' => Subject::count(),
            'mandatory' => Subject::where('is_mandatory', true)->count(),
            'optional' => Subject::where('is_mandatory', false)->count(),
            'active' => Subject::where('is_active', true)->count(),
        ];

        return view('admin.subjects.index', compact('subjects', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = [
            'umum' => 'Mata Pelajaran Umum',
            'kejuruan' => 'Mata Pelajaran Kejuruan',
            'muatan_lokal' => 'Muatan Lokal',
            'agama' => 'Pendidikan Agama Islam'
        ];

        $gradeLevels = [
            'all' => 'Semua Tingkat',
            '10' => 'Kelas X',
            '11' => 'Kelas XI',
            '12' => 'Kelas XII'
        ];

        $majors = [
            'TKJ' => 'Teknik Komputer dan Jaringan',
            'RPL' => 'Rekayasa Perangkat Lunak',
            'TKR' => 'Teknik Kendaraan Ringan',
            'TSM' => 'Teknik Sepeda Motor',
            'AKL' => 'Akuntansi dan Keuangan Lembaga'
        ];

        return view('admin.subjects.create', compact('categories', 'gradeLevels', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code',
            'category' => 'required|in:umum,kejuruan,muatan_lokal,agama',
            'hours_per_week' => 'required|integer|min:1|max:20',
            'grade_level' => 'required|in:all,10,11,12',
            'description' => 'nullable|string',
            'majors' => 'nullable|array',
            'is_mandatory' => 'boolean'
        ]);

        $data = $request->all();
        
        // Generate code if not provided
        if (empty($data['code'])) {
            $data['code'] = strtoupper(Str::slug($data['name'], '_'));
        }

        // Convert majors array
        if (empty($data['majors'])) {
            $data['majors'] = null;
        }

        $subject = Subject::create($data);

        // If mandatory, automatically assign to all existing classes
        if ($subject->is_mandatory) {
            $this->assignMandatorySubjectToClasses($subject);
        }

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load('classes.learners');
        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $categories = [
            'umum' => 'Mata Pelajaran Umum',
            'kejuruan' => 'Mata Pelajaran Kejuruan',
            'muatan_lokal' => 'Muatan Lokal',
            'agama' => 'Pendidikan Agama Islam'
        ];

        $gradeLevels = [
            'all' => 'Semua Tingkat',
            '10' => 'Kelas X',
            '11' => 'Kelas XI',
            '12' => 'Kelas XII'
        ];

        $majors = [
            'TKJ' => 'Teknik Komputer dan Jaringan',
            'RPL' => 'Rekayasa Perangkat Lunak',
            'TKR' => 'Teknik Kendaraan Ringan',
            'TSM' => 'Teknik Sepeda Motor',
            'AKL' => 'Akuntansi dan Keuangan Lembaga'
        ];

        return view('admin.subjects.edit', compact('subject', 'categories', 'gradeLevels', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20|unique:subjects,code,' . $subject->id,
            'category' => 'required|in:umum,kejuruan,muatan_lokal,agama',
            'hours_per_week' => 'required|integer|min:1|max:20',
            'grade_level' => 'required|in:all,10,11,12',
            'description' => 'nullable|string',
            'majors' => 'nullable|array',
            'is_mandatory' => 'boolean'
        ]);

        $data = $request->all();
        
        // Convert majors array
        if (empty($data['majors'])) {
            $data['majors'] = null;
        }

        $wasMandatory = $subject->is_mandatory;
        $subject->update($data);

        // If changed to mandatory, assign to all classes
        if (!$wasMandatory && $subject->is_mandatory) {
            $this->assignMandatorySubjectToClasses($subject);
        }

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        // Check if subject is assigned to any classes
        if ($subject->classes()->count() > 0) {
            return redirect()->route('admin.subjects.index')
                ->with('error', 'Mata pelajaran tidak dapat dihapus karena masih digunakan di kelas.');
        }

        $subject->delete();

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }

    /**
     * Assign mandatory subject to all compatible classes
     */
    private function assignMandatorySubjectToClasses(Subject $subject)
    {
        $classes = SchoolClass::active()->get();

        foreach ($classes as $class) {
            // Check if subject is compatible with class
            if ($this->isSubjectCompatibleWithClass($subject, $class)) {
                // Check if not already assigned
                if (!$class->subjects()->where('subject_id', $subject->id)->exists()) {
                    $class->subjects()->attach($subject->id, [
                        'academic_year' => date('Y') . '/' . (date('Y') + 1),
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }

    /**
     * Check if subject is compatible with class
     */
    private function isSubjectCompatibleWithClass(Subject $subject, SchoolClass $class)
    {
        // Check grade level
        if ($subject->grade_level !== 'all' && $subject->grade_level != $class->grade) {
            return false;
        }

        // Check major compatibility
        if ($subject->majors && !in_array($class->major, $subject->majors)) {
            return false;
        }

        return true;
    }

    /**
     * Assign subject to class
     */
    public function assignToClass(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:school_classes,id',
            'teacher_name' => 'nullable|string|max:255',
            'teacher_email' => 'nullable|email',
            'schedule_day' => 'nullable|in:monday,tuesday,wednesday,thursday,friday,saturday',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'room' => 'nullable|string|max:50'
        ]);

        $subject = Subject::findOrFail($request->subject_id);
        $class = SchoolClass::findOrFail($request->class_id);

        // Check if already assigned
        if ($class->subjects()->where('subject_id', $subject->id)->exists()) {
            return response()->json(['error' => 'Mata pelajaran sudah ditugaskan ke kelas ini.'], 400);
        }

        $class->subjects()->attach($subject->id, [
            'teacher_name' => $request->teacher_name,
            'teacher_email' => $request->teacher_email,
            'schedule_day' => $request->schedule_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room' => $request->room,
            'academic_year' => date('Y') . '/' . (date('Y') + 1),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['success' => 'Mata pelajaran berhasil ditugaskan ke kelas.']);
    }

    /**
     * Assign mandatory subjects to all classes
     */
    public function assignMandatoryToAllClasses()
    {
        $classes = SchoolClass::active()->get();
        $totalAssigned = 0;
        $processedClasses = 0;

        foreach ($classes as $class) {
            $assigned = $this->assignMandatorySubjectsToClass($class);
            $totalAssigned += $assigned;
            if ($assigned > 0) {
                $processedClasses++;
            }
        }

        return response()->json([
            'success' => "Berhasil menugaskan {$totalAssigned} mata pelajaran wajib ke {$processedClasses} kelas.",
            'total_assigned' => $totalAssigned,
            'processed_classes' => $processedClasses
        ]);
    }

    /**
     * Assign mandatory subjects to a specific class
     */
    private function assignMandatorySubjectsToClass(SchoolClass $class)
    {
        $assigned = 0;
        $mandatorySubjects = Subject::mandatory()
            ->active()
            ->where(function ($query) use ($class) {
                $query->where('grade_level', 'all')
                      ->orWhere('grade_level', $class->grade);
            })
            ->where(function ($query) use ($class) {
                $query->whereNull('majors')
                      ->orWhereJsonContains('majors', $class->major);
            })
            ->get();

        foreach ($mandatorySubjects as $subject) {
            if (!$class->subjects()->where('subject_id', $subject->id)->exists()) {
                $class->subjects()->attach($subject->id, [
                    'academic_year' => date('Y') . '/' . (date('Y') + 1),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $assigned++;
            }
        }

        return $assigned;
    }
}