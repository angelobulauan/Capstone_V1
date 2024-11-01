<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


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
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    // Populate the user's model with validated data from the request
    $request->user()->fill($request->validated());

    // If the email was modified, reset the email verification timestamp
    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    // Save the updated user data
    $request->user()->save();

    // Redirect to the profile edit page with a status message
    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

public function profileupdate(Request $request): RedirectResponse{
    // dd($request->all());
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'dob' => ['required', 'date'],
        'address' => ['required', 'string', 'max:255', 'min:5', 'max:255'], // Added 'min:5' and 'max:255' validation
        'sex' => ['required', 'in:male,female'],
        'id_img' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:5120'],
        'id_number' => ['required', 'string', 'max:255'],
    ]);

    $user = $request->user();

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->dob = $request->input('dob');
    $user->address = $request->input('address');
    $user->sex = $request->input('sex');
    $user->id_number = $request->input('id_number');

    if ($user->id_img) {
        // Delete the old image from storage
        Storage::disk('public')->delete($user->id_img);
    }

    // Check if a new file is uploaded
    if ($request->hasFile('id_img')) {
        $path = $request->file('id_img')->store('id_image', 'public');
        if ($path) {
            $user->id_img = $path;  // Set the new image path
        }
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}



    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
