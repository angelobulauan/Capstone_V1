<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'announcements';

    // Define the mass-assignable fields
    protected $fillable = [
        'activity_name',
        'event_date',
        'description',  // Add description here
    ];

    // If you need timestamps (created_at and updated_at)
    public $timestamps = true;
}
