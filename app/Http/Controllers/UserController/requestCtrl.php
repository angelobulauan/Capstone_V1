<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\seaview;
use App\Models\request_notif;
use App\Models\Seagrasspic;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class requestCtrl extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pending = seaview::where('status', 'pending')
            ->where('u_id', $user->id)
            ->get();
        return view('user.request', compact('pending'));
    }

    public function show($id)
    {
        // Get the authenticated user's u_id
        $u_id = Auth::user()->u_id;

        // Retrieve the specific seaview entry by id
        $seaview = request_notif::where('id', $id)->first();

        // Check if seaview is found and retrieve the message
        if ($seaview) {
            $message = $seaview->message;
        } else {
            $message = 'No Notifications!';
        }

        return view('user.request-show', compact('seaview', 'u_id', 'message'));
    }

    public function archiveMessage(Request $request, $id)
    {
        // Validate the request if necessary
        $request->validate([
            'archive' => 'required|boolean',
        ]);

        // Update the message to archive it
        $message = DB::table('request_notifs')
            ->where('id', $id)
            ->update(['archive' => $request->archive]);

        return response()->json(['success' => $message ? true : false]);
    }

    public function edit(Request $request, $id)
    {
        $seaview = seaview::findOrFail($id);
        return view('user.request-edit', compact('seaview'));
    }

    public function update(Request $request, $id)
    {
        // Retrieve the record from the database
        $seaview = DB::table('seaviews')->where('id', $id)->first();

        // Check if the record exists
        if (!$seaview) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            'scientificname1' => 'nullable|string',
            'scientificname2' => 'nullable|string',
            'scientificname3' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longtitude' => 'nullable|string',
            'photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make it nullable to handle no photo upload
        ]);

        // Prepare update data
        $updateData = [
            'scientificname1' => $validatedData['scientificname1'] ?? $seaview->scientificname1,
            'scientificname2' => $validatedData['scientificname2'] ?? $seaview->scientificname2,
            'scientificname3' => $validatedData['scientificname3'] ?? $seaview->scientificname3,
            'description' => $validatedData['description'] ?? $seaview->description,
            'location' => $validatedData['location'] ?? $seaview->location,
            'latitude' => $validatedData['latitude'] ?? $seaview->latitude,
            'longtitude' => $validatedData['longtitude'] ?? $seaview->longtitude,
            'updated_at' => now(),
        ];

        // Update the record in the database
        DB::table('seaviews')->where('id', $id)->update($updateData);

        // Check if the request has a new photo
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($seaview->photo && Storage::disk('public')->exists($seaview->photo)) {
                Storage::disk('public')->delete($seaview->photo);
            }

            // Handle new photo uploads
            $seaviewId = $seaview->id;

            foreach ($request->file('photo') as $index => $file) {
                $filePath = $file->store('seagrass', 'public'); // Store new photo

                // Save photo info to 'seagrasspics' table
                $seagrasspic = new Seagrasspic();
                $seagrasspic->sea_id = $seaviewId;
                $seagrasspic->photo = $filePath;
                $seagrasspic->save();

                // If it's the first photo, update the main 'photo' field on 'seaviews'
                if ($index === 0) {
                    // Update main photo
                    DB::table('seaviews')
                        ->where('id', $id)
                        ->update(['photo' => $filePath]);
                }
            }
        }

        return back()
            ->with('success', 'Record updated successfully!')
            ->with([
                'showNotification' => true,
                'notificationMessage' => 'Record updated successfully!',
                'notificationType' => 'success',
            ]);
    }

    public function destroy(Request $request, $id)
    {
        // Retrieve the seaview record
        $seaview = Seaview::findOrFail($id);
        \Log::info('Attempting to delete photos for sea_id: ' . $id);

        // Retrieve and delete related photos
        Seagrasspic::where('sea_id', $id)->each(function ($pic) {
            $photoPath = public_path('storage/' . $pic->photo);
            \Log::info('Attempting to delete: ' . $photoPath);

            if (file_exists($photoPath) && is_file($photoPath)) {
                if (unlink($photoPath)) {
                    \Log::info('File deleted successfully: ' . $pic->photo);
                } else {
                    \Log::error('Failed to delete the file: ' . $photoPath);
                }
            } else {
                \Log::error('File does not exist or is not a file: ' . $photoPath);
            }

            $pic->delete();
        });

        // Delete the main seaview photo
        $mainPhotoPath = public_path('storage/' . $seaview->photo);
        \Log::info('Attempting to delete main photo: ' . $mainPhotoPath);

        if (file_exists($mainPhotoPath) && is_file($mainPhotoPath)) {
            if (unlink($mainPhotoPath)) {
                \Log::info('Main file deleted successfully: ' . $seaview->photo);
            } else {
                \Log::error('Failed to delete the main file: ' . $mainPhotoPath);
            }
        } else {
            \Log::error('Main file does not exist or is not a file: ' . $mainPhotoPath);
        }

        dd($seaview);
        // Delete the seaview request
        $seaview->delete();

        return back()
            ->with('success', 'Request and related photos deleted successfully!')
            ->with([
                'showNotification' => true,
                'notificationMessage' => 'Request and related photos deleted successfully!',
                'notificationType' => 'success',
            ]);
    }

}
