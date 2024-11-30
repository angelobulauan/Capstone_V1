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
    $myEntry = DB::table('seaviews')->where('status', 'approved')->paginate(5);

    // Fetch photos for each entry and pass them along
    foreach ($myEntry as $entry) {
        $entry->photos = DB::table('seagrasspics')
            ->where('sea_id', $entry->id)
            ->get();
    }

    return view('admin.myEntries', ['myEntry' => $myEntry]);
}

public function pendingapproval()
{
    $myEntry = DB::table('seaviews')->where('status', 'pending')->orderBy('created_at', 'desc')->get();

    foreach ($myEntry as $entry) {
        $entry->photos = DB::table('seagrasspics')
            ->where('sea_id', $entry->id)
            ->get();
    }

    return view('admin.pendingapproval', ['myEntry' => $myEntry]);
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
                'updated_by' => Auth::user()->name,
                'archive' => 0,
            ]);

            return redirect()->back()->with('success', 'Seagrass  approved successfully');
        } else {
            return redirect()->back()->with('error', 'Seagrass  status cannot be changed');
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
            'updated_by' => Auth::user()->name,
            'archive' => 0,
        ]);

        return redirect()->back()->with('success', 'Seagrass rejected successfully');
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
                'scientificname1' => 'required|string|max:255',
                'scientificname2' => 'required|string|max:255',
                'scientificname3' => 'required|string|max:255',
                'description' => 'required|string|max:1000',
                'location' => 'required|string|max:255',
                'latitude' => 'required|numeric',
                'longtitude' => 'required|numeric',
                'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Create a new Seaview instance
            $seaview = new Seaview();
            $seaview->scientificname1 = $request->input('scientificname1');
            $seaview->scientificname2 = $request->input('scientificname2');
            $seaview->scientificname3 = $request->input('scientificname3');
            $seaview->description = $request->input('description');
            $seaview->location = $request->input('location');
            $seaview->latitude = $request->input('latitude');
            $seaview->longtitude = $request->input('longtitude');
            $seaview->u_id = Auth::user()->id;
            $seaview->updated_by = Auth::user()->name;
            $seaview->status = 'approved';

            // Save the Seaview instance to the database first
            $seaview->save();

            // Handle multiple file uploads
            if ($request->hasFile('photo')) {
                $seaviewId = $seaview->id;

                foreach ($request->file('photo') as $index => $file) {
                    $filePath = $file->store('seagrass', 'public');

                    $seagrasspic = new Seagrasspic();
                    $seagrasspic->u_id = Auth::user()->id;
                    $seagrasspic->sea_id = $seaviewId;
                    $seagrasspic->photo = $filePath;

                    $seagrasspic->save();

                    if ($index === 0) {
                        $seaview->photo = $filePath;
                        $seaview->save();
                    }
                }
            }

            return redirect()->back()->with('message', 'Data Submitted For Approval');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
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

        // Check if the record exists
        if (!$record) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            'scientificname1' => 'nullable|string',
            'scientificname2' => 'nullable|string',
            'scientificname3' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        // Prepare update data
        $updateData = [
            'scientificname1' => $validatedData['scientificname1'] ?? $record->scientificname1,
            'scientificname2' => $validatedData['scientificname2'] ?? $record->scientificname2,
            'scientificname3' => $validatedData['scientificname3'] ?? $record->scientificname3,
            'description' => $validatedData['description'] ?? $record->description,
            'location' => $validatedData['location'] ?? $record->location,
            'updated_at' => now(),
        ];

        // Update the record in the database
        DB::table('seaviews')->where('id', $id)->update($updateData);

        return back()->with('success', 'Record updated successfully');
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
        // Delete the main seaview record for the authenticated user
        $seaview = Seaview::where('id', $id)
            ->where('u_id', Auth::user()->id)
            ->first();

        if (!$seaview) {
            return back()->withErrors('Record not found or unauthorized access.');
        }

        // Retrieve and delete related photos from the `seagrasspics` table
        $seagrasspics = DB::table('seagrasspics')
            ->where('u_id', Auth::user()->id)
            ->where('sea_id', $id)
            ->get();

        foreach ($seagrasspics as $pic) {
            // Check if the `photo` already includes the directory
            $photoPath = storage_path('app/public/' . $pic->Photo);

            // Log the constructed path for debugging
            \Log::info('Constructed file path: ' . $photoPath);

            // Check if the file exists and delete it
            if (file_exists($photoPath) && is_file($photoPath)) {
                if (unlink($photoPath)) {
                    \Log::info('File deleted successfully: ' . $photoPath);
                } else {
                    \Log::error('Failed to delete file: ' . $photoPath);
                }
            } else {
                \Log::error('File does not exist or is not a file: ' . $photoPath);
            }
        }

        // Delete the records from the `seagrasspics` table
        DB::table('seagrasspics')
            ->where('u_id', Auth::user()->id)
            ->where('sea_id', $id)
            ->delete();

        // Delete the `seaview` record
        $seaview->delete();

        return back()
            ->with('success', 'Record and related images deleted successfully!')
            ->with([
                'showNotification' => true,
                'notificationMessage' => 'Record and related images deleted successfully!',
                'notificationType' => 'success',
            ]);
    }

}
