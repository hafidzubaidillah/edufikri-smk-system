<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassSubject extends Model
{
    protected $fillable = [
        'school_class_id',
        'subject_id',
        'teacher_name',
        'teacher_email',
        'schedule_day',
        'start_time',
        'end_time',
        'room',
        'academic_year',
        'is_active'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_active' => 'boolean',
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    // Relasi dengan materi pembelajaran
    public function materials(): HasMany
    {
        return $this->hasMany(SubjectMaterial::class, 'class_subject_id');
    }

    // Relasi dengan materi yang dipublikasi
    public function publishedMaterials(): HasMany
    {
        return $this->materials()->published()->orderBy('order_index');
    }

    // Scope untuk jadwal aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk format waktu
    public function getScheduleTimeAttribute()
    {
        if ($this->start_time && $this->end_time) {
            return $this->start_time->format('H:i') . ' - ' . $this->end_time->format('H:i');
        }
        return null;
    }
}
