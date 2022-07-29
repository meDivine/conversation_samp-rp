<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class script extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'filepath',
        'filename',
        'about',
        'downloads'
    ];
}
