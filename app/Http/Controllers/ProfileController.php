<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        
        // Check if this is admin profile route
        if ($request->routeIs('admin.profile.edit')) {
            return view('admin.profile.edit', [
                'user' => $user,
            ]);
        }

        // Route to appropriate profile view based on user role
        if ($user->hasRole('admin')) {
            return view('profile.admin-edit', [
                'user' => $user,
            ]);
        } elseif ($user->hasRole('learner')) {
            // Redirect to learner profile controller
            return redirect()->route('learner.profile.edit');
        } elseif ($user->hasRole('employee')) {
            // Redirect to teacher profile controller
            return redirect()->route('teacher.profile.edit');
        }

        // Fallback to default view
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
   public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // Redirect to the appropriate profile route based on current route or user role
        if ($request->routeIs('admin.profile.update')) {
            $redirectRoute = 'admin.profile.edit';
        } else {
            $redirectRoute = 'profile.edit';
        }

        return Redirect::route($redirectRoute)->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        $route = $request->routeIs('admin.profile.password') ? 'admin.profile.edit' : 'profile.edit';

        return Redirect::route($route)->with('status', 'password-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
