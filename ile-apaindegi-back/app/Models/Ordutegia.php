<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ordutegia extends Model
{
    use SoftDeletes;

    protected $table = 'ordutegiak';

    protected $fillable = [
        'eguna',
        'hasiera_data',
        'amaiera_data',
        'hasiera_ordua',
        'amaiera_ordua',
        'taldea_id',
    ];

    // Relaciones
    public function taldea(): BelongsTo
    {
        return $this->belongsTo(Taldea::class, 'taldea_id');
    }
}
