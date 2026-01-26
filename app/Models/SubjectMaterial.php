<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class SubjectMaterial extends Model
{
    protected $fillable = [
        'class_subject_id',
        'teacher_id',
        'title',
        'description',
        'content',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'material_type',
        'external_link',
        'order_index',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'file_size' => 'integer',
        'order_index' => 'integer'
    ];

    // Relasi dengan class_subject (pivot table)
    public function classSubject(): BelongsTo
    {
        return $this->belongsTo(ClassSubject::class, 'class_subject_id');
    }

    // Relasi dengan teacher
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    // Accessor untuk URL file
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return Storage::url($this->file_path);
        }
        return null;
    }

    // Accessor untuk ukuran file yang readable
    public function getFileSizeHumanAttribute()
    {
        if (!$this->file_size) return null;
        
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Accessor untuk icon berdasarkan tipe file
    public function getFileIconAttribute()
    {
        $icons = [
            'pdf' => 'fas fa-file-pdf text-danger',
            'doc' => 'fas fa-file-word text-primary',
            'docx' => 'fas fa-file-word text-primary',
            'xls' => 'fas fa-file-excel text-success',
            'xlsx' => 'fas fa-file-excel text-success',
            'ppt' => 'fas fa-file-powerpoint text-warning',
            'pptx' => 'fas fa-file-powerpoint text-warning',
            'jpg' => 'fas fa-file-image text-info',
            'jpeg' => 'fas fa-file-image text-info',
            'png' => 'fas fa-file-image text-info',
            'gif' => 'fas fa-file-image text-info',
            'mp4' => 'fas fa-file-video text-purple',
            'avi' => 'fas fa-file-video text-purple',
            'mp3' => 'fas fa-file-audio text-success',
            'wav' => 'fas fa-file-audio text-success',
            'zip' => 'fas fa-file-archive text-secondary',
            'rar' => 'fas fa-file-archive text-secondary',
        ];

        return $icons[$this->file_type] ?? 'fas fa-file text-muted';
    }

    // Scope untuk materi yang dipublikasi
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope untuk materi berdasarkan class_subject
    public function scopeForClassSubject($query, $classSubjectId)
    {
        return $query->where('class_subject_id', $classSubjectId);
    }

    // Scope untuk materi berdasarkan teacher
    public function scopeByTeacher($query, $teacherId)
    {
        return $query->where('teacher_id', $teacherId);
    }
}
