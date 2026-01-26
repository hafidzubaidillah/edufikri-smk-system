<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmailLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\LearnerAttendanceController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ClassManagementController;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/
// Welcome page — only for guests (not logged in)
Route::get('/', [SchoolController::class, 'index'])->middleware('guest');

// School Information Routes (Public)
Route::get('/tentang', [SchoolController::class, 'about'])->name('school.about');
Route::get('/informasi-sekolah', function() { return view('school.info'); })->name('school.info');
Route::get('/program-keahlian', [SchoolController::class, 'programs'])->name('school.programs');
Route::get('/fasilitas', [SchoolController::class, 'facilities'])->name('school.facilities');
Route::get('/berita', [SchoolController::class, 'news'])->name('school.news');
Route::get('/kontak', [SchoolController::class, 'contact'])->name('school.contact');


/*
|--------------------------------------------------------------------------
| Authenticated Redirect Based on Role
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $user = auth()->user();

    return match (true) {
        $user->hasRole('admin') => redirect('/admin/dashboard'),
        $user->hasRole('employee') => redirect('/employee/dashboard'),
        $user->hasRole('learner') => redirect('/learner/dashboard'),
        default => abort(403),
    };
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated User Routes (All Roles)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Show registration form
    Route::get('/register-user', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register.form');

    // Handle registration and OTP
    Route::post('/register-user', [RegisterController::class, 'registerByAdmin'])->name('admin.register.user');
    Route::get('/verify-otp', [RegisterController::class, 'showOtpForm'])->name('admin.otp.verify.form');
    Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('admin.otp.verify.submit');

    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Employee
    Route::get('/employee/dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');
    Route::get('/teacher/announcements', [EmployeeController::class, 'announcements'])->name('teacher.announcements');
    // Learner
    Route::get('/learner/dashboard', [LearnerController::class, 'index'])->name('learner.dashboard');
    Route::get('/learner/my-class', [LearnerController::class, 'myClass'])->name('learner.my-class');
    Route::get('/learner/materials', [\App\Http\Controllers\MaterialController::class, 'index'])->name('learner.materials');
    Route::get('/learner/materials/subject/{subject}', [\App\Http\Controllers\MaterialController::class, 'bySubject'])->name('learner.materials.by-subject');
    Route::get('/learner/courses', [LearnerController::class, 'courses'])->name('learner.courses');
    Route::get('/learner/browse-courses', [LearnerController::class, 'browseCourses'])->name('learner.browse-courses');
    Route::get('/learner/progress', [LearnerController::class, 'progress'])->name('learner.progress');
    Route::get('/learner/certificates', [LearnerController::class, 'certificates'])->name('learner.certificates');
    Route::get('/learner/community', [LearnerController::class, 'community'])->name('learner.community');
    Route::get('/learner/messages', [LearnerController::class, 'messages'])->name('learner.messages');
    Route::get('/learner/settings', [LearnerController::class, 'settings'])->name('learner.settings');
    Route::get('/learner/announcements', [LearnerController::class, 'announcements'])->name('learner.announcements');
    Route::get('/learner/schedule', [LearnerController::class, 'schedule'])->name('learner.schedule');
    Route::get('/learner/grades', [LearnerController::class, 'grades'])->name('learner.grades');
    Route::get('/learner/help', [LearnerController::class, 'help'])->name('learner.help');
    Route::get('/learner/courses', [LearnerController::class, 'courses'])->name('learner.courses');
    Route::get('/learner/browse-courses', [LearnerController::class, 'browseCourses'])->name('learner.browse-courses');
    Route::get('/learner/progress', [LearnerController::class, 'progress'])->name('learner.progress');
    Route::get('/learner/certificates', [LearnerController::class, 'certificates'])->name('learner.certificates');
    Route::get('/learner/community', [LearnerController::class, 'community'])->name('learner.community');
    Route::get('/learner/messages', [LearnerController::class, 'messages'])->name('learner.messages');
    Route::get('/learner/settings', [LearnerController::class, 'settings'])->name('learner.settings');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/sendmail', [UserController::class, 'sendMail'])->name('users.sendmail');
    Route::get('/users/sendmail', fn() => redirect()->route('users.index'));
    
    // Password Management
    Route::get('/users/passwords', [UserController::class, 'showPasswords'])->name('admin.users.passwords');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');
    Route::post('/users/{user}/generate-password', [UserController::class, 'generatePassword'])->name('admin.users.generate-password');

    // Class Management
    Route::get('/admin/classes', [ClassManagementController::class, 'index'])->name('admin.classes.index');
    Route::get('/admin/classes/create', [ClassManagementController::class, 'create'])->name('admin.classes.create');
    Route::post('/admin/classes', [ClassManagementController::class, 'store'])->name('admin.classes.store');
    Route::get('/admin/classes/{class}', [ClassManagementController::class, 'show'])->name('admin.classes.show');
    Route::get('/admin/classes/{class}/edit', [ClassManagementController::class, 'edit'])->name('admin.classes.edit');
    Route::put('/admin/classes/{class}', [ClassManagementController::class, 'update'])->name('admin.classes.update');
    Route::delete('/admin/classes/{class}', [ClassManagementController::class, 'destroy'])->name('admin.classes.destroy');
    
    // Student Management within Classes
    Route::get('/admin/classes/{class}/students', [ClassManagementController::class, 'students'])->name('admin.classes.students');
    Route::get('/admin/classes/{class}/students/create', [ClassManagementController::class, 'createStudent'])->name('admin.classes.students.create');
    Route::post('/admin/classes/{class}/students', [ClassManagementController::class, 'storeStudent'])->name('admin.classes.students.store');
    Route::get('/admin/classes/{class}/students/{student}/edit', [ClassManagementController::class, 'editStudent'])->name('admin.classes.students.edit');
    Route::put('/admin/classes/{class}/students/{student}', [ClassManagementController::class, 'updateStudent'])->name('admin.classes.students.update');
    Route::delete('/admin/classes/{class}/students/{student}', [ClassManagementController::class, 'destroyStudent'])->name('admin.classes.students.destroy');
    
    // Teacher Management
    Route::get('/admin/teachers', [\App\Http\Controllers\TeacherController::class, 'index'])->name('admin.teachers.index');
    Route::get('/admin/teachers/create', [\App\Http\Controllers\TeacherController::class, 'create'])->name('admin.teachers.create');
    Route::post('/admin/teachers', [\App\Http\Controllers\TeacherController::class, 'store'])->name('admin.teachers.store');
    Route::get('/admin/teachers/{teacher}', [\App\Http\Controllers\TeacherController::class, 'show'])->name('admin.teachers.show');
    Route::get('/admin/teachers/{teacher}/edit', [\App\Http\Controllers\TeacherController::class, 'edit'])->name('admin.teachers.edit');
    Route::put('/admin/teachers/{teacher}', [\App\Http\Controllers\TeacherController::class, 'update'])->name('admin.teachers.update');
    Route::delete('/admin/teachers/{teacher}', [\App\Http\Controllers\TeacherController::class, 'destroy'])->name('admin.teachers.destroy');
    
    // API endpoint untuk preview email
    Route::post('/admin/teachers/preview-email', [\App\Http\Controllers\TeacherController::class, 'previewEmail'])->name('admin.teachers.preview-email');

    // Subject Management
    Route::get('/admin/subjects', [\App\Http\Controllers\Admin\SubjectController::class, 'index'])->name('admin.subjects.index');
    Route::get('/admin/subjects/create', [\App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('admin.subjects.create');
    Route::post('/admin/subjects', [\App\Http\Controllers\Admin\SubjectController::class, 'store'])->name('admin.subjects.store');
    Route::get('/admin/subjects/{subject}', [\App\Http\Controllers\Admin\SubjectController::class, 'show'])->name('admin.subjects.show');
    Route::get('/admin/subjects/{subject}/edit', [\App\Http\Controllers\Admin\SubjectController::class, 'edit'])->name('admin.subjects.edit');
    Route::put('/admin/subjects/{subject}', [\App\Http\Controllers\Admin\SubjectController::class, 'update'])->name('admin.subjects.update');
    Route::delete('/admin/subjects/{subject}', [\App\Http\Controllers\Admin\SubjectController::class, 'destroy'])->name('admin.subjects.destroy');
    Route::post('/admin/subjects/assign-to-class', [\App\Http\Controllers\Admin\SubjectController::class, 'assignToClass'])->name('admin.subjects.assign-to-class');
    Route::post('/admin/subjects/assign-mandatory-to-all', [\App\Http\Controllers\Admin\SubjectController::class, 'assignMandatoryToAllClasses'])->name('admin.subjects.assign-mandatory-to-all');
    
    // Major Management
    Route::get('/admin/majors', [\App\Http\Controllers\Admin\MajorController::class, 'index'])->name('admin.majors.index');
    Route::get('/admin/majors/create', [\App\Http\Controllers\Admin\MajorController::class, 'create'])->name('admin.majors.create');
    Route::post('/admin/majors', [\App\Http\Controllers\Admin\MajorController::class, 'store'])->name('admin.majors.store');
    Route::get('/admin/majors/{major}', [\App\Http\Controllers\Admin\MajorController::class, 'show'])->name('admin.majors.show');
    Route::get('/admin/majors/{major}/edit', [\App\Http\Controllers\Admin\MajorController::class, 'edit'])->name('admin.majors.edit');
    Route::put('/admin/majors/{major}', [\App\Http\Controllers\Admin\MajorController::class, 'update'])->name('admin.majors.update');
    Route::delete('/admin/majors/{major}', [\App\Http\Controllers\Admin\MajorController::class, 'destroy'])->name('admin.majors.destroy');
    
    // Social Media Management
    Route::get('/admin/social-media', [\App\Http\Controllers\Admin\SocialMediaController::class, 'index'])->name('admin.social-media.index');
    Route::put('/admin/social-media', [\App\Http\Controllers\Admin\SocialMediaController::class, 'update'])->name('admin.social-media.update');

    // Materials Management
    Route::resource('materials', \App\Http\Controllers\MaterialController::class);
    Route::get('/materials/{material}/download', [\App\Http\Controllers\MaterialController::class, 'download'])->name('materials.download');
    
    // Teacher Profile Management
    Route::get('/teacher/profile', [\App\Http\Controllers\TeacherProfileController::class, 'edit'])->name('teacher.profile.edit');
    Route::put('/teacher/profile', [\App\Http\Controllers\TeacherProfileController::class, 'update'])->name('teacher.profile.update');
    Route::put('/teacher/profile/password', [\App\Http\Controllers\TeacherProfileController::class, 'updatePassword'])->name('teacher.profile.password');
    
    // Learner Profile Management
    Route::get('/learner/profile', [\App\Http\Controllers\LearnerProfileController::class, 'edit'])->name('learner.profile.edit');
    Route::put('/learner/profile', [\App\Http\Controllers\LearnerProfileController::class, 'update'])->name('learner.profile.update');
    Route::put('/learner/profile/password', [\App\Http\Controllers\LearnerProfileController::class, 'updatePassword'])->name('learner.profile.password');
    
    // Schedule Management
    Route::get('/admin/schedule', [ClassManagementController::class, 'schedule'])->name('admin.schedule.index');
    Route::post('/admin/classes/{class}/subjects', [ClassManagementController::class, 'assignSubjects'])->name('admin.classes.assign-subjects');

    // Email Logs
    Route::get('/email-logs', [EmailLogController::class, 'index'])->name('email.logs');

    // Custom Email
    Route::get('/custom-email', [UserController::class, 'customEmailForm'])->name('email.custom.form');
    Route::post('/custom-email/send', [UserController::class, 'sendCustomEmail'])->name('email.custom.send');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Edit the User Profile
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])
        ->middleware('auth')
        ->name('admin.profile.edit');

    Route::patch('/admin/profile/update', [ProfileController::class, 'update'])
    ->middleware('auth')
    ->name('admin.profile.update');

    // Update password from admin profile page
    Route::put('/admin/profile/password', [ProfileController::class, 'updatePassword'])
        ->middleware('auth')
        ->name('admin.profile.password');

    // Delete account from admin profile page
    Route::delete('/admin/profile/delete', [ProfileController::class, 'destroy'])
        ->middleware('auth')
        ->name('admin.profile.destroy');

    Route::get('attendance', [LearnerAttendanceController::class, 'index'])->name('admin.attendance.index');
    Route::post('attendance/store', [LearnerAttendanceController::class, 'store'])->name('admin.attendance.store');
    Route::post('attendance/lookup-learner', [LearnerAttendanceController::class, 'lookupLearner'])
    ->middleware(['auth'])
    ->name('admin.attendance.lookup-learner');
});

Route::middleware(['auth'])
    ->prefix('admin/announcements')
    ->name('admin.announcements.')
    ->group(function () {

       // List & create announcements
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::post('/', [AnnouncementController::class, 'store'])->name('store');

    // Update & delete announcements
    Route::put('/{announcement}', [AnnouncementController::class, 'update'])->name('update');
    Route::delete('/{announcement}', [AnnouncementController::class, 'destroy'])->name('destroy');

    // Show send form
    Route::get('/send', [AnnouncementController::class, 'sendForm'])->name('sendForm');

    //  Process sending to selected recipients
    Route::post('/send', [AnnouncementController::class, 'processSend'])->name('processSend');

    // Send a specific announcement by ID (e.g. quick resend)
    Route::get('/{id}/send', [AnnouncementController::class, 'send'])->name('send');

    // View logs
    Route::get('/logs', [AnnouncementController::class, 'logs'])->name('logs');
});


// Temporarily allow public access for testing purposes~
Route::resource('learners', LearnerController::class)->names('admin.learners');
    // Route::resource('employees', EmployeeController::class);
    // Route::resource('attendance', AttendanceController::class);
    // Route::resource('announcements', AnnouncementController::class);
Route::delete('/learners/{id}', [LearnerController::class, 'destroy'])->name('learners.destroy');

// Test route for simple form
Route::get('/test-add-student', function() {
    return view('test_add_student');
})->name('test.add.student');




// // Admin-only routes for managing records
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::resource('learners', LearnerController::class)->names('admin.learners');
//     // Add more admin-only routes here later
// });


/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Register, Password, etc.)
|--------------------------------------------------------------------------
*/

// Breeze auth routes (login, register, etc.)
require __DIR__.'/auth.php';
