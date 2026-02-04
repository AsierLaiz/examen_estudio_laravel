<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['titulo','ano_estreno','director_id'];

    public function director()
    {
        return $this->belongsTo(Director::class);
    }
}
