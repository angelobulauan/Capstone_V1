<?php

namespace App\Http\Controllers\SuperadminController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\alluser;
use Illuminate\Http\Request;

class alluserctrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        $allusers = DB::table('users')
        ->join('role_users', 'users.id', '=', 'role_users.user_id')
        ->whereNotIn('role_users.role_id', [1])
        ->get(); //this will retrive all your user entries regardless of the status

    // dd($myEntry);

    //then we return to the newly created blade file with the data we retrieved
    return view('superadmin.view')
        ->with('alluser', $allusers);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
    public function showAllUsers()
{
    // Retrieve all users from the 'users' table

}
}
