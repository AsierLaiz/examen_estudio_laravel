<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kontsumigarria extends Model
{
    use SoftDeletes;

    protected $table = 'kontsumigarriak';

    protected $fillable = [
        'izena',
        'deskribapena',
        'batch',
        'marka',
        'stock',
        'min_stock',
        'iraungitze_data',
        'kategoriak_id',
    ];

    // Relaciones
    public function kategoria(): BelongsTo
    {
        return $this->belongsTo(Kategoria::class, 'kategoriak_id');
    }

    public function ikasleaKontsumigarriak(): HasMany
    {
        return $this->hasMany(IkasleaKontsumigarria::class, 'kontsumigarria_id');
    }
}
