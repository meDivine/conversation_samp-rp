<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraction extends Model
{
    use HasFactory;
    protected $fillable = [
        'frac_name'
    ];
    public $timestamps = false;

    public function renameFracName($id): string {
        $frac = self::find($id);
        return $frac->frac_name;
    }
}
