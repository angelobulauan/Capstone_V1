<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\seaview;
use App\Models\Seagrasspic;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class seagrassview extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myEntry = DB::table('seaviews')
            ->where('status', '=', 'approved')
            // ->where('u_id', '=', Auth::user()->id)
            ->paginate(5); //this will retrive all your user entries regardless of the status

        // dd($myEntry);

        //then we return to the newly created blade file with the data we retrieved
        return view('User.seagrass')->with('myEntry', $myEntry);
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
     public function addnew()
    {
        return view('user.addnew');
    }

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
            $seaview->status = 'pending';

            // Get the latest req_id
            $latestReqId = Seaview::latest('req_id')->first()->req_id ?? 0;

            // Increment the req_id
            $seaview->req_id = $latestReqId + 1;

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

            return response()->json(['message' => 'Data Submitted For Approval'], 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['message' => 'Failed to save data. Please try again.'], 500);
        }
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

    public function like($id)
    {
        $userId = Auth::user()->id;

        $seagrassLike = DB::table('sea_grass_likes')->where('seaviews_id', $id)->where('u_id', $userId)->first();

        if ($seagrassLike) {
            if ($seagrassLike->likes == 1) {
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['likes' => 0]);
                $likes = 0;
                $message = 'You have unliked this entry';
            } else {
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['likes' => 1, 'dislikes' => 0]);
                $likes = 1;
                $message = 'You have liked this entry';
            }
        } else {
            DB::table('sea_grass_likes')->insert([
                'seaviews_id' => $id,
                'u_id' => $userId,
                'likes' => 1,
                'dislikes' => 0,
            ]);
            $likes = 1;
            $message = 'You have liked this entry';
        }

        return response()->json(['message' => $message, 'likes' => $likes]);
    }

    public function dislike($id)
    {
        $userId = Auth::user()->id;

        $seagrassDislike = DB::table('sea_grass_likes')->where('seaviews_id', $id)->where('u_id', $userId)->first();

        if ($seagrassDislike) {
            if ($seagrassDislike->dislikes == 1) {
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['dislikes' => 0]);
                $dislikes = 0;
                $message = 'You have removed your dislike from this entry';
            } else {
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['dislikes' => 1, 'likes' => 0]);
                $dislikes = 1;
                $message = 'You have disliked this entry';
            }
        } else {
            DB::table('sea_grass_likes')->insert([
                'seaviews_id' => $id,
                'u_id' => $userId,
                'likes' => 0,
                'dislikes' => 1,
            ]);
            $dislikes = 1;
            $message = 'You have disliked this entry';
        }

        return response()->json(['message' => $message, 'dislikes' => $dislikes]);
    }

    public function view($id)
    {
        $userId = Auth::user()->id;

        $seaview = DB::table('sea_grass_likes')->where('seaviews_id', $id)->where('u_id', $userId)->first();

        if ($seaview) {
            if ($seaview->views == 1) {
                $message = 'You have already viewed this entry';
            } else {
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['views' => 1]);

                $message = 'Your view status has been updated to viewed';
            }
        } else {
            DB::table('sea_grass_likes')->insert([
                'seaviews_id' => $id,
                'u_id' => $userId,
                'views' => 1,
            ]);

            $message = 'View status set to viewed for the first time';
        }

        $viewStatus = DB::table('sea_grass_likes')->where('seaviews_id', $id)->where('u_id', $userId)->value('views');

        // Log the view status for debugging
        Log::info('View status for seaview ID ' . $id . ' by user ID ' . $userId . ': ' . $viewStatus);

        return response()->json(['message' => $message, 'views' => $viewStatus]);
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    // Start building the query
    $myEntry = DB::table('seaviews')
        ->where('status', '=', 'approved');

    // Add additional conditions only if the search query is not empty
    if (!empty($query)) {
        $myEntry = $myEntry->where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
              ->orWhere('location', 'like', '%' . $query . '%');
        });
    }

    // Paginate the results
    $myEntry = $myEntry->paginate(10);

    return view('user.seagrass', compact('myEntry'));
}


}
