<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seaview extends Model
{
    
    use HasFactory;
    protected $fillable =[
        'name', 'scientificname', 'description', 'location', 'abundance','photo'
    ];
}
