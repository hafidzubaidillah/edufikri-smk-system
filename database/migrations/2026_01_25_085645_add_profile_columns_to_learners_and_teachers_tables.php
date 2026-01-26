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
        // Add profile columns to learners table if they don't exist
        Schema::table('learners', function (Blueprint $table) {
            if (!Schema::hasColumn('learners', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('learners', 'profile_photo')) {
                $table->string('profile_photo')->nullable();
            }
            if (!Schema::hasColumn('learners', 'hobby')) {
                $table->string('hobby')->nullable();
            }
            if (!Schema::hasColumn('learners', 'aspirations')) {
                $table->text('aspirations')->nullable();
            }
            if (!Schema::hasColumn('learners', 'blood_type')) {
                $table->string('blood_type')->nullable();
            }
            if (!Schema::hasColumn('learners', 'medical_notes')) {
                $table->text('medical_notes')->nullable();
            }
            if (!Schema::hasColumn('learners', 'parent_email')) {
                $table->string('parent_email')->nullable();
            }
            if (!Schema::hasColumn('learners', 'parent_occupation')) {
                $table->string('parent_occupation')->nullable();
            }
            if (!Schema::hasColumn('learners', 'social_media')) {
                $table->json('social_media')->nullable();
            }
            if (!Schema::hasColumn('learners', 'achievements')) {
                $table->text('achievements')->nullable();
            }
        });

        // Add profile columns to teachers table if they don't exist
        Schema::table('teachers', function (Blueprint $table) {
            if (!Schema::hasColumn('teachers', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('teachers', 'profile_photo')) {
                $table->string('profile_photo')->nullable();
            }
            if (!Schema::hasColumn('teachers', 'emergency_contact')) {
                $table->string('emergency_contact')->nullable();
            }
            if (!Schema::hasColumn('teachers', 'emergency_phone')) {
                $table->string('emergency_phone')->nullable();
            }
            if (!Schema::hasColumn('teachers', 'social_media')) {
                $table->json('social_media')->nullable();
            }
            if (!Schema::hasColumn('teachers', 'achievements')) {
                $table->text('achievements')->nullable();
            }
            if (!Schema::hasColumn('teachers', 'certifications')) {
                $table->text('certifications')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learners', function (Blueprint $table) {
            $columns = ['bio', 'profile_photo', 'hobby', 'aspirations', 'blood_type', 
                       'medical_notes', 'parent_email', 'parent_occupation', 'social_media', 'achievements'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('learners', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('teachers', function (Blueprint $table) {
            $columns = ['bio', 'profile_photo', 'emergency_contact', 'emergency_phone', 
                       'social_media', 'achievements', 'certifications'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('teachers', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};