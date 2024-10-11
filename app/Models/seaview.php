<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seaview extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'scientificname',
        'description',
        'location',
        'abundance',
        'photo',
        'u_id',
        'status',
        'req_id'

    ];
    public function interaction()
    {
        return $this->hasOne(SeaGrassLikes::class);
    }

}
