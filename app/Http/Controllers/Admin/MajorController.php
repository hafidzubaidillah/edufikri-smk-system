<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::with(['headOfMajor'])->withCount(['classes'])->paginate(10);
        
        $stats = [
            'total_majors' => Major::count(),
            'active_majors' => Major::where('is_active', true)->count(),
            'total_capacity' => Major::sum('capacity'),
            'total_students' => Major::sum('current_students'),
        ];

        return view('admin.majors.index', compact('majors', 'stats'));
    }

    public function create()
    {
        // Get teachers that are not already head of major
        $teachers = Teacher::where('is_active', true)
                          ->whereNotIn('id', function($query) {
                              $query->select('head_of_major_id')
                                    ->from('majors')
                                    ->whereNotNull('head_of_major_id');
                          })
                          ->get();
        return view('admin.majors.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:majors',
            'name' => 'required|string|max:255|unique:majors',
            'description' => 'nullable|string',
            'head_of_major_id' => 'nullable|exists:teachers,id|unique:majors',
            'capacity' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ], [
            'code.unique' => 'Kode jurusan sudah digunakan.',
            'name.unique' => 'Nama jurusan sudah ada.',
            'head_of_major_id.unique' => 'Guru ini sudah menjadi kepala jurusan lain.',
            'head_of_major_id.exists' => 'Guru yang dipilih tidak valid.'
        ]);

        Major::create($request->all());

        return redirect()->route('admin.majors.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function show(Major $major)
    {
        $major->load(['classes', 'headOfMajor']);
        
        // Get subjects for this major
        $subjects = Subject::whereJsonContains('majors', $major->code)->get();
        
        return view('admin.majors.show', compact('major', 'subjects'));
    }

    public function edit(Major $major)
    {
        // Get teachers that are not already head of major (except current major's head)
        $teachers = Teacher::where('is_active', true)
                          ->where(function($query) use ($major) {
                              $query->whereNotIn('id', function($subQuery) use ($major) {
                                  $subQuery->select('head_of_major_id')
                                          ->from('majors')
                                          ->whereNotNull('head_of_major_id')
                                          ->where('id', '!=', $major->id);
                              })
                              ->orWhere('id', $major->head_of_major_id);
                          })
                          ->get();
        return view('admin.majors.edit', compact('major', 'teachers'));
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:majors,code,' . $major->id,
            'name' => 'required|string|max:255|unique:majors,name,' . $major->id,
            'description' => 'nullable|string',
            'head_of_major_id' => 'nullable|exists:teachers,id|unique:majors,head_of_major_id,' . $major->id,
            'capacity' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ], [
            'code.unique' => 'Kode jurusan sudah digunakan.',
            'name.unique' => 'Nama jurusan sudah ada.',
            'head_of_major_id.unique' => 'Guru ini sudah menjadi kepala jurusan lain.',
            'head_of_major_id.exists' => 'Guru yang dipilih tidak valid.'
        ]);

        $major->update($request->all());

        return redirect()->route('admin.majors.index')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Major $major)
    {
        // Check if major has classes
        if ($major->classes()->count() > 0) {
            return redirect()->route('admin.majors.index')
                ->with('error', 'Tidak dapat menghapus jurusan yang masih memiliki kelas.');
        }

        $major->delete();

        return redirect()->route('admin.majors.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}
