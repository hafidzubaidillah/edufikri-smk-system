<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SendVerificationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-verification {email : Email address of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email verification to a specific user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }
        
        if ($user->hasVerifiedEmail()) {
            $this->info("User {$email} already has verified email.");
            return 0;
        }
        
        $user->sendEmailVerificationNotification();
        
        $this->info("Verification email sent to {$email}");
        return 0;
    }
}