<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'hours_per_week',
        'grade_level',
        'majors',
        'is_active',
        'is_mandatory'
    ];

    protected $casts = [
        'majors' => 'array',
        'is_active' => 'boolean',
        'is_mandatory' => 'boolean',
    ];

    // Relasi dengan classes melalui pivot table
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class, 'class_subjects')
                    ->withPivot(['teacher_name', 'teacher_email', 'schedule_day', 'start_time', 'end_time', 'room', 'academic_year', 'is_active'])
                    ->withTimestamps();
    }

    // Relasi dengan materials
    public function materials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Material::class);
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Scope untuk filter berdasarkan grade level
    public function scopeByGradeLevel($query, $grade)
    {
        return $query->where('grade_level', $grade)->orWhere('grade_level', 'all');
    }

    // Scope untuk mata pelajaran aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk mata pelajaran wajib
    public function scopeMandatory($query)
    {
        return $query->where('is_mandatory', true);
    }

    // Scope untuk mata pelajaran tambahan
    public function scopeOptional($query)
    {
        return $query->where('is_mandatory', false);
    }

    // Check apakah mata pelajaran untuk jurusan tertentu
    public function isForMajor($major)
    {
        return empty($this->majors) || in_array($major, $this->majors);
    }

    // Accessor untuk kategori dalam bahasa Indonesia
    public function getCategoryLabelAttribute()
    {
        $categories = [
            'umum' => 'Mata Pelajaran Umum',
            'kejuruan' => 'Mata Pelajaran Kejuruan',
            'muatan_lokal' => 'Muatan Lokal',
            'agama' => 'Pendidikan Agama Islam'
        ];
        
        return $categories[$this->category] ?? $this->category;
    }
}
