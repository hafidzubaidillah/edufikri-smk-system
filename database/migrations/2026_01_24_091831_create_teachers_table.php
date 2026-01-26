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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->unique(); // NIP
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->text('address')->nullable();
            $table->string('education')->nullable(); // S1, S2, dll
            $table->string('major')->nullable(); // Jurusan pendidikan
            $table->json('subjects')->nullable(); // Mata pelajaran yang bisa diajar
            $table->enum('status', ['PNS', 'Honorer', 'Kontrak'])->default('Honorer');
            $table->date('join_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
