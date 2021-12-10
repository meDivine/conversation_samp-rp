<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fraction
 *
 * @property int $id
 * @property string $frac_name
 * @method static Builder|Fraction newModelQuery()
 * @method static Builder|Fraction newQuery()
 * @method static Builder|Fraction query()
 * @method static Builder|Fraction whereFracName($value)
 * @method static Builder|Fraction whereId($value)
 * @mixin \Eloquent
 */
class Fraction extends Model
{
    use HasFactory;
    protected $fillable = [
        'frac_name'
    ];
    public $timestamps = false;

    public function renameFracName($id): string {
        $frac = self::find($id);
        return $frac->frac_name ?? "none";
    }
}
