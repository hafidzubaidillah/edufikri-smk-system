<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function notice(Request $request): View
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(route('dashboard', absolute: false))
            : view('auth.verify-email');
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            
            Log::info('Email verified successfully', [
                'user_id' => $request->user()->id,
                'email' => $request->user()->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1')
            ->with('status', 'Email berhasil diverifikasi! Selamat datang di '.config('app.name').'.');
    }

    /**
     * Send a new email verification notification.
     */
    public function send(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Rate limiting
        $key = 'email-verification:'.$user->id;
        $maxAttempts = config('services.email_verification.throttle_attempts', 5);
        $decayMinutes = config('services.email_verification.throttle_decay', 60);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."
            ]);
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        $user->sendEmailVerificationNotification();

        Log::info('Email verification resent', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip()
        ]);

        return back()->with('status', 'Link verifikasi telah dikirim ulang ke email Anda.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}