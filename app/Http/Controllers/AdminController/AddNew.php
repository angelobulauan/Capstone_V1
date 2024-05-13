<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\seaview;
use Illuminate\Http\Request;

class AddNew extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return "test";
        return view('admin.addnew');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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

    public function edit($id)
    {
        $selectedUploaded = Seaview::find($id); // Assuming Seaview is the correct model name
    return view(' admin.add.edit', ['selected_d' => $selectedUploaded]);


    
    }
}
