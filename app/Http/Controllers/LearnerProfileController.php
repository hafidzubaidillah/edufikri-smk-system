<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Learner;
use App\Models\User;

class LearnerProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $learner = $user->learner ?? Learner::where('user_id', $user->id)->first();
        
        if (!$learner) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        return view('profile.student-edit', compact('user', 'learner'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $learner = $user->learner ?? Learner::where('user_id', $user->id)->first();

        if (!$learner) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:L,P',
            'bio' => 'nullable|string|max:500',
            'hobby' => 'nullable|string|max:255',
            'aspirations' => 'nullable|string|max:500',
            'blood_type' => 'nullable|string|max:5',
            'medical_notes' => 'nullable|string',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email',
            'parent_occupation' => 'nullable|string|max:255',
            'achievements' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'social_media.instagram' => 'nullable|url',
            'social_media.tiktok' => 'nullable|url',
            'social_media.youtube' => 'nullable|url',
        ]);

        // Handle profile photo upload
        $profilePhoto = $learner->profile_photo;
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

        // Update Learner data
        $learner->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'bio' => $request->bio,
            'profile_photo' => $profilePhoto,
            'hobby' => $request->hobby,
            'aspirations' => $request->aspirations,
            'blood_type' => $request->blood_type,
            'medical_notes' => $request->medical_notes,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'parent_email' => $request->parent_email,
            'parent_occupation' => $request->parent_occupation,
            'social_media' => $socialMedia,
            'achievements' => $request->achievements,
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