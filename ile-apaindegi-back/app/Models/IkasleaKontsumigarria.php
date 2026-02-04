<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IkasleaKontsumigarria extends Model
{
    use SoftDeletes;

    protected $table = 'ikasleak_kontsumigarriak';

    protected $fillable = [
        'ikaslea_id',
        'kontsumigarria_id',
        'erabilitako_kopurua',
        'erabiltzeko_data',
    ];

    // Relaciones
    public function ikaslea(): BelongsTo
    {
        return $this->belongsTo(Ikaslea::class, 'ikaslea_id');
    }

    public function kontsumigarria(): BelongsTo
    {
        return $this->belongsTo(Kontsumigarria::class, 'kontsumigarria_id');
    }
}
