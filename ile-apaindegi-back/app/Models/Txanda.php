<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Txanda extends Model
{
    use SoftDeletes;

    protected $table = 'txandak';

    protected $fillable = [
        'mota',
        'data',
        'ikaslea_id',
    ];

    // Relaciones
    public function ikaslea(): BelongsTo
    {
        return $this->belongsTo(Ikaslea::class, 'ikaslea_id');
    }
}
