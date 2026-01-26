<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'teacher_id',
        'name',
        'email',
        'nip',
        'phone',
        'address',
        'subject_specialization',
        'education_level',
        'hire_date',
        'is_active',
        'birth_date',
        'gender',
        'bio',
        'profile_photo',
        'emergency_contact',
        'emergency_phone',
        'social_media',
        'achievements',
        'certifications'
    ];

    protected $casts = [
        'hire_date' => 'date',
        'birth_date' => 'date',
        'is_active' => 'boolean',
        'social_media' => 'array',
    ];

    // Relasi dengan User (akun login)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan mata pelajaran yang diajar
    public function teachingSubjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'teacher_id', 'subject_id')
                    ->withPivot(['school_class_id', 'schedule_day', 'start_time', 'end_time', 'room', 'academic_year'])
                    ->withTimestamps();
    }

    // Relasi dengan kelas sebagai wali kelas
    public function homeroomClasses(): HasMany
    {
        return $this->hasMany(SchoolClass::class, 'homeroom_teacher_id');
    }

    // Relasi dengan materi pembelajaran
    public function subjectMaterials(): HasMany
    {
        return $this->hasMany(SubjectMaterial::class);
    }

    // Scope untuk guru aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk masa kerja
    public function getWorkingYearsAttribute()
    {
        return $this->hire_date ? $this->hire_date->diffInYears(now()) : 0;
    }

    // Check apakah bisa mengajar mata pelajaran tertentu
    public function canTeach($subject)
    {
        return $this->subject_specialization === $subject;
    }
}
