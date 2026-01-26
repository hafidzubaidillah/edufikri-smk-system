<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'subject_id',
        'class_id',
        'teacher_id',
        'type',
        'file_path',
        'file_name',
        'file_size',
        'external_link',
        'due_date',
        'max_score',
        'is_published',
        'is_active',
        'published_at'
    ];

    protected $casts = [
        'due_date' => 'date',
        'is_published' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeBySubject($query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }

    public function scopeByClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    // Accessors
    public function getTypeNameAttribute()
    {
        $types = [
            'document' => 'Dokumen',
            'video' => 'Video',
            'link' => 'Link',
            'assignment' => 'Tugas',
            'quiz' => 'Kuis'
        ];
        
        return $types[$this->type] ?? $this->type;
    }

    public function getFileSizeFormattedAttribute()
    {
        if (!$this->file_size) return null;
        
        $bytes = intval($this->file_size);
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 2) . ' KB';
        if ($bytes < 1073741824) return round($bytes / 1048576, 2) . ' MB';
        return round($bytes / 1073741824, 2) . ' GB';
    }

    public function getIsOverdueAttribute()
    {
        if (!$this->due_date || $this->type !== 'assignment') return false;
        return $this->due_date->isPast();
    }
}
