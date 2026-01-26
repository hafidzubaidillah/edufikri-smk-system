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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // TJKT, RPL, TKR, etc
            $table->string('name'); // Teknik Jaringan Komputer dan Telekomunikasi
            $table->text('description')->nullable();
            $table->string('head_of_major')->nullable(); // Kepala Jurusan
            $table->integer('capacity')->default(108); // Kapasitas total (3 kelas x 36 siswa)
            $table->integer('current_students')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
