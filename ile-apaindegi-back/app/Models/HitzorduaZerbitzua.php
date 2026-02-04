<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HitzorduaZerbitzua extends Model
{
    use SoftDeletes;

    protected $table = 'hitzorduak_zerbitzuak';

    protected $fillable = [
        'iruzkinak',
        'hitzordua_id',
        'zerbitzua_id',
    ];

    // Relaciones
    public function hitzordua(): BelongsTo
    {
        return $this->belongsTo(Hitzordua::class, 'hitzordua_id');
    }

    public function zerbitzua(): BelongsTo
    {
        return $this->belongsTo(Zerbitzua::class, 'zerbitzua_id');
    }
}
