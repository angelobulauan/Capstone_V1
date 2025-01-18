<?php

namespace App\Http\Controllers\SuperadminController; // Ensure this is correct

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AllUserCtrl extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function view(Request $request)
    {
        // Get all users except those with role_id 1 and paginate the results
        $alluser = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->whereNotIn('role_users.role_id', [1])
            ->paginate(10); // Paginate with 10 users per page

        // Check if an `id` is provided to edit a specific user
        $userToEdit = null;
        if ($request->has('id')) {
            $userToEdit = User::find($request->id);
        }

        return view('superadmin.view', compact('alluser', 'userToEdit'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
{
    // Check the incoming request data
    // dd($request->all());

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

    return redirect()->route('superadmin.view')->with('success', 'User updated successfully!');
}

    /**
     * Disable the specified user.
     */
/**
 * Disable the specified user.
 */
public function disable($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Disable the user by changing the status field to 'disabled'
    $user->status = 'disabled';

    // Save the user with the updated status
    $user->save();

    // Redirect with a success message
    return redirect()->route('superadmin.view')->with('success', 'User disabled successfully!');
}

/**
 * Undisable the specified user.
 */
public function activate($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Undisable the user by changing the status field to 'active'
    $user->status = 'active';

    // Save the user with the updated status
    $user->save();

    // Redirect with a success message
    return redirect()->route('superadmin.view')->with('success', 'User undisabled successfully!');
}

}
