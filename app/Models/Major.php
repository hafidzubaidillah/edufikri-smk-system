<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Major extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'head_of_major',
        'head_of_major_id',
        'capacity',
        'current_students',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi dengan classes
    public function classes(): HasMany
    {
        return $this->hasMany(SchoolClass::class, 'major', 'code');
    }

    // Relasi dengan kepala jurusan (teacher)
    public function headOfMajor(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'head_of_major_id');
    }

    // Relasi dengan subjects
    public function subjects()
    {
        return Subject::whereJsonContains('majors', $this->code)->get();
    }

    // Scope untuk jurusan aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk persentase kapasitas
    public function getCapacityPercentageAttribute()
    {
        return $this->capacity > 0 ? round(($this->current_students / $this->capacity) * 100, 1) : 0;
    }

    // Accessor untuk sisa kapasitas
    public function getRemainingCapacityAttribute()
    {
        return max(0, $this->capacity - $this->current_students);
    }
}
