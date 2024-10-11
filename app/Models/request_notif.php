<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request_notif extends Model
{
    use HasFactory;

    protected $fillable = [
        'req_id',
        'u_id',
        'message',
        'status',
    ];
}

