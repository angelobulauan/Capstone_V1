<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\seaview;
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
            // ->where('u_id', '=', Auth::user()->id)
            ->get(); //this will retrive all your user entries regardless of the status

        // dd($myEntry);

        //then we return to the newly created blade file with the data we retrieved
        return view('User.seagrass')
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

        // Fetch the existing record from sea_grass_likes for the current user
        $seagrassLike = DB::table('sea_grass_likes')
            ->where('seaviews_id', $id)
            ->where('u_id', $userId)
            ->first();

        if ($seagrassLike) {
            if ($seagrassLike->likes == 1) {
                // If the user has already liked this entry, reset the likes to 0
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['likes' => 0]);

                $likes = 0;
                $message = 'You have unliked this entry';
            } else {
                // If the user had unliked it before, set the likes back to 1
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['likes' => 1]);

                $likes = 1;
                $message = 'You have liked this entry';
            }
        } else {
            // If the record doesn't exist, create a new one with likes = 1
            DB::table('sea_grass_likes')
                ->insert([
                    'seaviews_id' => $id,
                    'u_id' => $userId,
                    'likes' => 1,
                    'dislikes' => 0, // Assuming you have a dislikes column; set it to 0 initially
                ]);

            $likes = 1;
            $message = 'You have liked this entry';
        }

        // Return the updated likes count and message as a JSON response
        return response()->json(['message' => $message, 'likes' => $likes]);
    }


    public function dislike($id)
    {
        $userId = Auth::user()->id;

        // Fetch the existing record from sea_grass_likes for the current user
        $seagrassDislike = DB::table('sea_grass_likes')
            ->where('seaviews_id', $id)
            ->where('u_id', $userId)
            ->first();

        if ($seagrassDislike) {
            if ($seagrassDislike->dislikes == 1) {
                // If the user has already disliked this entry, reset the dislikes to 0
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['dislikes' => 0]);

                $dislikes = 0;
                $message = 'You have removed your dislike from this entry';
            } else {
                // If the user had removed the dislike before, set the dislikes back to 1
                DB::table('sea_grass_likes')
                    ->where('seaviews_id', $id)
                    ->where('u_id', $userId)
                    ->update(['dislikes' => 1]);

                $dislikes = 1;
                $message = 'You have disliked this entry';
            }
        } else {
            // If the record doesn't exist, create a new one with dislikes = 1
            DB::table('sea_grass_likes')
                ->insert([
                    'seaviews_id' => $id,
                    'u_id' => $userId,
                    'likes' => 0, // Assuming you have a likes column; set it to 0 initially
                    'dislikes' => 1,
                ]);

            $dislikes = 1;
            $message = 'You have disliked this entry';
        }

        // Return the updated dislikes count and message as a JSON response
        return response()->json(['message' => $message, 'dislikes' => $dislikes]);
    }




    // for views counting
    public function view($id)
    {
        $sessionKey = 'viewed_seaview_' . $id;

        // dd($sessionKey);
        if (!session()->has($sessionKey)) {
            DB::table('sea_grass_likes')->where('id', $id)->increment('views');
            session([$sessionKey => true]);
        }

        $views = DB::table('sea_grass_likes')->where('id', $id)->value('views');

        // Log the views count for debugging
        Log::info('Views count for seaview ID ' . $id . ': ' . $views);

        // Debugging output to ensure the correct data is returned
        return response()->json(['views' => $views]);
    }
}
