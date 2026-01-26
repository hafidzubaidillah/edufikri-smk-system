<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClass extends Model
{
    protected $fillable = [
        'name',
        'grade',
        'major',
        'class_number',
        'homeroom_teacher',
        'capacity',
        'current_students',
        'academic_year',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::created(function ($class) {
            $class->assignMandatorySubjects();
        });
    }

    // Relasi dengan subjects melalui pivot table
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'class_subjects')
                    ->withPivot(['teacher_name', 'teacher_email', 'schedule_day', 'start_time', 'end_time', 'room', 'academic_year', 'is_active'])
                    ->withTimestamps();
    }

    // Relasi dengan learners
    public function learners(): HasMany
    {
        return $this->hasMany(Learner::class, 'class_id');
    }

    // Scope untuk filter berdasarkan grade
    public function scopeByGrade($query, $grade)
    {
        return $query->where('grade', $grade);
    }

    // Scope untuk filter berdasarkan major
    public function scopeByMajor($query, $major)
    {
        return $query->where('major', $major);
    }

    // Scope untuk kelas aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk nama lengkap kelas
    public function getFullNameAttribute()
    {
        return "Kelas {$this->grade} {$this->major} {$this->class_number}";
    }

    // Accessor untuk tingkat dalam format romawi
    public function getGradeRomanAttribute()
    {
        $romans = [10 => 'X', 11 => 'XI', 12 => 'XII'];
        return $romans[$this->grade] ?? $this->grade;
    }

    /**
     * Assign mandatory subjects to this class
     */
    public function assignMandatorySubjects()
    {
        $mandatorySubjects = Subject::mandatory()
            ->active()
            ->where(function ($query) {
                // Include subjects for all grades or specific grade
                $query->where('grade_level', 'all')
                      ->orWhere('grade_level', $this->grade);
            })
            ->where(function ($query) {
                // Include subjects for all majors or specific major
                $query->whereNull('majors')
                      ->orWhereJsonContains('majors', $this->major);
            })
            ->get();

        foreach ($mandatorySubjects as $subject) {
            // Check if not already assigned
            if (!$this->subjects()->where('subject_id', $subject->id)->exists()) {
                $this->subjects()->attach($subject->id, [
                    'academic_year' => date('Y') . '/' . (date('Y') + 1),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    /**
     * Get mandatory subjects for this class
     */
    public function getMandatorySubjects()
    {
        return $this->subjects()
            ->wherePivot('is_active', true)
            ->whereHas('subject', function ($query) {
                $query->where('is_mandatory', true);
            })
            ->get();
    }

    /**
     * Get optional subjects for this class
     */
    public function getOptionalSubjects()
    {
        return $this->subjects()
            ->wherePivot('is_active', true)
            ->whereHas('subject', function ($query) {
                $query->where('is_mandatory', false);
            })
            ->get();
    }
}
