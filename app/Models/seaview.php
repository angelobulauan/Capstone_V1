<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seaview extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'scientificname1',
        'scientificname2',
        'scientificname3',
        'description',
        'location',
        'photo',
        'u_id',
        'status',
        'req_id',
        'updated_by',


    ];
    public function interaction()
    {
        return $this->hasOne(SeaGrassLikes::class);
    }

}
