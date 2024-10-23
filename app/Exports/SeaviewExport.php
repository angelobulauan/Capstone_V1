<?php

namespace App\Exports;

use App\Models\Seaview; // Ensure proper casing for the model
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SeaviewExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        // Retrieve all data from seaview table and format the created_at date
        return Seaview::all()->map(function ($item) {
            return [
                'name' => $item->name,
                'scientificname' => $item->scientificname,
                'description' => $item->description,
                'location' => $item->location,
                'abundance' => $item->abundance,
                'latitude' => $item->latitude,
                'longtitude' => $item->longtitude,
                'created_at' => $item->created_at->format('m-d-Y'), // Format to 'YYYY-MM-DD'
            ];
        });
    }

    public function headings(): array
    {
        // Define the column headings for the Excel file
        return [
            'Name',
            'Scientific Name',
            'Description',
            'Location',
            'Abundance',
            'Latitude',
            'Longitude',
            'Date Published',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style the first row as bold
        $sheet->getStyle('A1:'. $sheet->getHighestColumn() . '1')->getFont()->setBold(true);
    }
}
