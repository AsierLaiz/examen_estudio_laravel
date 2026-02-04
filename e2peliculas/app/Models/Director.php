<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = ['nombre','pais'];

    public function peliculas()
    {
        return $this->hasMany(Movie::class);
    }
}
