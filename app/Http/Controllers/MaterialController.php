<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display materials for student's class
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('learner')) {
            return $this->studentIndex();
        } elseif ($user->hasRole('employee')) {
            return $this->teacherIndex();
        } else {
            return $this->adminIndex();
        }
    }

    /**
     * Student view - materials for their class
     */
    public function studentIndex()
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner || !$learner->class_id) {
            return redirect()->route('learner.dashboard')->with('error', 'Data kelas tidak ditemukan.');
        }

        // Get materials for student's class
        $materials = Material::with(['subject', 'teacher'])
            ->where('class_id', $learner->class_id)
            ->published()
            ->active()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Group materials by subject
        $materialsBySubject = $materials->getCollection()->groupBy('subject.name');

        // Get recent assignments
        $recentAssignments = Material::with(['subject', 'teacher'])
            ->where('class_id', $learner->class_id)
            ->where('type', 'assignment')
            ->published()
            ->active()
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        return view('learner.materials', compact('materials', 'materialsBySubject', 'recentAssignments', 'learner'));
    }

    /**
     * Teacher view - materials they created
     */
    public function teacherIndex()
    {
        $user = auth()->user();
        $teacher = $user->teacher;
        
        if (!$teacher) {
            return redirect()->route('dashboard')->with('error', 'Data guru tidak ditemukan.');
        }

        $materials = Material::with(['subject', 'class'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('materials.teacher-index', compact('materials', 'teacher'));
    }

    /**
     * Admin view - all materials
     */
    public function adminIndex()
    {
        $materials = Material::with(['subject', 'class', 'teacher'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('materials.admin-index', compact('materials'));
    }

    /**
     * Show the form for creating a new material
     */
    public function create()
    {
        $subjects = Subject::active()->orderBy('name')->get();
        $classes = SchoolClass::active()->orderBy('name')->get();
        $teachers = Teacher::where('is_active', true)->orderBy('name')->get();

        return view('materials.create', compact('subjects', 'classes', 'teachers'));
    }

    /**
     * Store a newly created material
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:school_classes,id',
            'type' => 'required|in:document,video,link,assignment,quiz',
            'file' => 'nullable|file|max:10240', // 10MB max
            'external_link' => 'nullable|url',
            'due_date' => 'nullable|date|after:today',
            'max_score' => 'nullable|integer|min:1|max:100',
            'is_published' => 'boolean'
        ]);

        $data = $request->all();
        
        // Set teacher_id if user is a teacher
        if (auth()->user()->hasRole('employee') && auth()->user()->teacher) {
            $data['teacher_id'] = auth()->user()->teacher->id;
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('materials', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }

        // Set published_at if published
        if ($request->is_published) {
            $data['published_at'] = now();
        }

        Material::create($data);

        return redirect()->route('materials.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Display the specified material
     */
    public function show(Material $material)
    {
        $material->load(['subject', 'class', 'teacher']);
        
        // Check if user can access this material
        $user = auth()->user();
        if ($user->hasRole('learner')) {
            $learner = $user->learner;
            if (!$learner || $learner->class_id !== $material->class_id) {
                abort(403, 'Anda tidak memiliki akses ke materi ini.');
            }
        }

        return view('materials.show', compact('material'));
    }

    /**
     * Show materials by subject for student
     */
    public function bySubject(Subject $subject)
    {
        $user = auth()->user();
        $learner = $user->learner;
        
        if (!$learner || !$learner->class_id) {
            return redirect()->route('learner.dashboard')->with('error', 'Data kelas tidak ditemukan.');
        }

        $materials = Material::with(['teacher'])
            ->where('class_id', $learner->class_id)
            ->where('subject_id', $subject->id)
            ->published()
            ->active()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('learner.materials-by-subject', compact('materials', 'subject', 'learner'));
    }

    /**
     * Download material file
     */
    public function download(Material $material)
    {
        if (!$material->file_path || !Storage::disk('public')->exists($material->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($material->file_path, $material->file_name);
    }
}
