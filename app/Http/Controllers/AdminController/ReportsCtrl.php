<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\seaview;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeaviewExport;
use Carbon\Carbon;

class ReportsCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Seaview::query(); // ✅ Use Seaview if that's your actual model

        if ($request->has('filter_type') && $request->has('start_date')) {
            $startDate = Carbon::parse($request->start_date);

            if ($request->filter_type == 'yearly') {
                $query->whereYear('created_at', $startDate->year);
            } elseif ($request->filter_type == 'monthly') {
                $query->whereYear('created_at', $startDate->year)
                      ->whereMonth('created_at', $startDate->month);
            } elseif ($request->filter_type == 'weekly') {
                $query->whereBetween('created_at', [
                    $startDate->startOfWeek(),
                    $startDate->endOfWeek()
                ]);
            }
        }

        $reports = $query->paginate(10);

        return view('admin.report', compact('reports'));
    }



/**
 * Export the reports to Excel.
 */
public function exportToExcel(Request $request)
{
    $query = Seaview::query();

    // Apply filters as before
    if ($request->has('filter_type') && $request->has('start_date')) {
        $startDate = Carbon::parse($request->start_date);

        if ($request->filter_type == 'yearly') {
            $query->whereYear('created_at', $startDate->year);
        } elseif ($request->filter_type == 'monthly') {
            $query->whereYear('created_at', $startDate->year)
                  ->whereMonth('created_at', $startDate->month);
        } elseif ($request->filter_type == 'weekly') {
            $query->whereBetween('created_at', [
                $startDate->startOfWeek(),
                $startDate->endOfWeek()
            ]);
        }
    }

    // Get the filtered data
    $reports = $query->get();

    // If no records, export an empty file
    if ($reports->isEmpty()) {
        // If no data, pass an empty collection to the export
        $reports = collect();
    }

    // Pass the filtered reports to the export
    return Excel::download(new SeaviewExport($reports), 'seaviews.xlsx');
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
}
