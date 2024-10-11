<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\seaview;
use App\Models\request_notif;
use App\Models\Seagrasspic;

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
}
