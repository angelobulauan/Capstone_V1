<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class AppLayout extends Component
{
    /**
     * Get the view / contents
     *  that represents the component.
     */
    public function render(): View
    {


        $role = DB::table('role_users')
        ->select('*')
        ->where('user_id',Auth::user()->id)
        ->get();

        if ($role[0]->role_id === "1")
        {
            return view('layouts.LOSuperAdmin.app');
        }
        else if ($role[0]->role_id === "2")
        {
            return view('layouts.LOAdmin.app');
        }
        else
        {
            return view('layouts.LOUser.app');
        }
    }
}
