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
        Schema::table('teachers', function (Blueprint $table) {
            // Add new columns that the controller expects
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->string('nip')->nullable()->after('teacher_id');
            $table->string('subject_specialization')->nullable()->after('major');
            $table->string('education_level')->nullable()->after('education');
            $table->date('hire_date')->nullable()->after('join_date');
            
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'nip', 'subject_specialization', 'education_level', 'hire_date']);
        });
    }
};