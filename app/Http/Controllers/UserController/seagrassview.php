<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\seaview;

class seagrassview extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myEntry = DB::table('seaviews')
        // ->where('u_id', '=', Auth::user()->id) 
        ->get(); //this will retrive all your user entries regardless of the status 

        // dd($myEntry);

        //then we return to the newly created blade file with the data we retrieved
        return view('User.seagrass')
        ->with('myEntry', $myEntry);
    }

    /**
     * Show the form for creating a new resource.
     */
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
    public function destroy(string $id)
    {
        //
    }
}
