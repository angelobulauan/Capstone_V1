<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports'; // Ensure this matches your actual table name

    protected $fillable = [
        'scientificname1',
        'scientificname2',
        'scientificname3',
        'description',
        'location',
        'created_at',
    ];
}
