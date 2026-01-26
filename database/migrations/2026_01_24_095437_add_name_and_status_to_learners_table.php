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
        Schema::table('learners', function (Blueprint $table) {
            $table->string('name')->nullable()->after('lname');
            $table->date('enrollment_date')->nullable()->after('parent_phone');
            $table->boolean('is_active')->default(true)->after('enrollment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learners', function (Blueprint $table) {
            $table->dropColumn(['name', 'enrollment_date', 'is_active']);
        });
    }
};
