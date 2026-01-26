@extends('layouts.teacher')

@section('title', 'Tambah Materi - ' . $classSubject->subject->name)

@section('content')

@push('styles')
<style>
    .form-header {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .material-type-card {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }
    .material-type-card:hover {
        border-color: #28a745;
        background-color: #f8f9fa;
    }
    .material-type-card.active {
        border-color: #28a745;
        background-color: #d4edda;
    }
    .file-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    .file-u