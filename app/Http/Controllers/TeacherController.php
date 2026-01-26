<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Generate email otomatis berdasarkan nama guru
     * Format: nama.belakang@smk-ihsanulfikri.edu
     */
    private function generateEmail($name)
    {
        // Bersihkan nama dari karakter khusus dan ubah ke lowercase
        $cleanName = strtolower(trim($name));
        $cleanName = preg_replace('/[^a-z\s]/', '', $cleanName);
        
        // Pisahkan nama menjadi array dan hapus kata kosong
        $nameParts = array_filter(explode(' ', $cleanName));
        
        if (empty($nameParts)) {
            return 'guru@smk-ihsanulfikri.edu';
        }
        
        // Ambil nama depan dan belakang
        $firstName = $nameParts[0];
        $lastName = count($nameParts) > 1 ? end($nameParts) : $firstName;
        
        // Buat base email
        if (count($nameParts) == 1) {
            $baseEmail = $firstName;
        } else {
            $baseEmail = $firstName . '.' . $lastName;
        }
        
        $domain = '@smk-ihsanulfikri.edu';
        $email = $baseEmail . $domain;
        
        // Cek apakah email sudah ada, jika ya tambahkan angka
        $counter = 1;
        $originalBase = $baseEmail;
        
        while (User::where('email', $email)->exists()) {
            $baseEmail = $originalBase . $counter;
            $email = $baseEmail . $domain;
            $counter++;
        }
        
        return $email;
    }

    /**
     * Generate NIP unik untuk guru
     */
    private function generateNIP()
    {
        $year = date('Y');
        $baseNIP = 'GR' . $year;
        
        // Cari nomor urut terakhir
        $lastTeacher = Teacher::where('nip', 'LIKE', $baseNIP . '%')
                            ->orderBy('nip', 'desc')
                            ->first();
        
        if ($lastTeacher) {
            $lastNumber = (int) substr($lastTeacher->nip, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        $nip = $baseNIP . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        
        // Pastikan NIP unik
        while (Teacher::where('nip', $nip)->exists() || Teacher::where('teacher_id', $nip)->exists()) {
            $nextNumber++;
            $nip = $baseNIP . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }
        
        return $nip;
    }

    public function index()
    {
        $teachers = Teacher::with('user')->orderBy('name')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6',
            'nip' => 'nullable|string|max:50|unique:teachers,nip',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'subject_specialization' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();
        
        try {
            // Generate email otomatis jika tidak diisi
            $email = $request->email ?: $this->generateEmail($request->name);
            
            // Create User account for login
            $user = User::create([
                'name' => $request->name,
                'email' => $email,
                'password' => Hash::make($request->password),
                'plain_password' => $request->password,
                'email_verified_at' => now(), // Auto verify for teachers
            ]);
            
            // Assign teacher role
            $user->assignRole('employee');
            
            // Generate NIP if not provided
            $nip = $request->nip;
            if (!$nip) {
                $nip = 'GR' . date('Y') . str_pad(Teacher::count() + 1, 3, '0', STR_PAD_LEFT);
                
                // Ensure NIP is unique
                while (Teacher::where('nip', $nip)->exists() || Teacher::where('teacher_id', $nip)->exists()) {
                    $nip = 'GR' . date('Y') . str_pad(Teacher::count() + rand(1, 100), 3, '0', STR_PAD_LEFT);
                }
            }
            
            // Create Teacher profile
            $teacher = Teacher::create([
                'user_id' => $user->id,
                'teacher_id' => $nip, // Use NIP as teacher_id for compatibility
                'name' => $request->name,
                'email' => $email,
                'nip' => $nip,
                'phone' => $request->phone,
                'address' => $request->address ?? 'Belum diisi',
                'subject_specialization' => $request->subject_specialization,
                'education_level' => $request->education_level,
                'hire_date' => now(),
                'is_active' => true,
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.teachers.index')
                ->with('success', "Guru {$request->name} berhasil ditambahkan. Email: {$email}, Password: {$request->password}");
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating teacher: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'Gagal menambahkan guru. Silakan coba lagi.'])->withInput();
        }
    }

    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'nip' => 'nullable|string|max:50|unique:teachers,nip,' . $teacher->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'subject_specialization' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();
        
        try {
            // Update User
            $teacher->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            
            // Update Teacher
            $teacher->update([
                'teacher_id' => $request->nip ?: $teacher->teacher_id, // Update teacher_id if NIP changes
                'name' => $request->name,
                'email' => $request->email,
                'nip' => $request->nip,
                'phone' => $request->phone,
                'address' => $request->address,
                'subject_specialization' => $request->subject_specialization,
                'education_level' => $request->education_level,
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.teachers.index')
                ->with('success', 'Data guru berhasil diperbarui!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors(['error' => 'Gagal memperbarui data guru.'])->withInput();
        }
    }

    public function destroy(Teacher $teacher)
    {
        DB::beginTransaction();
        
        try {
            $name = $teacher->name;
            
            // Delete teacher record
            $teacher->delete();
            
            // Delete user account
            $teacher->user->delete();
            
            DB::commit();
            
            return redirect()->route('admin.teachers.index')
                ->with('success', "Guru {$name} berhasil dihapus.");
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors(['error' => 'Gagal menghapus guru.']);
        }
    }
    
    /**
     * Preview email yang akan di-generate berdasarkan nama
     */
    public function previewEmail(Request $request)
    {
        $name = $request->input('name');
        
        if (!$name) {
            return response()->json(['email' => '']);
        }
        
        $email = $this->generateEmail($name);
        
        return response()->json(['email' => $email]);
    }
}