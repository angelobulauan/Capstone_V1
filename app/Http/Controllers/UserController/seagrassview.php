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
}
