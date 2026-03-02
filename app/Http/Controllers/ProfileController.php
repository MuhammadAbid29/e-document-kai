<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Show profile (UI KAI)
     */
    public function show()
    {
        return view('profile.edit');
    }


    /**
     * Upload profile photo
     */
    public function uploadPhoto(Request $request)
    {

        $request->validate([
            'photo' => 'required|image|max:2048'
        ]);


        $user = auth()->user();


        if ($request->hasFile('photo')) {

            // hapus lama
            if ($user->photo) {

                Storage::delete('public/'.$user->photo);

            }

            // simpan baru
            $path = $request->file('photo')
                ->store('profile', 'public');


            $user->update([
                'photo' => $path
            ]);

        }


        return back();

    }


    /**
     * Update profile info (default Breeze)
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }


    /**
     * Delete account
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