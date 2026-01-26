<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class TestVerification extends Command
{
    protected $signature = 'test:verification {email}';
    protected $description = 'Test complete verification flow';

    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User not found: {$email}");
            return 1;
        }
        
        $this->info("🧪 Testing Verification Flow for: {$user->name} ({$user->email})");
        $this->newLine();
        
        // Show current status
        $this->info("📊 Current Status:");
        $this->line("   Verified: " . ($user->hasVerifiedEmail() ? '✅ Yes' : '❌ No'));
        $this->line("   Verified At: " . ($user->email_verified_at ? $user->email_verified_at : 'Never'));
        $this->newLine();
        
        // Reset verification if needed
        if ($user->hasVerifiedEmail()) {
            $user->email_verified_at = null;
            $user->save();
            $this->info("🔄 Reset verification status");
        }
        
        // Generate verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]
        );
        
        $this->info("🔗 Generated Verification URL:");
        $this->line("   {$verificationUrl}");
        $this->newLine();
        
        // Test URL components
        $this->info("🔍 URL Analysis:");
        $parsedUrl = parse_url($verificationUrl);
        parse_str($parsedUrl['query'], $queryParams);
        
        $this->line("   Base URL: {$parsedUrl['scheme']}://{$parsedUrl['host']}:{$parsedUrl['port']}{$parsedUrl['path']}");
        $this->line("   User ID: {$user->id}");
        $this->line("   Hash: " . sha1($user->getEmailForVerification()));
        $this->line("   Expires: " . date('Y-m-d H:i:s', $queryParams['expires']));
        $this->line("   Signature: " . substr($queryParams['signature'], 0, 20) . '...');
        $this->newLine();
        
        // Instructions
        $this->info("📋 Next Steps:");
        $this->line("   1. Copy the verification URL above");
        $this->line("   2. Open it in your browser");
        $this->line("   3. You should see the verification success page");
        $this->line("   4. Check verification status with: php artisan test:verification {$email}");
        $this->newLine();
        
        // Show routes
        $this->info("🛣️  Available Routes:");
        $this->line("   GET  /verify-email                    - Verification notice page");
        $this->line("   GET  /verify-email/{id}/{hash}       - Verify email endpoint");
        $this->line("   POST /email/verification-notification - Resend verification");
        $this->line("   GET  /verification/check              - AJAX status check");
        
        return 0;
    }
}