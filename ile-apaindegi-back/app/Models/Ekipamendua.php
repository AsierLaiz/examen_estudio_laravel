<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ekipamendua extends Model
{
    use SoftDeletes;

    protected $table = 'ekipamenduak';

    protected $fillable = [
        'etiketa',
        'izena',
        'deskribapena',
        'marka',
    ];

    // Relaciones
    public function ikasleaEkipamenduak(): HasMany
    {
        return $this->hasMany(IkasleaEkipamendua::class, 'ekipamendua_id');
    }
}
