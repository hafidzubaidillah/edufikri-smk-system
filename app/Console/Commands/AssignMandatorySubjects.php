<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SchoolClass;
use App\Models\Subject;

class AssignMandatorySubjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subjects:assign-mandatory 
                            {--class-id= : Assign to specific class ID}
                            {--force : Force reassign even if already assigned}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign mandatory subjects to all classes or specific class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎓 Starting mandatory subjects assignment...');
        
        $classId = $this->option('class-id');
        $force = $this->option('force');
        
        if ($classId) {
            $classes = SchoolClass::where('id', $classId)->get();
            if ($classes->isEmpty()) {
                $this->error("Class with ID {$classId} not found!");
                return 1;
            }
        } else {
            $classes = SchoolClass::active()->get();
        }

        if ($classes->isEmpty()) {
            $this->warn('No active classes found!');
            return 0;
        }

        $this->info("Found {$classes->count()} class(es) to process.");
        
        $totalAssigned = 0;
        $totalSkipped = 0;

        foreach ($classes as $class) {
            $this->line("Processing: {$class->full_name}");
            
            $result = $this->assignMandatorySubjectsToClass($class, $force);
            $totalAssigned += $result['assigned'];
            $totalSkipped += $result['skipped'];
            
            if ($result['assigned'] > 0) {
                $this->info("  ✅ Assigned {$result['assigned']} mandatory subjects");
            }
            if ($result['skipped'] > 0) {
                $this->comment("  ⏭️  Skipped {$result['skipped']} already assigned subjects");
            }
        }

        $this->newLine();
        $this->info("🎉 Assignment completed!");
        $this->table(
            ['Metric', 'Count'],
            [
                ['Classes processed', $classes->count()],
                ['Subjects assigned', $totalAssigned],
                ['Subjects skipped', $totalSkipped],
            ]
        );

        return 0;
    }

    /**
     * Assign mandatory subjects to a specific class
     */
    private function assignMandatorySubjectsToClass(SchoolClass $class, bool $force = false)
    {
        $assigned = 0;
        $skipped = 0;

        // Get mandatory subjects compatible with this class
        $mandatorySubjects = Subject::mandatory()
            ->active()
            ->where(function ($query) use ($class) {
                // Include subjects for all grades or specific grade
                $query->where('grade_level', 'all')
                      ->orWhere('grade_level', $class->grade);
            })
            ->where(function ($query) use ($class) {
                // Include subjects for all majors or specific major
                $query->whereNull('majors')
                      ->orWhereJsonContains('majors', $class->major);
            })
            ->get();

        foreach ($mandatorySubjects as $subject) {
            $alreadyAssigned = $class->subjects()->where('subject_id', $subject->id)->exists();
            
            if ($alreadyAssigned && !$force) {
                $skipped++;
                continue;
            }

            if ($alreadyAssigned && $force) {
                // Update existing assignment
                $class->subjects()->updateExistingPivot($subject->id, [
                    'academic_year' => date('Y') . '/' . (date('Y') + 1),
                    'is_active' => true,
                    'updated_at' => now()
                ]);
            } else {
                // Create new assignment
                $class->subjects()->attach($subject->id, [
                    'academic_year' => date('Y') . '/' . (date('Y') + 1),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            $assigned++;
        }

        return [
            'assigned' => $assigned,
            'skipped' => $skipped
        ];
    }
}