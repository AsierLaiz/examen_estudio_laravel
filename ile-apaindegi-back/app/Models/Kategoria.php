<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategoria extends Model
{
    use SoftDeletes;

    protected $table = 'kategoriak';

    protected $fillable = [
        'izena',
    ];

    // Relaciones
    public function kontsumigarriak(): HasMany
    {
        return $this->hasMany(Kontsumigarria::class, 'kategoriak_id');
    }
}
