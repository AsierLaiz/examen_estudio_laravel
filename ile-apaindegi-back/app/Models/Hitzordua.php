<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hitzordua extends Model
{
    use SoftDeletes;

    protected $table = 'hitzorduak';

    protected $fillable = [
        'iruzkina',
        'hitzordua_data',
        'hasiera_ordua',
        'amaiera_ordua',
        'bezeroa_id',
        'ikaslea_id',
    ];

    // Relaciones
    public function bezeroa(): BelongsTo
    {
        return $this->belongsTo(Bezeroa::class, 'bezeroa_id');
    }

    public function ikaslea(): BelongsTo
    {
        return $this->belongsTo(Ikaslea::class, 'ikaslea_id');
    }

    public function zerbitzuak(): BelongsToMany
    {
        return $this->belongsToMany(Zerbitzua::class, 'hitzorduak_zerbitzuak', 'hitzordua_id', 'zerbitzua_id')
            ->withPivot('iruzkinak')
            ->withTimestamps();
    }

    public function hitzorduaZerbitzuak(): HasMany
    {
        return $this->hasMany(HitzorduaZerbitzua::class, 'hitzordua_id');
    }
}
