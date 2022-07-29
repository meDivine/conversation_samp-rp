<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Week extends Model
{
    use HasFactory;

    protected $fillable = ['week_start', 'week_end', 'normal_play', 'week_name'];

    // получим данные за неделю через связи один ко многим
    public function weekInfo(): HasMany
    {
        return $this->hasMany(AdminTime::class, 'week_id');
    }
}
