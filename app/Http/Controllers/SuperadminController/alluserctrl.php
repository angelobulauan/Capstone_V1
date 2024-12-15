<?php

namespace App\Http\Controllers\SuperadminController; // Ensure this is correct

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllUserCtrl extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function view()
    {
        $alluser = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->whereNotIn('role_users.role_id', [1])
            ->get();

        return view('superadmin.view', compact('alluser')); // Pass $alluser to view
    }


    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
{
    // Check the incoming request data
    dd($request->all());

    $user = User::findOrFail($id);

    // Validation logic
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|min:8|confirmed',
    ]);

    // Update logic
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('superadmin.user.update')->with('success', 'User updated successfully!');
}

    /**
     * Disable the specified user.
     */
    public function disable($id)
{
    $user = User::findOrFail($id); // Find the user by ID
    $user->update(['status' => 'disabled']); // Disable the user (set status)

    return redirect()->route('superadmin.view')->with('success', 'User disabled successfully!');
}
}
