<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\seaview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class seagrasscontroller extends Controller
{
    //this is used for my entries in the user nav
    public function index($id)
    {

        
        $myEntry = DB::table('seaviews')
        // ->where('u_id', '=', Auth::user()->id) 
        ->get(); //this will retrive all your user entries regardless of the status 

        // dd($myEntry);

        //then we return to the newly created blade file with the data we retrieved
        return view('admin.myEntries')
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
       
        $seagrass = new seaview();
        // $seagrass->u_id = $id;
        $seagrass->name =  $request->name;
        $seagrass->scientificname =  $request->scientificname;
        $seagrass->description =  $request->description;
        $seagrass->location =  $request->location;
        $seagrass->abundance =  $request->abundance;
        $seagrass->photo =  $request->photo;
        $seagrass->save();
 
        return redirect()->route('admin.add.index');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('user.seagrass');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        return view ('admin.edit')->with('id', $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
      

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($d_id)
    {
        $seagrass = seaview::find($d_id)->delete();
        return view('admin.myEntries');
    }
}
