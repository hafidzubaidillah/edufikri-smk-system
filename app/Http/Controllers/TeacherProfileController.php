<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Teacher;
use App\Models\User;

class TeacherProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $teacher = $user->teacher ?? Teacher::where('user_id', $user->id)->first();
        
        if (!$teacher) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        return view('profile.teacher-edit', compact('user', 'teacher'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teacher ?? Teacher::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Data guru tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'bio' => 'nullable|string|max:1000',
            'emergency_contact' => 'nullable|string|max:255',
            'emergency_phone' => 'nullable|string|max:20',
            'achievements' => 'nullable|string',
            'certifications' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'social_media.instagram' => 'nullable|url',
            'social_media.facebook' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'social_media.linkedin' => 'nullable|url',
        ]);

        // Handle profile photo upload
        $profilePhoto = $teacher->profile_photo;
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($profilePhoto && Storage::disk('public')->exists($profilePhoto)) {
                Storage::disk('public')->delete($profilePhoto);
            }
            
            $profilePhoto = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        // Update User data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Prepare social media data
        $socialMedia = [];
        if ($request->has('social_media')) {
            $socialMedia = array_filter($request->social_media, function($value) {
                return !empty($value);
            });
        }

        // Update Teacher data
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'bio' => $request->bio,
            'profile_photo' => $profilePhoto,
            'emergency_contact' => $request->emergency_contact,
            'emergency_phone' => $request->emergency_phone,
            'social_media' => $socialMedia,
            'achievements' => $request->achievements,
            'certifications' => $request->certifications,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:6',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui!');
    }
}