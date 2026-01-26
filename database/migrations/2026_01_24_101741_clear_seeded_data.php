<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Clear all seeded data to allow manual data entry
     */
    public function up(): void
    {
        // SQLite doesn't need FOREIGN_KEY_CHECKS
        // Just clear the data directly
        
        // Clear all seeded data
        DB::table('class_subjects')->delete();
        DB::table('learner_attendance')->delete();
        DB::table('learners')->delete();
        DB::table('teachers')->delete();
        DB::table('subjects')->delete();
        DB::table('school_classes')->delete();
        
        // Log the clearing action
        \Log::info('Seeded data cleared successfully. System ready for manual data entry.');
    }

    /**
     * Reverse the migrations.
     * This will restore some basic data if needed
     */
    public function down(): void
    {
        // Note: This won't restore the exact same data
        // You would need to run the seeders again manually
        \Log::info('Clear data migration rolled back. Run seeders to restore data if needed.');
    }
};
