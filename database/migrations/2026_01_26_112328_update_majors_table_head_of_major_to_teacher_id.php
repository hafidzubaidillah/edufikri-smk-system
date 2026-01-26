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
        Schema::table('majors', function (Blueprint $table) {
            // Add new teacher_id column
            $table->unsignedBigInteger('head_of_major_id')->nullable()->after('description');
            
            // Add foreign key constraint
            $table->foreign('head_of_major_id')->references('id')->on('teachers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropForeign(['head_of_major_id']);
            $table->dropColumn('head_of_major_id');
        });
    }
};
