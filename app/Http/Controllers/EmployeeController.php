<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class EmployeeController extends Controller
{
     public function index()
    {
        // Later: fetch employee data here
        return view('employee.dashboard');
    }

    public function announcements()
    {
        // Get all announcements for teachers to view
        $announcements = Announcement::orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('teacher.announcements', compact('announcements'));
    }
}
