<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MailLog;   
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Data lama
        $userCount = User::count();
        $learnerCount = DB::table('learners')->count();
        $mailLogCount = DB::table('email_logs')->count();
        $announcementCount = DB::table('announcements')->count();
        $attendanceCount = DB::table('learner_attendance')->count();

        // Data baru untuk kelas dan mata pelajaran
        $classCount = SchoolClass::active()->count();
        $subjectCount = Subject::active()->count();
        $teacherCount = \App\Models\Teacher::active()->count();
        
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

        $totalStudents = \App\Models\Learner::count(); // Data real dari tabel learners

        return view('admin.dashboard', compact(
            'userCount', 'learnerCount', 'mailLogCount', 'announcementCount', 
            'attendanceCount', 'classCount', 'subjectCount', 'teacherCount', 'classByGrade', 
            'classByMajor', 'subjectByCategory', 'totalStudents'
        ));
    }
}
