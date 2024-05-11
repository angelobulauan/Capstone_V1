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
            ->paginate(5); // use paginage 5 to view per 5 records

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

            // Save the `Seaview` instance to the database first
            $seaview->save();

            // Handle multiple file uploads
            if ($request->hasFile('photo')) {
                // Assign the ID of the saved Seaview instance
                $seaviewId = $seaview->id;

                // Iterate through the uploaded photos
                foreach ($request->file('photo') as $index => $file) {
                    // Store the file in the 'public' disk under the 'seagrass' folder
                    $filePath = $file->store('seagrass', 'public');

                    // Create a new `Seagrasspics` instance
                    $seagrasspic = new Seagrasspic();
                    $seagrasspic->sea_id = $seaviewId; // Use the Seaview ID for `sea_id`
                    $seagrasspic->photo = $filePath;

                    // Save the `Seagrasspics` instance to the database
                    $seagrasspic->save();

                    // If this is the first photo, store the file path in the `Seaview`'s `photo` field
                    if ($index === 0) {
                        $seaview->photo = $filePath;
                        // Save the `Seaview` instance again to update the `photo` field
                        $seaview->save();
                    }
                }
            }

            // Redirect with success message
            return redirect()->route('admin.add.index')->with('success', 'Seaview data saved successfully.');
        } catch (Exception $e) {
            // Log the error
            Log::error($e->getMessage());

            // Redirect with error message
            return redirect()->route('admin.add.index')->with('error', 'Failed to save Seaview data. Please try again.');
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
    public function edit($id)
    {
        // dd($id);
        return view('admin.edit')->with('id', $id);
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
    public function delete($d_id)
    {
        $seagrass = seaview::find($d_id)->delete();
        return view('admin.myEntries');
    }
}
