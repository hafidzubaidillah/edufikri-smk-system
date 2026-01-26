<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedia = [
            'facebook' => config('social.facebook'),
            'instagram' => config('social.instagram'),
            'youtube' => config('social.youtube'),
            'whatsapp' => config('social.whatsapp'),
            'phone' => config('social.phone'),
            'email' => config('social.email'),
            'address' => config('social.address'),
            'website' => config('social.website'),
        ];

        return view('admin.social-media.index', compact('socialMedia'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'website' => 'nullable|string',
        ]);

        // Update .env file
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        $updates = [
            'SOCIAL_FACEBOOK' => $request->facebook,
            'SOCIAL_INSTAGRAM' => $request->instagram,
            'SOCIAL_YOUTUBE' => $request->youtube,
            'SOCIAL_WHATSAPP' => $request->whatsapp,
            'SCHOOL_PHONE' => $request->phone,
            'SCHOOL_EMAIL' => $request->email,
            'SCHOOL_ADDRESS' => $request->address,
            'SCHOOL_WEBSITE' => $request->website,
        ];

        foreach ($updates as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = $key . '="' . $value . '"';
            
            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n" . $replacement;
            }
        }

        File::put($envPath, $envContent);

        // Clear config cache
        \Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Informasi sosial media berhasil diperbarui!');
    }
}