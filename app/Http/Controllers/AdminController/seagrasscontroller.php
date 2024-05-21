<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\seaview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Seagrasspic;
use Exception;


class seagrasscontroller extends Controller
{
    //this is used for my entries in the user nav
    public function index()
    {


        $myEntry = DB::table('seaviews')
            ->get(); // use paginage 5 to view per 5 records

        // dd($myEntry);

        //then we return to the newly created blade file with the data we retrieved
        return view('admin.myEntries')
            ->with('myEntry', $myEntry);

    }


    public function updatePhoto(Request $request, $id, $photo)
    {
        // Fetch the photo field from seagrasspics based on the given photo ID
        $updatephoto = Seagrasspic::where('id', $photo)
            ->select('photo')
            ->first();

        // Check if the photo data is found
        if ($updatephoto) {
            // Update the photo field in seaviews where id matches the given id
            seaview::where('id', $id)
                ->update(['photo' => $updatephoto->photo]);

            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Photo updated successfully.',
                'data' => [
                    'id' => $id,
                    'photo' => $updatephoto->photo
                ]
            ], 200);
        } else {
            // Return a JSON response indicating failure
            return response()->json([
                'success' => false,
                'message' => 'Failed to update photo. Photo not found.'
            ], 404);
        }
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
         try {
             // Validate the request data
             $validatedData = $request->validate([
                 'name' => 'required|string|max:255',
                 'scientificname' => 'required|string|max:255',
                 'description' => 'required|string|max:1000',
                 'location' => 'required|string|max:255',
                 'abundance' => 'required|integer|min:0',
                 'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
             ]);

             // Create a new Seaview instance
             $seaview = new Seaview();
             $seaview->name = $request->input('name');
             $seaview->scientificname = $request->input('scientificname');
             $seaview->description = $request->input('description');
             $seaview->location = $request->input('location');
             $seaview->abundance = $request->input('abundance');

             // Save the Seaview instance to the database first
             $seaview->save();

             // Handle multiple file uploads
             if ($request->hasFile('photo')) {
                 $seaviewId = $seaview->id;

                 foreach ($request->file('photo') as $index => $file) {
                     $filePath = $file->store('seagrass', 'public');

                     $seagrasspic = new Seagrasspic();
                     $seagrasspic->sea_id = $seaviewId;
                     $seagrasspic->photo = $filePath;

                     $seagrasspic->save();

                     if ($index === 0) {
                         $seaview->photo = $filePath;
                         $seaview->save();
                     }
                 }
             }

             return response()->json(['message' => 'Seaview data saved successfully.'], 200);
         } catch (Exception $e) {
             Log::error($e->getMessage());

             return response()->json(['message' => 'Failed to save Seaview data. Please try again.'], 500);
         }
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
    public function edit(Request $request, $id)
    {


        // Retrieve the record from the database
        $record = DB::table('seaviews')->where('id', $id)->first();

        // dd($record);


        // Check if the record exists
        if (!$record) {
           return response()->json(['error' => 'Record not found.'], 404);
        } else {
            // Update the record with new values
            DB::table('seaviews')->where('id', $id)->update([
                'name' => $request->input('name', $record->name),
                'scientificname' => $request->input('scientificname', $record->scientificname),
                'description' => $request->input('description', $record->description),
                'location' => $request->input('location', $record->location),
                'abundance' => $request->input('abundance', $record->abundance),
                'updated_at' => now()
            ]);

            // Return a success response
            return response()->json(['success' => 'Record updated successfully.']);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $seagrass = Seaview::find($id);

        if ($seagrass) {
            $seagrass->delete();
            return response()->json(['success' => true, 'message' => 'Seagrass entry deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Seagrass entry not found']);
        }
    }
}
