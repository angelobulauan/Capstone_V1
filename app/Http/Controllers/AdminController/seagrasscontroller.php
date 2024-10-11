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
                'latitude' => 'required|numeric|between:-90,90',
                'longtitude' => 'required|numeric|between:-180,180',
                'abundance' => 'required|integer|min:0',
                'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Create a new Seaview instance
            $seaview = new Seaview();
            $seaview->name = $request->input('name');
            $seaview->scientificname = $request->input('scientificname');
            $seaview->description = $request->input('description');
            $seaview->location = $request->input('location');
            $seaview->lati = $request->input('latitude');
            $seaview->longti = $request->input('longtitude');
            $seaview->abundance = $request->input('abundance');
            $seaview->u_id = Auth::user()->id;
            $seaview->status = 'approved';

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
