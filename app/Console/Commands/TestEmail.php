<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class TestEmail extends Command
{
    protected $signature = 'test:email {email} {--reset} {--status} {--queue-info}';
    protected $description = 'Test email verification system with comprehensive options';

    public function handle()
    {
        $email = $this->argument('email');
        
        if ($this->option('status')) {
            return $this->showEmailStatus();
        }
        
        if ($this->option('queue-info')) {
            return $this->showQueueInfo();
        }
        
        // Create or find user
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => null
            ]
        );
        
        if ($this->option('reset')) {
            $user->email_verified_at = null;
            $user->save();
            $this->info("✅ Email verification status reset for: {$email}");
        }
        
        // Show user info
        $this->info("👤 User Info:");
        $this->line("   Name: {$user->name}");
        $this->line("   Email: {$user->email}");
        $this->line("   Verified: " . ($user->hasVerifiedEmail() ? '✅ Yes' : '❌ No'));
        $this->line("   Created: {$user->created_at}");
        $this->newLine();
        
        if ($user->hasVerifiedEmail()) {
            $this->warn("⚠️  User email is already verified!");
            if (!$this->confirm('Send verification email anyway?')) {
                return 0;
            }
        }
        
        // Send verification email
        $this->info("📧 Sending verification email...");
        
        try {
            $user->sendEmailVerificationNotification();
            
            $this->info("✅ Verification email queued successfully!");
            $this->newLine();
            
            // Show next steps
            $this->info("📋 Next Steps:");
            
            if (config('mail.default') === 'log') {
                $this->line("   1. Check email content in: storage/logs/laravel.log");
                $this->line("   2. Look for the verification URL in the log");
                $this->line("   3. Copy and paste the URL in your browser");
            } else {
                $this->line("   1. Check your email inbox: {$email}");
                $this->line("   2. Click the verification link");
                $this->line("   3. If not found, check spam/junk folder");
            }
            
            $this->newLine();
            $this->info("🔧 Useful Commands:");
            $this->line("   php artisan test:email {$email} --status    # Check verification status");
            $this->line("   php artisan test:email {$email} --reset     # Reset verification status");
            $this->line("   php artisan queue:work                      # Process email queue");
            $this->line("   php artisan test:email {$email} --queue-info # Show queue information");
            
        } catch (\Exception $e) {
            $this->error("❌ Failed to send verification email!");
            $this->error("Error: " . $e->getMessage());
            
            Log::error('Email verification test failed', [
                'email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return 1;
        }
        
        return 0;
    }
    
    private function showEmailStatus()
    {
        $this->info("📊 Email System Status:");
        $this->newLine();
        
        // Mail configuration
        $this->info("📧 Mail Configuration:");
        $this->line("   Driver: " . config('mail.default'));
        $this->line("   Host: " . config('mail.mailers.smtp.host', 'N/A'));
        $this->line("   Port: " . config('mail.mailers.smtp.port', 'N/A'));
        $this->line("   From: " . config('mail.from.address'));
        $this->newLine();
        
        // Queue configuration
        $this->info("🔄 Queue Configuration:");
        $this->line("   Driver: " . config('queue.default'));
        $this->line("   Connection: " . config('queue.connections.' . config('queue.default') . '.driver', 'N/A'));
        $this->newLine();
        
        // Verification settings
        $this->info("⚙️  Verification Settings:");
        $this->line("   Expire Minutes: " . config('services.email_verification.expire_minutes', 60));
        $this->line("   Throttle Attempts: " . config('services.email_verification.throttle_attempts', 5));
        $this->line("   Throttle Decay: " . config('services.email_verification.throttle_decay', 60) . " minutes");
        $this->newLine();
        
        // Recent users
        $recentUsers = User::whereNull('email_verified_at')
            ->latest()
            ->take(5)
            ->get(['name', 'email', 'created_at']);
            
        if ($recentUsers->count() > 0) {
            $this->info("👥 Recent Unverified Users:");
            foreach ($recentUsers as $user) {
                $this->line("   {$user->email} ({$user->name}) - {$user->created_at->diffForHumans()}");
            }
        } else {
            $this->info("👥 No unverified users found");
        }
        
        return 0;
    }
    
    private function showQueueInfo()
    {
        $this->info("🔄 Queue Information:");
        $this->newLine();
        
        try {
            // Get queue size (works for database queue)
            if (config('queue.default') === 'database') {
                $pendingJobs = \DB::table('jobs')->count();
                $failedJobs = \DB::table('failed_jobs')->count();
                
                $this->info("📊 Queue Stats:");
                $this->line("   Pending Jobs: {$pendingJobs}");
                $this->line("   Failed Jobs: {$failedJobs}");
                
                if ($pendingJobs > 0) {
                    $this->newLine();
                    $this->info("💡 To process queue:");
                    $this->line("   php artisan queue:work");
                }
                
                if ($failedJobs > 0) {
                    $this->newLine();
                    $this->warn("⚠️  Failed jobs found!");
                    $this->line("   php artisan queue:failed        # List failed jobs");
                    $this->line("   php artisan queue:retry all     # Retry all failed jobs");
                }
            } else {
                $this->line("   Queue driver: " . config('queue.default'));
                $this->line("   (Queue stats only available for database driver)");
            }
            
        } catch (\Exception $e) {
            $this->error("❌ Could not retrieve queue information: " . $e->getMessage());
        }
        
        return 0;
    }
}