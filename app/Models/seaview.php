<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seaview extends Model
{

    use HasFactory;
    protected $fillable = [
        'scientificname1',
        'scientificname2',
        'scientificname3',
        'description',
        'location',
        'latitude',
        'longtitude',
        'latitude_dms',
        'longitude_dms',
        'utm_zone',
        'utm_coordinates',
        'photo',
        'u_id',
        'updated_by',
        'status',
        'req_id',
    ];
    public function interaction()
    {
        return $this->hasOne(SeaGrassLikes::class);
    }

}
