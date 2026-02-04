<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bezeroa extends Model
{
    use SoftDeletes;

    protected $table = 'bezeroak';

    protected $fillable = [
        'izena',
        'abizenak',
        'telefonoa',
        'posta_elek',
        'etxeko_bezeroa',
    ];

    // Relaciones
    public function hitzorduak(): HasMany
    {
        return $this->hasMany(Hitzordua::class, 'bezeroa_id');
    }
}
