<?php

namespace App\Http\Controllers\AdminController;
use App\Models\Announcement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.announcement', compact('announcements'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcements.create'); // Create a view for adding new announcements
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'required|string', // Make sure this is validated
        ]);

        Announcement::create([
            'activity_name' => $request->activity_name,
            'event_date' => $request->event_date,
            'description' => $request->description, // Ensure description is passed here
        ]);

        return redirect()->route('admin.announcements.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.show', compact('announcement')); // Display a specific announcement
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit', compact('announcement')); // Create a view for editing
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'activity_name' => 'required|string|max:255',
        'event_date' => 'required|date',
        'description' => 'required|string',
    ]);

    $announcement = Announcement::findOrFail($id);
    $announcement->update([
        'activity_name' => $request->activity_name,
        'event_date' => $request->event_date,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.announcements.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully!');
    }
}
