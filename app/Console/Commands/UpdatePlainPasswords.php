<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class UpdatePlainPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-plain-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update existing users with default plain passwords for admin viewing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating plain passwords for existing users...');
        
        $users = User::whereNull('plain_password')->get();
        
        if ($users->isEmpty()) {
            $this->info('No users need password updates.');
            return;
        }
        
        $bar = $this->output->createProgressBar($users->count());
        $bar->start();
        
        foreach ($users as $user) {
            // Generate a default password based on user role and name
            $defaultPassword = $this->generateDefaultPassword($user);
            
            $user->update([
                'plain_password' => $defaultPassword,
                'password' => bcrypt($defaultPassword)
            ]);
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info("Updated {$users->count()} users with default passwords.");
        $this->warn('IMPORTANT: Inform users about their new passwords!');
    }
    
    private function generateDefaultPassword($user)
    {
        // Check user role and generate appropriate password
        if ($user->hasRole('admin')) {
            return 'admin123';
        } elseif ($user->hasRole('employee')) {
            return 'guru123';
        } elseif ($user->hasRole('learner')) {
            return 'siswa123';
        } else {
            return 'user123';
        }
    }
}