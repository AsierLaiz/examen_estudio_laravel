<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zerbitzua extends Model
{
    use SoftDeletes;

    protected $table = 'zerbitzuak';

    protected $fillable = [
        'izena',
        'prezioa',
        'etxeko_prezioa',
        'iraunaldia',
    ];

    // Relaciones
    public function hitzorduak(): BelongsToMany
    {
        return $this->belongsToMany(Hitzordua::class, 'hitzorduak_zerbitzuak', 'zerbitzua_id', 'hitzordua_id')
            ->withPivot('iruzkinak')
            ->withTimestamps();
    }

    public function hitzorduaZerbitzuak(): HasMany
    {
        return $this->hasMany(HitzorduaZerbitzua::class, 'zerbitzua_id');
    }
}
