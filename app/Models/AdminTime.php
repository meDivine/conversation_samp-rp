<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_id',
        'nickname',
        'level',
        'hours',
        'minutes',
        'seconds'
    ];
}
