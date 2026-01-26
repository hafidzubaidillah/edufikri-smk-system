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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // MTK, BIN, BING, etc
            $table->string('name'); // Matematika, Bahasa Indonesia, etc
            $table->text('description')->nullable();
            $table->enum('category', ['umum', 'kejuruan', 'muatan_lokal', 'agama']); 
            $table->integer('hours_per_week'); // jam pelajaran per minggu
            $table->enum('grade_level', ['10', '11', '12', 'all']); // untuk kelas berapa
            $table->json('majors')->nullable(); // untuk jurusan apa saja (TKJ, RPL, etc)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
