<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

class CustomVerifyEmail extends VerifyEmailBase implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public $backoff = [30, 60, 120];

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->onQueue('emails');
    }

    /**
     * Get the verification URL for the given notifiable.
     */
    protected function verificationUrl($notifiable)
    {
        $expireMinutes = (int) config('services.email_verification.expire_minutes', 60);
        
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes($expireMinutes),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        Log::info('Sending email verification', [
            'user_id' => $notifiable->id,
            'email' => $notifiable->email,
            'url' => $verificationUrl
        ]);

        return (new MailMessage)
            ->subject('Verifikasi Email Anda - ' . config('app.name'))
            ->view('emails.verify-email', [
                'user' => $notifiable,
                'verificationUrl' => $verificationUrl,
                'appName' => config('app.name'),
                'expireMinutes' => config('services.email_verification.expire_minutes', 60)
            ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed($exception)
    {
        Log::error('Email verification failed', [
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}