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
use Ramsey\Uuid\Type\Decimal;

class seagrasscontroller extends Controller
{
    //this is used for my entries in the user nav
    public function index()
    {
        $myEntry = DB::table('seaviews')->where('status', 'approved')->get();

        return view('admin.myEntries')->with('myEntry', $myEntry);
    }

    public function pendingapproval()
    {
        $myEntry = DB::table('seaviews')->where('status', 'pending')->get();

        return view('admin.pendingapproval')->with('myEntry', $myEntry);
    }

    public function approve($id)
{
    $seaview = Seaview::find($id);

    if ($seaview->status == 'pending') {
        $seaview->status = 'approved';
        $seaview->save();

        DB::table('request_notifs')->insert([
            'req_id' => $seaview->id,
            'u_id' => $seaview->u_id,
            'message' => 'Your Request has been Approved',
            'status' => 'Approved',
            'archive' => 0
        ]);

        return redirect()->back()->with('success', 'Seagrass entry approved successfully');
    } else {
        return redirect()->back()->with('error', 'Seagrass entry status cannot be changed');
    }
}

    public function reject($id)
    {
        // Update the seagrass entry to rejected
        $seaview = Seaview::find($id);
        $seaview->status = 'rejected';
        $seaview->delete();

        DB::table('request_notifs')->insert([
            'req_id' => $seaview->id,
            'u_id' => $seaview->u_id,
            'message' => 'Your Request has been Rejected',
            'status' => 'Rejected',
            'archive' => 0
        ]);

        return redirect()->back()->with('success', 'Seagrass entry rejected successfully');
    }

    public function updatePhoto(Request $request, $id, $photo)
    {
        // Fetch the photo field from seagrasspics based on the given photo ID
        $updatephoto = Seagrasspic::where('id', $photo)->select('photo')->first();

        // Check if the photo data is found
        if ($updatephoto) {
            // Update the photo field in seaviews where id matches the given id
            seaview::where('id', $id)->update(['photo' => $updatephoto->photo]);

            // Return a JSON response indicating success
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Photo updated successfully.',
                    'data' => [
                        'id' => $id,
                        'photo' => $updatephoto->photo,
                    ],
                ],
                200,
            );
        } else {
            // Return a JSON response indicating failure
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to update photo. Photo not found.',
                ],
                404,
            );
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
            'polygon_coordinates' => 'required|json',
            'color' => 'required|string|max:255', // Change this line

        ]);

        // Create a new Seaview instance
        $seaview = new Seaview();
        $seaview->name = $validatedData['name'];
        $seaview->scientificname = $validatedData['scientificname'];
        $seaview->description = $validatedData['description'];
        $seaview->location = $validatedData['location'];
        $seaview->abundance = $validatedData['abundance'];
        $seaview->u_id = Auth::id(); // Directly use Auth::id() for cleaner code
        $seaview->status = 'approved';
        $seaview->photo = null;
        $seaview->color = $validatedData['color']; // Updated line
        $seaview->polygon_coordinates = $validatedData['polygon_coordinates'];


        // Save the Seaview instance to the database
        $seaview->save();

        // Handle multiple file uploads
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $index => $file) {
                // Store each photo and create a record in Seagrasspic
                $filePath = $file->store('seagrass', 'public');

                $seagrasspic = new Seagrasspic();
                $seagrasspic->sea_id = $seaview->id; // Reference the correct variable
                $seagrasspic->photo = $filePath;
                $seagrasspic->save();

                // Save the first uploaded photo as the main photo for the Seaview
                if ($index === 0) {
                    $seaview->photo = $filePath;
                }
            }
            // Save the updated Seaview instance with the main photo
            $seaview->save();
        }

        return response()->json(['message' => 'Seaview data saved successfully.'], 200);
    } catch (ValidationException $e) {
        // Handle validation errors
        return response()->json(['message' => 'Validation failed.', 'errors' => $e->validator->errors()], 422);
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
            DB::table('seaviews')
                ->where('id', $id)
                ->update([
                    'name' => $request->input('name', $record->name),
                    'scientificname' => $request->input('scientificname', $record->scientificname),
                    'description' => $request->input('description', $record->description),
                    'location' => $request->input('location', $record->location),
                    'abundance' => $request->input('abundance', $record->abundance),
                    'updated_at' => now(),
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
