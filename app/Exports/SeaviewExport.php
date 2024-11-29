<?php

namespace App\Exports;

use App\Models\seaview;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SeaviewExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        // Retrieve all data from seaview table and format the created_at date
        return seaview::all()->map(function ($item) {
            return [
                'scientificname1' => $item->scientificname1,
                'scientificname2' => $item->scientificname2,
                'scientificname3' => $item->scientificname3,
                'description' => $item->description,
                'location' => $item->location,
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
            'Scientific Name 1',
            'Scientific Name 2',
            'Scientific Name 3',
            'Description',
            'Location',
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
