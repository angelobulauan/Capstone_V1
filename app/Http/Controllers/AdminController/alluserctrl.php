<?php

namespace App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\alluser;
use Illuminate\Http\Request;

class alluserctrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allusers = DB::table('users')
        // ->where('u_id', '=', Auth::user()->id)
        ->get(); //this will retrive all your user entries regardless of the status

    // dd($myEntry);

    //then we return to the newly created blade file with the data we retrieved
    return view('admin.view')
        ->with('alluser', $allusers);
        

    /**
     * Show the form for creating a new resource.
     */
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
