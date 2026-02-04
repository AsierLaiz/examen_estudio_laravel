<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ikaslea extends Model
{
    use SoftDeletes;

    protected $table = 'ikasleak';

    protected $fillable = [
        'izena',
        'abizenak',
        'taldea_id',
    ];

    // Relaciones
    public function taldea(): BelongsTo
    {
        return $this->belongsTo(Taldea::class, 'taldea_id');
    }

    public function txandak(): HasMany
    {
        return $this->hasMany(Txanda::class, 'ikaslea_id');
    }

    public function ikasleaEkipamenduak(): HasMany
    {
        return $this->hasMany(IkasleaEkipamendua::class, 'ikaslea_id');
    }

    public function hitzorduak(): HasMany
    {
        return $this->hasMany(Hitzordua::class, 'ikaslea_id');
    }

    public function ikasleaKontsumigarriak(): HasMany
    {
        return $this->hasMany(IkasleaKontsumigarria::class, 'ikaslea_id');
    }
}
