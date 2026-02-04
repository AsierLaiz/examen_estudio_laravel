<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Taldea extends Model
{
    use SoftDeletes;

    protected $table = 'taldeak';

    protected $fillable = [
        'izena',
    ];

    // Relaciones
    public function ikasleak(): HasMany
    {
        return $this->hasMany(Ikaslea::class, 'taldea_id');
    }

    public function ordutegiak(): HasMany
    {
        return $this->hasMany(Ordutegia::class, 'taldea_id');
    }
}
