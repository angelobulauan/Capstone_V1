<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeaGrassLikes extends Model
{
    use HasFactory;

    protected $fillable =[
        'u_id','seaviews_id', 'likes', 'dislikes', 'views'
    ];

    public function seaview()
    {
        return $this->belongsTo(seaview::class);
    }
}
