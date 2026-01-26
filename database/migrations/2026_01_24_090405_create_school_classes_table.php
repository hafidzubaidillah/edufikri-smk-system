<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // X TKJ 1, XI RPL 2, XII TSM 1, etc
            $table->integer('grade'); // 10, 11, 12
            $table->string('major'); // TKJ, RPL, TKR, TSM, AKL
            $table->integer('class_number'); // 1, 2, 3, etc
            $table->string('homeroom_teacher')->nullable();
            $table->integer('capacity')->default(36);
            $table->integer('current_students')->default(0);
            $table->string('academic_year'); // 2025/2026
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};
