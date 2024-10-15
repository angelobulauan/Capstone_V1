<?php

namespace App\Http\Controllers\SuperadminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserVerifyCtrl extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
            ->where('involvement', 'uploader')
            ->where('is_verified', 0)
            ->get();

        return view('superadmin.UserVerify', compact('users'));
    }


    public function reject(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->involvement = 'viewer';
        $user->is_verified = 0;
        $user->save();

        return back();
    }

    public function verified(Request $request, $id){

        $user = User::findOrFail($id);
        $user->involvement = 'uploader';
        $user->is_verified = 1;
        $user->save();
        return back();
    }
}
