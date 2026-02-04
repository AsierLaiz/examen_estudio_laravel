<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IkasleaEkipamendua extends Model
{
    use SoftDeletes;

    protected $table = 'ikasleak_ekipamenduak';

    protected $fillable = [
        'ikaslea_id',
        'ekipamendua_id',
        'hasiera_data',
        'amaiera_data',
    ];

    // Relaciones
    public function ikaslea(): BelongsTo
    {
        return $this->belongsTo(Ikaslea::class, 'ikaslea_id');
    }

    public function ekipamendua(): BelongsTo
    {
        return $this->belongsTo(Ekipamendua::class, 'ekipamendua_id');
    }
}
