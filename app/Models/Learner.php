<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Learner extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'name',
        'email',
        'grade_level',
        'section',
        'class_id',
        'student_id',
        'birth_date',
        'gender',
        'address',
        'phone',
        'parent_name',
        'parent_phone',
        'enrollment_date',
        'is_active',
        'bio',
        'profile_photo',
        'hobby',
        'aspirations',
        'blood_type',
        'medical_notes',
        'parent_email',
        'parent_occupation',
        'social_media',
        'achievements'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'enrollment_date' => 'date',
        'is_active' => 'boolean',
        'social_media' => 'array',
    ];

    // Relasi dengan User (untuk login)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan kelas
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // Alias untuk kemudahan akses
    public function class(): BelongsTo
    {
        return $this->schoolClass();
    }

    // Relasi dengan absensi
    public function attendance(): HasMany
    {
        return $this->hasMany(LearnerAttendance::class);
    }

    // Accessor untuk nama lengkap
    public function getFullNameAttribute()
    {
        // Jika ada field 'name', gunakan itu. Jika tidak, gabungkan fname, mname, lname
        if ($this->name) {
            return $this->name;
        }
        return trim($this->fname . ' ' . $this->mname . ' ' . $this->lname);
    }

    // Accessor untuk nama (fallback ke full name)
    public function getNameAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return trim($this->fname . ' ' . $this->mname . ' ' . $this->lname);
    }

    // Accessor untuk umur
    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : null;
    }

    // Scope untuk filter berdasarkan kelas
    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    // Scope untuk filter berdasarkan grade
    public function scopeByGrade($query, $grade)
    {
        return $query->where('grade_level', $grade);
    }
}
